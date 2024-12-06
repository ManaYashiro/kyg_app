<?php

namespace App\Http\Requests;

use App\Enums\CallTimeEnum;
use App\Enums\GenderEnum;
use App\Enums\IsNewsletterEnum;
use App\Enums\IsNotificationEnum;
use Illuminate\Foundation\Http\FormRequest;

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
        $userVehiclesRequest = new UserVehiclesRequest();
        $userVehiclesRules = $userVehiclesRequest->rules();
        return
            array_merge(
                [
                    'loginid' => 'required|string|unique:users,loginid|min:4|max:15',
                    'name' => 'required|string',
                    'name_furigana' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|string|min:4|max:20|confirmed',
                    'password_confirmation' => 'required|string|min:4|max:20',
                    'gender' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, GenderEnum::cases())),
                    'birthday' => 'required|date',
                    'phone_number' => 'required|string|min:10',
                    'zipcode' => 'required|numeric|digits:7',
                    'prefecture' => 'required|string',
                    'address1' => 'required|string',
                    'address2' => 'nullable|string',
                    'call_time' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, CallTimeEnum::cases())),
                ],
                $userVehiclesRules,
                [
                    'questionnaire' => 'required|array|min:1',
                    'manager' => 'nullable|string',
                    'department' => 'nullable|string',
                    'remarks' => 'nullable|string',
                    'is_receive_newsletter' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, IsNewsletterEnum::cases())),
                    'is_receive_notification' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, IsNotificationEnum::cases())),
                    'form_type' => 'required|in:"confirm","submit"',
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
        $userVehiclesRequest = new UserVehiclesRequest();
        $userVehiclesAttributes = $userVehiclesRequest->attributes();
        return array_merge([
            'loginid' => 'ログインID',
            'call_time' => '電話希望時間',
            'is_receive_newsletter' => 'メルマガ配信',
            'is_receive_notification' => '店からのお知らせメール',
            'questionnaire' => 'アンケート',
        ], $userVehiclesAttributes);
    }
}
