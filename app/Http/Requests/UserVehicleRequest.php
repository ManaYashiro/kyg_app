<?php

namespace App\Http\Requests;

use App\Enums\CarClassEnum;
use App\Models\UserVehicle;
use App\Rules\HalfWidthString;
use App\Rules\NumberString;
use App\Rules\HKanaString;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

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
        $created_user_role = Session::get("created_user_role");

        // ルールを設定
        for ($i = 0; $i < UserVehicle::MAX_NO_OF_CARS; $i++) {
            // 1台目のバリデーションルール
            if ($created_user_role == \App\Enums\UserRoleEnum::Admin->value) {
                // 管理者の場合
                $required_cars_rules["car_name.$i"] = "nullable|max:20|required_with:transport_branch.$i";
                $required_cars_rules["transport_branch.$i"] = "nullable|max:20|required_with:car_name.$i";
            } else {
                // 他のフォームタイプの場合（通常の登録など）
                switch ($i) {
                    case 0:
                        // 1台目
                        $required_cars_rules["car_name.$i"] = "required|max:20|required_with:transport_branch.$i";
                        $required_cars_rules["transport_branch.$i"] = "required|max:20|required_with:car_name.$i";
                        break;

                    default:
                        // 2台目から
                        $required_cars_rules["car_name.$i"] = "max:20|required_with:transport_branch.$i";
                        $required_cars_rules["transport_branch.$i"] = "max:20|required_with:car_name.$i";
                        break;
                }
            }

            // car_class パラメータ（car_class1, car_class2, car_class3）をルール設定
            $carClassSequence = $i + 1;
            $car_class_rules["car_class$carClassSequence"] = 'max:30|in:' . implode(',', array_map(fn($case) => $case->value, CarClassEnum::cases()));
        }

        return array_merge([
            'user_id' => 'nullable',

            // param should be an array
            'sequence_no' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'car_name' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'car_katashiki' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'transport_branch' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'classification_no' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'kana' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,
            'serial_no' => 'required|array|max:' . UserVehicle::MAX_NO_OF_CARS,

            // array element should be string
            'car_katashiki.*' => ['max:20', new HalfWidthString], //バリデーションのエラーメッセージ
            'classification_no.*' => ['max:3', new NumberString], //バリデーションのエラーメッセージ
            'kana.*' => ['max:2', new HKanaString], //バリデーションのエラーメッセージ
            'serial_no.*' => ['max:4', new NumberString], //バリデーションのエラーメッセージ

        ], $required_cars_rules, $car_class_rules);
    }

    public function attributes(): array
    {
        $car_attributes = [];
        for ($i = 0; $i < UserVehicle::MAX_NO_OF_CARS; $i++) {
            $carClassSequence = $i + 1;
            $car_attributes["car_name.$i"] = "車名(" . ($i + 1) . "台目)";
            $car_attributes["car_katashiki.$i"] = "型式(" . ($i + 1) . "台目)";
            $car_attributes["transport_branch.$i"] = "運輸支局(" . ($i + 1) . "台目)";
            $car_attributes["classification_no.$i"] = "分類番号(" . ($i + 1) . "台目)";
            $car_attributes["kana.$i"] = "かな(" . ($i + 1) . "台目)";
            $car_attributes["serial_no.$i"] = "一連指定番号(" . ($i + 1) . "台目)";
            $car_attributes["car_class$carClassSequence"] = "車種区分(" . ($i + 1) . "台目)";
        }
        return array_merge([
            'user_id' => 'ユーザーID',
        ], $car_attributes);
    }
}
