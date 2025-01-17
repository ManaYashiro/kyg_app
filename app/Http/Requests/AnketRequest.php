<?php

namespace App\Http\Requests;

use App\Enums\FormTypeEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AnketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role === UserRoleEnum::Admin->value; // 修正: 「==」から「===」に変更
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 初期のルール
        $rules = [
            'name' => 'required|string',
            'short_name' => 'required|string',
        ];

        // form_type が ADMIN_REGISTER または ADMIN_UPDATE の場合
        if (in_array($this->form_type, [FormTypeEnum::ADMIN_REGISTER->value, FormTypeEnum::ADMIN_UPDATE->value])) {
            $rules['name'] = 'nullable|string';  // 'name'はnullable
            $rules['short_name'] = 'nullable|string';  // 'short_name'もnullable
        }

        return $rules;
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'string' => ':attributeは文字列でなければなりません',
            'required' => ':attributeは必要です',
        ];
    }
}
