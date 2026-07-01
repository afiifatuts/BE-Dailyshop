<?php 

namespace App\Repositories;

use App\Interface\StoreBalanceRepositoryInterface;
use App\Models\StoreBalance;
use App\Models\User;

class StoreBalanceRepository implements StoreBalanceRepositoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = false)
    {
        $query = StoreBalance::where(function ($query) use ($search) {
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

    public function getById(int $id)
    {
        $query = StoreBalance::where('id', $id);
        return $query->first();
    }
}