<?php
namespace App\Repositories;
// use App\Models\User;

class UserRepository{
    public function UserRepository(){
    }

    static function create(){
        $user = \App\Models\User::create([
            'name' => 'Petrit',
            'email' => 'petrit'.rand(1,10000).'@example.com',
            'password' => '11111111',
        ]);
        return $user;
    }
}
