<?php 

namespace App\Repositories;

use App\Interface\StoreBalanceRepositoryInterface;
use App\Models\StoreBalance;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StoreBalanceRepository implements StoreBalanceRepositoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = false)
    {
        $query = StoreBalance::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        })->with(['storeBalanceHistories']);

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
        $query = StoreBalance::where('id', $id)->with(['storeBalanceHistories']);
        return $query->first();
    }

    public function credit(int $storeId, float $amount)
    {
        DB::beginTransaction();
        try {
            $storeBalance = StoreBalance::find($storeId);
            $storeBalance->balance = bcadd($storeBalance->balance, $amount, 2);
            $storeBalance->save();
            DB::commit();

            return $storeBalance;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function debit(int $storeId, float $amount)
    {
        DB::beginTransaction();
        try {
            $storeBalance = StoreBalance::find($storeId);

            if (bccomp($storeBalance->balance, $amount, 2) < 0) {
                throw new \Exception('Saldo tidak mencukupi');
            }

            $storeBalance->balance = bcsub($storeBalance->balance, $amount, 2);
            $storeBalance->save();
            DB::commit();

            return $storeBalance;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
}