<?php

namespace App\Http\Requests;

use App\Enums\CallTimeEnum;
use App\Enums\FormTypeEnum;
use App\Enums\GenderEnum;
use App\Enums\IsNewsletterEnum;
use App\Enums\IsNotificationEnum;
use App\Enums\PersonTypeEnum;
use App\Enums\PrefectureEnum;
use App\Enums\SubmitTypeEnum;
use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Rules\HalfWidthString;
use Carbon\Carbon;
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
                    'loginid' => ['required', 'string', 'min:4', 'max:15', 'unique:users,loginid,' . $id, new HalfWidthString],
                    'password' => ['required', 'string', 'min:4', 'max:20', 'confirmed', new HalfWidthString],
                    'password_confirmation' => ['required', 'string', 'min:4', 'max:20', new HalfWidthString],
                ];
                break;
            case FormTypeEnum::USER_UPDATE->value:
                $id = Auth::user()->id;
                $passwordRules = [
                    'password' => ['nullable', 'string', 'min:4', 'max:20', 'confirmed', new HalfWidthString],
                    'password_confirmation' => ['nullable', 'string', 'min:4', 'max:128', new HalfWidthString],
                ];
                break;
            case FormTypeEnum::ADMIN_REGISTER->value:
                $id = $this->route('userList');
                $passwordRules = [
                    'role' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, UserRoleEnum::cases())),
                    'loginid' => ['required', 'string', 'min:4', 'max:15', 'unique:users,loginid,' . $id, new HalfWidthString],
                    'password' => ['required', 'string', 'min:4', 'max:128', 'confirmed', new HalfWidthString],
                    'password_confirmation' => ['required', 'string', 'min:4', 'max:128', new HalfWidthString],
                ];
                break;
            case FormTypeEnum::ADMIN_UPDATE->value:
                $id = $this->route('userList');
                $passwordRules = [
                    'role' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, UserRoleEnum::cases())),
                    'password' => ['nullable', 'string', 'min:4', 'max:128', 'confirmed', new HalfWidthString],
                    'password_confirmation' => ['nullable', 'string', 'min:4', 'max:128', new HalfWidthString],
                ];
                break;
        }
        $userVehicleRequest = new UserVehicleRequest();
        $userVehicleRules = $userVehicleRequest->rules();
        return
            array_merge(
                $passwordRules,
                [
                    'person_type' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, PersonTypeEnum::cases())),
                    'name' => 'required|string|max:40',
                    'name_furigana' => 'required|string|max:40',
                    'gender' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, GenderEnum::cases())),
                    'birthday' => 'nullable|bail|date|before:' . Carbon::now()->subYears(18)->toDateString() . '|after:1924-12-31',
                    'email' => ['required', 'email', 'max:128', 'unique:users,email,' . $id, new HalfWidthString],
                    'phone_number' => ['required', 'string', 'max:11', new HalfWidthString],
                    'address1' => 'required|string|max:128',
                    'address2' => 'nullable|string|max:128',
                    'call_time' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, CallTimeEnum::cases())),
                    'zipcode' => ['required', 'bail', new HalfWidthString, 'digits:7'],
                    'prefecture' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, PrefectureEnum::cases())),
                ],
                $userVehicleRules,
                [
                    'is_receive_newsletter' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, IsNewsletterEnum::cases())),
                    'questionnaire' => 'required|array|min:1|max:3',
                    'manager' => 'nullable|string|max:40',
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
            'min' => 'このテキストは:min文字以上で指定して下さい。',
            'max' => '入力制限をかけているため文字数以上打てない。',
            'in' => ':attributeの選択物を選択してください。',
            'digits' => '入力制限をかけているため文字数以上打てない。',
            'unique' => 'この:attributeはすでに登録されています。',
            'string' => ':attributeは文字列でなければなりません。',

            'email.email' => 'メールアドレスの形式が正しくありません。',

            'password.string' => 'パスワードは文字列でなければなりません。',
            'password.min' => 'パスワードは最低8文字以上でなければなりません。',
            'password.confirmed' => 'パスワードが一致しません。',

            'password_confirmation.string' => 'パスワード確認は文字列でなければなりません。',
            'password_confirmation.min' => 'パスワード確認は最低8文字以上でなければなりません。',

            'phone_number.string' => '電話番号は文字列でなければなりません。',
            'phone_number.min' => '電話番号は10桁以上でなければなりません。',

            'zipcode.integer' => '郵便番号は整数でなければなりません。',

            'questionnaire.required' => '少なくとも1つの:attributeを選択',
            'questionnaire.min' => '少なくとも1:attributeを選択',

            'birthday.before' => '生年月日は、18歳以上である必要があります。',
            'birthday.after' => '生年月日は、1925年以上である必要があります。',
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
            'call_time' => '電話連絡の希望時間帯',
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
