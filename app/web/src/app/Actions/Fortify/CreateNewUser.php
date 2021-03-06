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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
                                                         // Validate username does not has any invalid chars
            'name' => ['required', 'string', 'max:255', new \App\Rules\ValidChars],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            //'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $name = $input['name'];

        if ($name === "admin")
        {
            $name = "Not_admin";
        }
        return User::create([
            'name' => $name,
            'email' => $input['email'],
            'password' => sha1($input['password']), //Hash::make($input['password']),
        ]);
    }
}
