<?php
namespace App\Tutorials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facades functionality is similar to dependency injection and helpers.
 * With helpers I believe is identical because they are like wrappers and
 * deep down both use the same classes. However when facade is compared
 * with dependency injection, I could say that dependency injection has
 * the ability to swap implementations of the injected classes.
 */
class StringModifierFacade extends Facade{
    public static function getFacadeAccessor(){
        return 'stringModifier';
    }
}
