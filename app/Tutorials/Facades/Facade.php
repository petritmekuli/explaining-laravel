<?php
namespace App\Tutorials\Facades;

use RuntimeException;

class Facade{
    //Since you don't want to implement __callStatic and a lot of other
    //implementation needed to create facade you typically implement
    //Facade class. This Facade class is an imitation with some basic
    //functionality compare with the real one. But the idea remains the same.

    public static function __callStatic($method, $arguments)
    {
        app()->make(static::getFacadeAccessor())->$method(...$arguments);
    }

    public static function getFacadeAccessor(){
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }
}
