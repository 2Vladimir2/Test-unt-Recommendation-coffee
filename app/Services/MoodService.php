<?php

namespace App\Services;

class MoodService
{
    protected array $map = [
        'веселый' => 'Капучино',
        'уставший' => 'Эспрессо',
        'грустный' => 'Мокко',
        'сонный' => 'Доппио',
        'стресс' => 'Латте',
        'бодрый' => 'Эспрессо',
    ];

    public function getRecommendation(string $mood): string
    {
        $mood = mb_strtolower($mood);
        return $this->map[$mood] ?? 'Американо';
    }
}
?>

