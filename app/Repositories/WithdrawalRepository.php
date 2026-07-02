<?php 

namespace App\Repositories;

use App\Interface\WithdrawalInterface;
use App\Models\StoreBalanceHistory;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;

class WithdrawalRepository implements WithdrawalInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = false)
    {
        $query = Withdrawal::where(function ($query) use ($search) {
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