<?php

namespace App\Http\Requests;

use App\Enums\CarClassEnum;
use App\Models\UserVehicle;
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
        $required_cars_rules = [];
        $car_class_rules = [];

        // required or optional name and number pair
        for ($i = 0; $i < UserVehicle::MAX_NO_OF_CARS; $i++) {
            switch ($i) {
                case 0:
                    // 1台目
                    $required_cars_rules["car_name.$i"] = "required|max:20|required_with:car_number.$i";
                    $required_cars_rules["car_number.$i"] = "required|max:20|required_with:car_name.$i";
                    break;

                default:
                    // 2台目から
                    $required_cars_rules["car_name.$i"] = "max:20|required_with:car_number.$i";
                    $required_cars_rules["car_number.$i"] = "max:20|required_with:car_name.$i";
                    break;
            }

            // car_class パラメータは配列ではありません
            // car_class1、car_class2、car_class3
            $carClassSequence = $i + 1;
            $car_class_rules["car_class$carClassSequence"] = 'max:30|in:' . implode(',', array_map(fn($case) => $case->value, CarClassEnum::cases()));
        }

        return array_merge([
            'user_id' => 'nullable',

            // param should be an array
            'sequence_no' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'car_name' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'car_katashiki' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'car_number' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,

            // array element should be string
            'car_katashiki.*' => 'max:20',

        ], $required_cars_rules, $car_class_rules);
    }

    public function attributes(): array
    {
        $car_attributes = [];
        for ($i = 0; $i < UserVehicle::MAX_NO_OF_CARS; $i++) {
            $carClassSequence = $i + 1;
            $car_attributes["car_name.$i"] = "車名(" . ($i + 1) . "台目)";
            $car_attributes["car_katashiki.$i"] = "型式(" . ($i + 1) . "台目)";
            $car_attributes["car_number.$i"] = "ナンバー(" . ($i + 1) . "台目)";
            $car_attributes["car_class$carClassSequence"] = "車種区分(" . ($i + 1) . "台目)";
        }
        return array_merge([
            'user_id' => 'ユーザーID',
        ], $car_attributes);
    }
}
