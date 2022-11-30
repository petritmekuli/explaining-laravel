<?php
namespace App\Tutorials\DependencyInjection\StageTwo;

class Car{
    protected $engine;

    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
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
