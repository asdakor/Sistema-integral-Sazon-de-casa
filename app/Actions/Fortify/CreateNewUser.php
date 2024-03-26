<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nombre' => ['required', 'string', 'max:255'],
            'rut' => ['required', 'string', 'max:9', 'unique:users'],
            'apellidop' => ['required', 'string', 'max:255'],
            'apellidom' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'fecha_ingreso' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'rut' => $input['rut'],
            'nombre' => $input['nombre'],
            'apellidop' => $input['apellidop'],
            'apellidom' => $input['apellidom'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'fecha_ingreso' => $input['fecha_ingreso'],
            'email' => $input['email'],
            'rol' => 1,
            'password' => Hash::make($input['password']),
        ]);
    }
}
