<?php

namespace App\Services;

class TimeOfDayService
{
    protected array $map = [
        'morning' => 'Эспрессо',
        'afternoon' => 'Латте',
        'evening' => 'Безкофеиновый',
        ];

    public function getRecommendation(string $timeOfDay) : string
    {
        $timeOfDay = strtolower($timeOfDay);

        return $this->map[$timeOfDay] ?? 'Американо';
    }
}
