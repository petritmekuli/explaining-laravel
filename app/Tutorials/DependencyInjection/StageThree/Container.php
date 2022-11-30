<?php
namespace Tutorials\DependencyInjection\StageThree;

class Container{
    protected $bindings = [];

    public function set($abstract, callable $factory){
        $this->bindings[$abstract] = $factory;
    }

    public function get($abstract){
        return $this->bindings[$abstract]($this);
    }
    /**
     * $this->bindings[$abstract] works similar like:
     * $func = 'setName';
     * $func('SomeName');
     *
     * and ($this) is the param, actually the Container object. Which it is passed to the
     * callable function stored in the bindings array.
     */
}
