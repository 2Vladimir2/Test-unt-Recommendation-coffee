<?php

namespace Tests\Unit;

use App\Enums\CoffeeType;
use App\Enums\MoodEnum;
use App\Enums\TimeOfDay;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserEnumCastTest extends TestCase
{
    use RefreshDatabase;

    public function test_enum_casts_work_properly()
    {
        $user = User::factory()->create([
            'mood' => 'cheerful',
            'time_of_day' => 'morning',
            'preferred_coffee' => 'espresso',
        ]);

        $this->assertInstanceOf(MoodEnum::class, $user->mood);
        $this->assertEquals('cheerful', $user->mood->value);

        $this->assertInstanceOf(TimeOfDay::class, $user->time_of_day);
        $this->assertEquals('morning', $user->time_of_day->value);

        $this->assertInstanceOf(CoffeeType::class, $user->preferred_coffee);
        $this->assertEquals('espresso', $user->preferred_coffee->value);
    }
}
