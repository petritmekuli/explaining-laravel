<?php
namespace Tutorials\DependencyInjection\StageFour;
// require ('Engine.php');

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
            echo "Driving \n";
        }else{
            echo "Start the engine first \n";
        }
    }
}
