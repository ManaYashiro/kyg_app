<?php

namespace App\Http\Requests;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role->value == UserRoleEnum::Admin->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $storeId = $this->route('store') ? $this->route('store')->id : null;

        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:stores,email,' . ($storeId ?? 'NULL'),
            'phone_number' => 'required|string|min:10',
            'address' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => '名前は文字列でなければなりません',

            'name_furigana.string' => 'フリガナは文字列でなければなりません',

            'email.email' => 'メールアドレスの形式が正しくありません',
            'email.unique' => 'このメールアドレスはすでに登録されています',

            'phone_number.string' => '電話番号は文字列でなければなりません',
            'phone_number.min' => '電話番号は10桁以上でなければなりません',

            'zipcode.integer' => '郵便番号は整数でなければなりません',

            'address.string' => '住所は文字列でなければなりません',

            'building.string' => '建物名は文字列でなければなりません',
        ];
    }
}
