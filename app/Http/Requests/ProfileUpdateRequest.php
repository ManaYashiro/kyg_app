<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = ($this->route('userList') ? $this->route('userList') : Auth::user()->id);
        $rules = [
            'name' => 'required|string',
            'name_furigana' => 'required|string',
            'loginid' => 'required|string|unique:users,loginid,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8|same:password',
            'phone_number' => 'required|string|min:10',
            'zipcode' => 'required|integer',
            'prefecture' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.string' => '名前は文字列でなければなりません',

            'name_furigana.string' => 'フリガナは文字列でなければなりません',

            'email.email' => 'メールアドレスの形式が正しくありません',
            'email.unique' => 'このメールアドレスはすでに登録されています',

            'password.string' => 'パスワードは文字列でなければなりません',
            'password.min' => 'パスワードは最低8文字以上でなければなりません',
            'password.confirmed' => 'パスワードが一致しません',

            'password_confirmation.string' => 'パスワード確認は文字列でなければなりません',
            'password_confirmation.min' => 'パスワード確認は最低8文字以上でなければなりません',
            'password_confirmation.same' => '確認用パスワードはパスワードと一致していなければなりません',

            'phone_number.string' => '電話番号は文字列でなければなりません',
            'phone_number.min' => '電話番号は10桁以上でなければなりません',

            'zipcode.integer' => '郵便番号は整数でなければなりません',

            'address1.string' => '住所は文字列でなければなりません',

            'address2.string' => '建物名は文字列でなければなりません',
        ];
    }
}
