<?php
namespace Tutorials\DependencyInjection\StageFour;

use ReflectionClass;
use RuntimeException;

class Container{
    protected $bindings = [];

    public function set($abstract, callable $factory){
        $this->bindings[$abstract] = $factory;
    }

    public function get($abstract){
        if(isset($this->bindings[$abstract])){
            var_dump('from the service provider');
            return $this->bindings[$abstract]($this);
        }

        //? The key to auto-wiring is recursion.
        $reflection = new ReflectionClass($abstract);
        $dependencies = $this->buildDependencies($reflection);

        var_dump('from auto-wiring');
        return $reflection->newInstanceArgs($dependencies);
    }

    private function buildDependencies($reflection){
        if(!$constructor = $reflection->getConstructor()){
            return [];
        }

        $params = $constructor->getParameters();
        return array_map(function($param){
            if(!$type = $param->getType()){
                throw new RuntimeException();
            }
            /* $param->getType() or $type without this empty string ''
            concatenation it is not working. It is returning
            ReflectionNamedType object instead of string. Strange thing. */
            // var_dump($param->getType());
            // var_dump($type.'');
            return $this->get($type . '');
        }, $params);
    }
}
