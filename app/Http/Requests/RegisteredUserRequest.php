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
use App\Rules\HalfWidthString;
use App\Rules\NumberString;
use App\Rules\FullKanaHalfKanaString;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
                    'loginid' => ['required', 'string', 'min:4', 'max:120', 'unique:users,loginid,' . $id, new HalfWidthString],
                    'password' => ['required', 'string', 'min:4', 'max:20', 'confirmed', new HalfWidthString],
                    'password_confirmation' => ['required', 'string', 'min:4', 'max:20', new HalfWidthString],
                ];
                break;
            case FormTypeEnum::USER_UPDATE->value:
                $id = Auth::user()->id;
                $passwordRules = [
                    'password' => ['nullable', 'string', 'min:4', 'max:20', 'confirmed', new HalfWidthString],
                    'password_confirmation' => ['nullable', 'string', 'min:4', 'max:20', new HalfWidthString],
                ];
                break;
            case FormTypeEnum::ADMIN_REGISTER->value:
                $id = $this->route('userList');
                $passwordRules = [
                    'role' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, UserRoleEnum::cases())),
                    'loginid' => ['required', 'string', 'min:4', 'max:120', 'unique:users,loginid,' . $id, new HalfWidthString],
                    'password' => ['required', 'string', 'min:4', 'max:20', 'confirmed', new HalfWidthString],
                    'password_confirmation' => ['required', 'string', 'min:4', 'max:20', new HalfWidthString],
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
        // ユーザー情報の基本的なバリデーションルール
        $otherData = [
            'person_type' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, PersonTypeEnum::cases())),
            'name' => 'required|string|max:40',
            'name_furigana' => ['required', 'string', 'max:40', new FullKanaHalfKanaString],
            'gender' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, GenderEnum::cases())),
            'birthday' => 'nullable|bail|date|before_or_equal:today',
            'email' => ['required', 'email', 'max:128', 'unique:users,email,' . $id, new HalfWidthString],
            'phone_number' => ['required', 'string', 'digits_between:10,11', new NumberString],
            // address1, address2, call_time, zipcode, prefecture のバリデーションルールを変更
            'call_time' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, CallTimeEnum::cases())), // 管理者の場合は必須ではなくなりnullableに変更
            'address1' => 'required|string|max:128', // 管理者の場合は必須ではなくなりnullableに変更
            'address2' => 'nullable|string|max:128', // 管理者の場合は必須ではなくなりnullableに変更
            'zipcode' => ['required', 'bail', new NumberString, 'digits:7'], // 管理者の場合は必須ではなくなりnullableに変更
            'prefecture' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, PrefectureEnum::cases())), // 管理者の場合は必須ではなくなりnullableに変更
            'questionnaire' => 'required|array|min:1|max:3',
            'is_receive_notification' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, IsNotificationEnum::cases())),
        ];

        // 車両情報のバリデーションルールを取得
        Session::put("created_user_role", $this->role);
        $userVehicleRequest = new UserVehicleRequest();
        $userVehicleRules = $userVehicleRequest->rules();

        // 管理者フォームタイプの時に変更するバリデーションルールを適用
        if (in_array($this->form_type, [FormTypeEnum::ADMIN_REGISTER->value, FormTypeEnum::ADMIN_UPDATE->value])) {
            $otherData['person_type'] = 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, PersonTypeEnum::cases()));
            $otherData['address1'] = 'nullable|string|max:128';
            $otherData['call_time'] = 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, CallTimeEnum::cases()));
            $otherData['zipcode'] = ['nullable', 'bail', new NumberString, 'digits:7'];
            $otherData['prefecture'] = 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, PrefectureEnum::cases()));
            $otherData['questionnaire'] = 'nullable|array|min:1|max:3';
            $otherData['is_receive_notification'] = 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, IsNotificationEnum::cases()));
        }

        return
            array_merge(
                $passwordRules, // パスワードに関するルール
                $otherData,
                $userVehicleRules,
                [
                    'is_receive_newsletter' => 'nullable|in:' . implode(',', array_map(fn($case) => $case->value, IsNewsletterEnum::cases())),
                    'manager' => 'nullable|string|max:40',
                    'department' => 'nullable|string|max:128',
                    'remarks' => 'nullable|string|max:128',
                    'form_type' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, FormTypeEnum::cases())),
                    'submit_type' => 'required|in:' . implode(',', array_map(fn($case) => $case->value, SubmitTypeEnum::cases())),
                ]
            );
    }

    public function messages(): array
    {
        return [
            'min' => 'ログインIDは:min文字以上で入力してください。',
            'max' => ':attribute は :max 以下でなければなりません。',
            'in' => ':attributeの選択物を選択してください。',
            'digits' => ':attribute は :digits 桁でなければなりません。',
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
            'phone_number.digits_between' => '[電話番号]は不正です。',

            'zipcode.integer' => '郵便番号は整数でなければなりません。',
            'zipcode.digits' => '郵便番号は7桁で入力してください。',
            'zipcode.regex' => '数字を入力してください。',

            'questionnaire.required' => '少なくとも1つの:attributeを選択してください。',
            'questionnaire.max' => ':attribute は :maxつまで選択してください。',
            'questionnaire.min' => '少なくとも1つの:attributeを選択を選択してください。',

            'birthday.before_or_equal' => '［生年月日］は正しい日付を入力してください。',
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
