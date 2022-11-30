<?php
namespace App\Tutorials\DependencyInjection\StageTwo;

require('Car.php');
require('Engine.php');

$car = new Car(new Engine());

$car->start();
echo "\n";
$car->drive();
