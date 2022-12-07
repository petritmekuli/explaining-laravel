<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\App;

class StartsWithUppercase implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attributeName, $attributeValue, $fail)
    {
        //Testing in albanian
        App::setLocale('al');

        if(! preg_match('/[A-Z]/', $attributeValue[0])){
            $attributeValue[0] = strtoupper($attributeValue[0]);
            // Get the error message from the lang/en/validation.php file
            $fail(trans('validation.starts_with_uppercase'))->translate([
                'validValue' => $attributeValue,
            ], 'al');

            // $fail("The $attributeName field must start with Uppercase.");
        }
        App::setLocale('en');
    }
}
