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
        $max_no_of_cars = 3;
        $required_cars_rules = [];

        // required or optional name and number
        for ($i = 0; $i < $max_no_of_cars; $i++) {
            switch ($i) {
                case 0:
                    // 1台目
                    $required_cars_rules["car_name.$i"] = "required|string|max:20|required_with:car_number.$i";
                    $required_cars_rules["car_number.$i"] = "required|string|max:20|required_with:car_name.$i";
                    break;

                default:
                    // 2台目から
                    $required_cars_rules["car_name.$i"] = "string|max:20|required_with:car_number.$i";
                    $required_cars_rules["car_number.$i"] = "string|max:20|required_with:car_name.$i";
                    break;
            }
        }

        return array_merge([
            'user_id' => 'nullable',

            // param should be an array
            'car_name' => 'required|array|max:3',
            'car_katashiki' => 'required|array|max:3',
            'car_number' => 'required|array|max:3',
            'car_class' => 'required|array|max:3',

            // array element should be string
            'car_katashiki.*' => 'string|max:20',
            'car_class.*' => 'string|max:30|in:' . implode(',', array_map(fn($case) => $case->value, CarClassEnum::cases())),
        ], $required_cars_rules);
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
