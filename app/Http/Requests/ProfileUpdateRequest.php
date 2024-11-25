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
            'furigana' => 'required|string',
            'email' => 'required|string|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8|same:password',
            'phone_number' => 'required|string|min:10',
            'post_code' => 'required|integer',
            'address' => 'required|string',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.string' => '名前は文字列でなければなりません',

            'furigana.string' => 'フリガナは文字列でなければなりません',

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

            'post_code.integer' => '郵便番号は整数でなければなりません',

            'address.string' => '住所は文字列でなければなりません',

            'building.string' => '建物名は文字列でなければなりません',
        ];
    }
}
