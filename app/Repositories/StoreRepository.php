<?php 

namespace App\Repositories;

use App\Interface\StoreRepositoryInterface;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Override;

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
        $query = $this->getAll($search, null, false);
        return $query->paginate($rowPerPage);
    }

    public function getById(string $id)
    {
        $query = Store::where('id',$id);
        return $query->first();
    }

    public function create(array $data){
        DB::beginTransaction();
        try {
            $store = new Store;
            $store->user_id = $data['user_id'];
            $store->name = $data['name'];
            $store->logo = $data['logo']->store('assets/store','public');
            $store->about = $data['about'];
            $store->phone = $data['phone'];
            $store->address_id = $data['address_id'];
            $store->city = $data['city'];

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}