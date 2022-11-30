<?php
namespace App\Tutorials\Facades;

class StringModifierFacade{
    public static function __callStatic($method, $arguments)
    {
        app()->make(StringModifier::class)->$method(...$arguments);
    }
}
