<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RutValidation implements ValidationRule
{
    public function passes($attribute, $value)
    {
        // Elimina cualquier carácter que no sea número del RUT.
        $rut = preg_replace('/[^0-9Kk]/', '', $value);

        if (strlen($rut) !== 9) {
            return false;
        }

        $rut = substr($rut, 0, -1);
        $dv = strtoupper(substr($value, -1));

        $s = 1;
        $m = 0;
        for (; $rut != 0; $rut /= 10) {
            $s = ($s + $rut % 10 * (9 - $m++ % 6)) % 11;
        }

        return $dv == ($s ? $s - 1 : 'K');
    }

    public function message()
    {
        return 'El RUT ingresado no es válido.';
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }
}
