<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneFormat implements Rule
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
        // Remove any non-digit characters from the phone number
        $phoneNumber = preg_replace('/\D/', '', $value);

        // Check if the formatted phone number matches the desired pattern
        return preg_match('/^09\d{9}$/', $phoneNumber) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You must put a phone number with the format 09XXXXXXXXX';
    }
}
