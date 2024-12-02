<?php

namespace App\Http\Requests;

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
        return [
            'loginid' => 'required|string|min:4|max:10',
            'name' => 'required|string',
            'furigana' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'phone_number' => 'required|string|min:10',
            'post_code' => 'required|integer',
            'address' => 'required|string',
            'preferred_contact_time' => 'required|in:9-12,12-13,13-15,15-17,17-19,no_preference',
            'is_receive_newsletter' => 'nullable|in:0,1',
            'is_receive_notification' => 'required|in:0,1',
            'how_did_you_hear' => 'required|array|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'min' => ':attributeは最低:min文字以上でなければなりません',
            'mmax' => ':attributeは最低:mmax文字以下でなければなりません',
            'name.string' => '名前は文字列でなければなりません',

            'furigana.string' => 'フリガナは文字列でなければなりません',

            'email.email' => 'メールアドレスの形式が正しくありません',
            'email.unique' => 'このメールアドレスはすでに登録されています',

            'password.string' => 'パスワードは文字列でなければなりません',
            'password.min' => 'パスワードは最低8文字以上でなければなりません',
            'password.confirmed' => 'パスワードが一致しません',

            'password_confirmation.string' => 'パスワード確認は文字列でなければなりません',
            'password_confirmation.min' => 'パスワード確認は最低8文字以上でなければなりません',

            'phone_number.string' => '電話番号は文字列でなければなりません',
            'phone_number.min' => '電話番号は10桁以上でなければなりません',

            'post_code.integer' => '郵便番号は整数でなければなりません',

            'address.string' => '住所は文字列でなければなりません',

            'building.string' => '建物名は文字列でなければなりません',
            'how_did_you_hear.required' => '少なくとも1つの:attributeを選択',
            'how_did_you_hear.min' => '少なくとも1:attributeを選択',
        ];
    }

    public function attributes(): array
    {
        return [
            'loginid' => 'ログインID',
            'preferred_contact_time' => '電話希望時間',
            'is_receive_newsletter' => 'メルマガ配信',
            'is_receive_notification' => '店からのお知らせメール',
            'how_did_you_hear' => 'アンケート',
        ];
    }
}
