<?php

namespace App\Http\Requests;

use App\Enums\CallTimeEnum;
use App\Enums\FormTypeEnum;
use App\Enums\GenderEnum;
use App\Enums\IsNewsletterEnum;
use App\Enums\IsNotificationEnum;
use App\Enums\PersonTypeEnum;
use App\Enums\SubmitTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisteredUserRequest extends FormRequest
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
        $id = null;
        $passwordRules = [];
        switch ($this->form_type) {
            case FormTypeEnum::USER_REGISTER->value:
                $id = null;
                $passwordRules = [
                    'loginid' => 'required|string|min:4|max:15|unique:users,loginid,' . $id,
                    'password' => 'required|string|min:4|max:20|confirmed',
                    'password_confirmation' => 'required|string|min:4|max:20',
                ];
                break;
            case FormTypeEnum::USER_UPDATE->value:
                $id = Auth::user()->id;
                $passwordRules = [
                    'password' => 'nullable|string|min:4|max:20|confirmed',
                    'password_confirmation' => 'nullable|string|min:4|max:20',
                ];
                break;
            case FormTypeEnum::ADMIN_REGISTER->value:
                $id = $this->route('userList');
                $passwordRules = [
                    'loginid' => 'required|string|min:4|max:15|unique:users,loginid,' . $id,
                    'password' => 'required|string|min:4|max:20|confirmed',
                    'password_confirmation' => 'required|string|min:4|max:20',
                ];
                break;
            case FormTypeEnum::ADMIN_UPDATE->value:
                $id = $this->route('userList');
                $passwordRules = [
                    'password' => 'nullable|string|min:4|max:20|confirmed',
                    'password_confirmation' => 'nullable|string|min:4|max:20',
                ];
                break;

            default:
                # code...
                break;
        }
        $userVehicleRequest = new UserVehicleRequest();
        $userVehicleRules = $userVehicleRequest->rules();
        return
            array_merge(
                $passwordRules,
                [
                    'person_type' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, PersonTypeEnum::cases())),
                    'name' => 'required|string',
                    'name_furigana' => 'required|string',
                    'gender' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, GenderEnum::cases())),
                    'birthday' => 'nullable|date',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'phone_number' => 'required|string|min:10',
                    'address1' => 'required|string',
                    'address2' => 'nullable|string',
                    'call_time' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, CallTimeEnum::cases())),
                    'zipcode' => 'required|numeric|digits:7',
                    'prefecture' => 'required|string',
                ],
                $userVehicleRules,
                [
                    'is_receive_newsletter' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, IsNewsletterEnum::cases())),
                    'questionnaire' => 'required|array|min:1|max:3',
                    'manager' => 'nullable|string|max:128',
                    'department' => 'nullable|string|max:128',
                    'is_receive_notification' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, IsNotificationEnum::cases())),
                    'remarks' => 'nullable|string|max:128',
                    'form_type' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, FormTypeEnum::cases())),
                    'submit_type' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, SubmitTypeEnum::cases())),
                ]
            );
    }

    public function messages(): array
    {
        return [
            'min' => ':attributeは最低:min文字以上でなければなりません',
            'max' => ':attributeは最低:max文字以下でなければなりません',
            'in' => ':attributeの選択物を選択してください',
            'digits' => ':attributeは最低:digits文字ちょどでなければなりません',
            'unique' => 'この:attributeはすでに登録されています',
            'name.string' => '名前は文字列でなければなりません',

            'name_furigana.string' => 'フリガナは文字列でなければなりません',

            'email.email' => 'メールアドレスの形式が正しくありません',

            'password.string' => 'パスワードは文字列でなければなりません',
            'password.min' => 'パスワードは最低8文字以上でなければなりません',
            'password.confirmed' => 'パスワードが一致しません',

            'password_confirmation.string' => 'パスワード確認は文字列でなければなりません',
            'password_confirmation.min' => 'パスワード確認は最低8文字以上でなければなりません',

            'phone_number.string' => '電話番号は文字列でなければなりません',
            'phone_number.min' => '電話番号は10桁以上でなければなりません',

            'zipcode.integer' => '郵便番号は整数でなければなりません',

            'address1.string' => '住所は文字列でなければなりません',

            'address2.string' => '建物名は文字列でなければなりません',
            'questionnaire.required' => '少なくとも1つの:attributeを選択',
            'questionnaire.min' => '少なくとも1:attributeを選択',
        ];
    }

    public function attributes(): array
    {
        $userVehicleRequest = new UserVehicleRequest();
        $userVehicleAttributes = $userVehicleRequest->attributes();
        return array_merge([
            'loginid' => 'ログインID',
            'password' => 'パスワード',
            'password_confirmation' => 'パスワード確認',
            'name' => '顧客名',
            'name_furigana' => 'フリガナ',
            'birthday' => '生年月日',
            'gender' => '性別',
            'email' => 'メールアドレス',
            'person_type' => '法人／個人',
            'call_time' => '電話希望時間',
            'zipcode' => '郵便番号',
            'prefecture' => '都道府県',
            'address1' => '市区町村・番地',
            'address2' => '建物名など',
            'manager' => '担当者',
            'department' => '部署名／支店名',
            'is_receive_newsletter' => 'メルマガ配信',
            'is_receive_notification' => '店からのお知らせメール',
            'questionnaire' => 'アンケート',
        ], $userVehicleAttributes);
    }
}
