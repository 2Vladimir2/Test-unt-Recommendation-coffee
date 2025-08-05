<?php

namespace App\Http\Requests\Recommendation;

use App\Enums\MoodEnum;
use App\Enums\TimeOfDayEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RecommendationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mood' => ['nullable', new Enum(MoodEnum::class)],
            'time_of_day' => ['nullable', new Enum(TimeOfDayEnum::class)],
        ];
    }
}
