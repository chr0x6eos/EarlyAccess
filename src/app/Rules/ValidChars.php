<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidChars implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Only chars and numbers are allowed
        return  preg_match('/^[a-z0-9_\- ]+$/i', $value) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute contains invalid characters!';
    }
}
