<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\StoreBalanceResource;
use App\Interface\StoreBalanceRepositoryInterface;
use App\Repositories\StoreBalanceRepository;
use Illuminate\Http\Request;

class StoreBalanceController extends Controller
{
    private StoreBalanceRepository $storeBalanceRepository;

    public function __construct(StoreBalanceRepository $storeBalanceRepository)
    {
        $this->storeBalanceRepository = $storeBalanceRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $storeBalances = $this->storeBalanceRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Dompet Toko Berhasil Diambil', StoreBalanceResource::collection($storeBalances),200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(),null,500);
        }
    }

    public function getAllPaginated(Request $request){
        $request = $request->validate([
            'search' => 'nullable|string',
            'row_per_page' => 'required|integer'
        ]);

        try {
            $storeBalances = $this->storeBalanceRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page']
            );

            return ResponseHelper::jsonResponse(true, 'Data Dompet Toko Berhasil Diambil', PaginateResource::make($storeBalances),200);
        } catch (\Exception $e) {
            
            return ResponseHelper::jsonResponse(false, $e->getMessage(),null,500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    try {
            $storeBalance = $this->storeBalanceRepository->getById($id);

            if (!$storeBalance) {
                return ResponseHelper::jsonResponse(false, 'Data Dompet Toko Tidak Ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data Dompet Toko Berhasil Diambil', StoreBalanceResource::make($storeBalance), 200);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(false, $th->getMessage(), null, 500);
        }
    }
}
