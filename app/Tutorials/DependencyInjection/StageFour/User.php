<?php
namespace Tutorials\DependencyInjection\StageFour;

class User{
    protected $name;
    protected $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function userDetails(){
        return 'The user is ' . $this->name . ', and the age is: ' . $this->age;
    }
}

$reflection = new ReflectionClass('User');
// print_r(get_class_methods($reflection));

$user = $reflection->newInstanceArgs(['Petrit', 100]);
print_r($user->userDetails());
