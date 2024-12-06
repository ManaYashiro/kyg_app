<?php

namespace App\Http\Requests;

use App\Enums\CarClassEnum;
use Illuminate\Foundation\Http\FormRequest;

class UserVehiclesRequest extends FormRequest
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
            'car1_name' => 'required|string|max:20',
            'car1_katashiki' => 'nullable|string|max:20',
            'car1_number' => 'required|string|max:20',
            'car1_class' => 'nullable|string|max:30|in:' . implode(',', array_map(fn($case) => $case->value, CarClassEnum::cases())),
            'car2_name' => 'nullable|string|max:20',
            'car2_katashiki' => 'nullable|string|max:20',
            'car2_number' => 'nullable|string|max:20',
            'car2_class' => 'nullable|string|max:30|in:' . implode(',', array_map(fn($case) => $case->value, CarClassEnum::cases())),
            'car3_name' => 'nullable|string|max:20',
            'car3_katashiki' => 'nullable|string|max:20',
            'car3_number' => 'nullable|string|max:20',
            'car3_class' => 'nullable|string|max:30|in:' . implode(',', array_map(fn($case) => $case->value, CarClassEnum::cases())),
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'ユーザーID',
            'car1_name' => '車名(1台目)',
            'car1_katashiki' => '型式(1台目)',
            'car1_number' => 'ナンバー(1台目)',
            'car1_class' => '車種区分(1台目)',
            'car2_name' => '車名(2台目)',
            'car2_katashiki' => '型式(2台目)',
            'car2_number' => 'ナンバー(2台目)',
            'car2_class' => '車種区分(2台目)',
            'car3_name' => '車名(3台目)',
            'car3_katashiki' => '型式(3台目)',
            'car3_number' => 'ナンバー(3台目)',
            'car3_class' => '車種区分(3台目)',
        ];
    }
}
