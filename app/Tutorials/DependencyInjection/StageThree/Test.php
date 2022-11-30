<?php
namespace Tutorials\DependencyInjection\StageThree;

require('Container.php');
require('Car.php');

$container = new Container();

$container->set(Car::class, function(Container $c){
    return new Car($c->get(Engine::class));
});

/**Setting in this case Engine in service container with laravel container is not necessary.
 * Because by using reflection it can figure it out how to create some object even without
 * registering in service container.
 */
$container->set(Engine::class, function(Container $c){
    return new Engine();
});


$car = $container->get(Car::class);

$car->start();
echo "\n";
$car->drive();
