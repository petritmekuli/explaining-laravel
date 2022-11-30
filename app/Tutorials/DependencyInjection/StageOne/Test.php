<?php

namespace Tutorials\DependencyInjection\StageOne;

/**
 * use Tutorials\DependencyInjection\StageOne\Car;
 * This can't be used because autoloader is going to load only through the requests.
 */

require('Car.php');

$car = new Car();
$car->start();
echo "\n";
$car->drive();

