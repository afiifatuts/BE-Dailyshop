<?php 

namespace App\Repositories;

use App\Interface\StoreRepositoryInterface;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StoreRepository implements StoreRepositoryInterface
{
    public function getAll(?string $search = null,
    ?bool $isVerified = false,
     ?int $limit = null, bool $execute = false)
    {
        $query = Store::where(function ($query) use ($search, $isVerified) {
            if ($search) {
                $query->search($search);
            }

            if ($isVerified !== null) {
            $query->where('is_verified', $isVerified);
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
    public function getAllPaginated(?string $search = null, ?bool $isVerified = false,   ?int $rowPerPage = 10){

    }
}