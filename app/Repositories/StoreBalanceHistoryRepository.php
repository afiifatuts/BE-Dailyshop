<?php 

namespace App\Repositories;

use App\Interface\StoreBalanceHistoryInterface;
use App\Models\StoreBalanceHistory;
use Illuminate\Support\Facades\DB;

class StoreBalanceHistoryRepository implements StoreBalanceHistoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = false)
    {
        $query = StoreBalanceHistory::where(function ($query) use ($search) {
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

    public function getById(string $id)
    {
        $query = StoreBalanceHistory::where('id', $id);
        return $query->first();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $storeBalanceHistory = new StoreBalanceHistory();
            $storeBalanceHistory->store_balance_id = $data['store_balance_id'];  
            $storeBalanceHistory->reference_id = $data['reference_id'];
            $storeBalanceHistory->reference_type = $data['reference_type'];
            $storeBalanceHistory->type = $data['type'];
            $storeBalanceHistory->amount = $data['amount'];
            $storeBalanceHistory->remarks = $data['remarks'];

            DB::commit();

            return $storeBalanceHistory;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage())  ;
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();
        try {
            $storeBalanceHistory = StoreBalanceHistory::findOrFail($id);
            $storeBalanceHistory->reference_id = $data['reference_id'];
            $storeBalanceHistory->reference_type = $data['reference_type'];
            $storeBalanceHistory->type = $data['type'];
            $storeBalanceHistory->amount = $data['amount'];
            $storeBalanceHistory->remarks = $data['remarks'];

            DB::commit();

            return $storeBalanceHistory;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage())  ;
        }
    }
}