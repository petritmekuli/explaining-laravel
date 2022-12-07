<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StartsWithUppercase2 implements Rule
{
    private $value;
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
    public function passes($attributeName, $attributeValue)
    {
        $this->value = $attributeValue;
        // A => 65, B => 90
        // return ord($attributeValue[0]) >= 65 && ord($attributeValue[0]) <= 90;

        // return strtoupper($attributeValue[0]) === $attributeValue[0];

        return preg_match('/[A-Z]/', $attributeValue[0]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // --invokable it's cleaner and looks simpler but also brings first-party translation support to failure messages,
        // without the need to reach for the translation helper. With invokable we could do something like:
        // return trans()->translate(['value'=>'some value'], 'fr') instead of:

        $this->value[0] = strtoupper($this->value[0]);
        return __(trans('validation.starts_with_uppercase',['validValue'=> $this->value], 'al'));
        // return 'The :attribute must start with Uppercase.';
    }
}
