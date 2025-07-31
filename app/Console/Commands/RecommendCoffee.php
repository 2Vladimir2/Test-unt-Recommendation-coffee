<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MoodService;
use App\Services\TimeOfDayService;
use App\Services\UserPreferenceService;
use App\Services\RecommendationService;
use App\Models\RecommendationHistory;


class RecommendCoffee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coffee:recommend {name} {mood?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Рекомендует кофе по имени и настроению пользователя';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $mood = $this->argument('mood') ?? 'неизвестно';

        $user = new class($name, $mood) {
            public string $name;
            public ?string $mood;
            public ?string $preferred_coffee = null;

            public function __construct($name, $mood)
            {
                $this->name = $name;
                $this->mood = $mood;
            }
        };

        $recommendationService = new RecommendationService(
            new MoodService(),
            new TimeOfDayService(),
            new UserPreferenceService()
        );

        $coffee = $recommendationService->recommend($user);

        RecommendationHistory::create([
            'user_name' => $name,
            'mood' => $mood,
            'recommended_coffee' => $coffee->value,
            'recommended_at' => now(),
        ]);

        $this->info("Пользователю {$name} рекомендован кофе: {$coffee->value}");

        return 0;
    }
}
