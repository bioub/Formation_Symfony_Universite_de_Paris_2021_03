<?php


namespace App\Manager;


use App\Entity\User;

class UserManager
{
    public function getAll(): array
    {
        return [
            (new User())->setId(1)->setFirstName('A')->setLastName('B'),
            (new User())->setId(2)->setFirstName('C')->setLastName('D'),
        ];
    }

    public function getById($id): User
    {
        return (new User())->setId($id)->setFirstName('A')->setLastName('B');
    }
}