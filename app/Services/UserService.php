<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showUser(int $id)
    {
        return $this->userRepository->find($id);
    }

    public function listUser(array $data)
    {
        return $this->userRepository->all($data);
    }
}
