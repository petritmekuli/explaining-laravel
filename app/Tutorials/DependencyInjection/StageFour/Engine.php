<?php
namespace Tutorials\DependencyInjection\StageFour;

class Engine{
    protected $running;
    // protected $roundsPerMinute;

    public function startEngine(){
        $this->running = true;
        echo "Engine started \n";
    }

    public function isRunning(){
        return $this->running;
    }
}
