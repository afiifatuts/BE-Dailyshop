<?php 

namespace App\Interface;

use App\Interface\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = false)
    {
        $query = User::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(?string $search = null, ?int $rowPerPage = 10)
    {
        $query = $this->getAll($search, null, false);
        return $query->paginate($rowPerPage);
    }
}