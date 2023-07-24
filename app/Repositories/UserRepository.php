<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function all(array $data)
    {
        $user = User::orderBy(
            $data['sort'] ?? 'id',
            $data['sortType'] ?? 'desc');
        return $user->paginate($data['perPage'] ?? 15);
    }

    public function find(int $id)
    {
        return User::findOrFail($id);
    }
}
