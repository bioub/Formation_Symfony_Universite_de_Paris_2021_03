<?php


namespace App\Manager;


use App\Entity\User;
use App\Repository\UserRepository;

class UserManager
{
    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): array
    {
        return $this->userRepository->findBy([], [], 100);
    }

    public function getById($id): User
    {
        return $this->userRepository->find($id);
    }
}