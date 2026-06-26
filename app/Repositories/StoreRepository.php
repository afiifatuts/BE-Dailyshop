<?php 

namespace App\Repositories;

use App\Interface\StoreRepositoryInterface;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StoreRepository implements StoreRepositoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = false)
    {
        $query = Store::where(function ($query) use ($search) {
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
    public function getAllPaginated(?string $search = null, ?int $rowPerPage = 10){

    }
}