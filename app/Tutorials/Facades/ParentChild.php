<?php
namespace App\Tutorials\Facades;

/**
 * This class stands only to show some relationships between parent
 * and child classes.
 */
class Parentt{
    protected $name;
    protected $lastName = 'Mekuli';

    public function __construct($name, $lastName)
    {
        $this->name = $name;
        $this->lastName = $lastName;
    }

    public function getName(){
        return $this->name;
    }

    public function getLastName(){
        return $this->lastName;
    }
}

class Child extends Parentt{
    protected $name;
    protected $lastName = 'MekuliSecond';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
}

$child = new Child('Petrit');
// echo($child->getName());
echo($child->getLastName());
