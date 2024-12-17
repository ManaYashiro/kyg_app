<?php

namespace App\Http\Requests;

use App\Enums\CarClassEnum;
use Illuminate\Foundation\Http\FormRequest;

class UserVehicleRequest extends FormRequest
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
            'user_id' => 'nullable',
            'car_name' => 'required|string|max:20|required_with:car_number',
            'car_katashiki' => 'nullable|string|max:20',
            'car_number' => 'required|string|max:20|required_with:car_name',
            'car_class' => 'nullable|string|max:30|in:' . implode(',', array_map(fn($case) => $case->value, CarClassEnum::cases())),
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'ユーザーID',
            'car_name' => '車名',
            'car_katashiki' => '型式',
            'car_number' => 'ナンバー',
            'car_class' => '車種区分',
        ];
    }
}
