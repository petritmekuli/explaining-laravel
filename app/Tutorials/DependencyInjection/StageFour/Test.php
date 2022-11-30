<?php
namespace Tutorials\DependencyInjection\StageFour;

require ('Container.php');
require ('Engine.php');
require ('Car.php');

$container = new Container();

//! Try commenting and uncommenting $container->set() to see the difference
//! when dependency comes from auto-wiring or service provider array.

// $container->set(Car::class, function(Container $c){
//     return new Car($c->get(Engine::class));
// });

// $container->set(Engine::class, function(Container $c){
//     return new Engine();
// });

$car = $container->get(Car::class);

$car->start();
$car->drive();
