<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\StoreBalanceHistoryResource;
use App\Repositories\StoreBalanceHistoryRepository;
use Illuminate\Http\Request;

class StoreBalanceHistoryController extends Controller
{
    private StoreBalanceHistoryRepository $storeBalanceHistoryRepository;

    public function __construct(StoreBalanceHistoryRepository $storeBalanceHistoryRepository)
    {
        $this->storeBalanceHistoryRepository = $storeBalanceHistoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $storeBalancesHistory = $this->storeBalanceHistoryRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data RIwayat Dompet Toko Berhasil Diambil', StoreBalanceHistoryResource::collection($storeBalancesHistory),200);
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
            $storeBalancesHistory = $this->storeBalanceHistoryRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page']
            );

            return ResponseHelper::jsonResponse(true, 'Data Riwayat Dompet Toko Berhasil Diambil', PaginateResource::make($storeBalancesHistory, StoreBalanceHistoryResource::class),200);
        } catch (\Exception $e) {
            
            return ResponseHelper::jsonResponse(false, $e->getMessage(),null,500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $storeBalancesHistory = $this->storeBalanceHistoryRepository->getById($id);

            if (!$storeBalancesHistory) {
                return ResponseHelper::jsonResponse(false, 'Data Riwayat Dompet Toko Tidak Ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data Riwayat Dompet Toko Berhasil Diambil', new StoreBalanceHistoryResource($storeBalancesHistory),200);
        } catch (\Throwable $th) {
            return ResponseHelper::jsonResponse(false, $th->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
