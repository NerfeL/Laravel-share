<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsNotExecutableFile implements Rule
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

    private $excludedExtensions = ['php', 'exe'];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !in_array(strtolower($value->getClientOriginalExtension()), $this->excludedExtensions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The file cannot have an extensions: '. implode(', ',  $this->excludedExtensions);
    }
}
