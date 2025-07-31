<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendationHistory extends Model
{
    // Разрешённые для массового заполнения поля
    protected $fillable = [
        'user_name',
        'mood',
        'recommended_coffee',
        'recommended_at',
    ];

    // Отключаем timestamps, если в таблице нет created_at/updated_at
    public $timestamps = false;
}
