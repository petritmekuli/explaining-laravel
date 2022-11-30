<?php
namespace App\Tutorials\Facades;

class StringModifier{

    public function reverse($string){
        $reversedStr = '';

        for($i = strlen($string)-1; $i>=0; $i--){
            $reversedStr .= $string[$i];
        }
        echo $reversedStr;
        return $reversedStr;
    }

    //Suppose there are a lot of other useful methods for string modification.
}
