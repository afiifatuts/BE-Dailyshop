<?php 

namespace App\Repositories;

use App\Interface\ProductCategoryInterface;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Override;

class ProductCategoryRepository implements ProductCategoryInterface
{
    public function getAll(?string $search = null,
     ?int $limit = null, bool $execute = false)
    {
        $query = ProductCategory::where(function ($query) use ($search) {
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
    public function getAllPaginated(?string $search = null,  ?int $rowPerPage = 10){
        $query = $this->getAll($search, null, false);
        return $query->paginate($rowPerPage);
    }

    public function getById(string $id)
    {
        $query = ProductCategory::where('id', $id);
        return $query->first();
    }

}