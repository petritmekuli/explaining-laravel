<?php
namespace App\Tutorials\DependencyInjection\StageTwo;

class Engine{
    protected $running;
    // protected $roundsPerMinute;

    public function startEngine(){
        $this->running = true;
        echo 'Engine started';
    }

    public function isRunning(){
        return $this->running;
    }
}
