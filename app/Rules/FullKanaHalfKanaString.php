<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FullKanaHalfKanaString implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[\x{30A0}-\x{30FF}\x{FF61}-\x{FF9F}]*$/u', $value)) {
            $fail('フリガナはカタカナで入力してください。');
        }
    }
}
