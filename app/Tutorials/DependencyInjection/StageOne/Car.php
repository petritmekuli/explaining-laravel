<?php
namespace Tutorials\DependencyInjection\StageOne;
require('Engine.php');

class Car{
    protected $engine;

    public function __construct()
    {
        //Creating new object inside the class constructor means tight coupling.
        //We want loose coupling. Look at the D inside the SOLID principles.
        //Also info/D_in_SOLID_Principle.txt
        $this->engine = new Engine();
    }

    public function start(){
        $this->engine->startEngine();
    }
    public function drive(){
        if($this->engine->isRunning()){
            echo 'driving';
        }else{
            echo 'Start the engine first';
        }
    }
}
