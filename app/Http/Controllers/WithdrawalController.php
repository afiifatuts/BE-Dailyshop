<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\WithdrawalApproveRequest;
use App\Http\Requests\WithdrawalStoreRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\WithdrawalResource;
use App\Repositories\WithdrawalRepository;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    private WithdrawalRepository $withdrawalRepository;

    public function __construct(WithdrawalRepository $withdrawalRepository)
    {
        $this->withdrawalRepository = $withdrawalRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $withdrawals = $this->withdrawalRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Penarikan Berhasil Diambil', WithdrawalResource::collection($withdrawals),200);
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
            $withdrawals = $this->withdrawalRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page']
            );

            return ResponseHelper::jsonResponse(true, 'Data Penarikan Berhasil Diambil', PaginateResource::make($withdrawals),200);
        } catch (\Exception $e) {
            
            return ResponseHelper::jsonResponse(false, $e->getMessage(),null,500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WithdrawalStoreRequest $request)
    {
        $request = $request->validated();   

        try {
            $withdrawal = $this->withdrawalRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data Penarikan Berhasil Dibuat', new WithdrawalResource($withdrawal), 201);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $withdrawal = $this->withdrawalRepository->getById($id);

            if (!$withdrawal) {
                return ResponseHelper::jsonResponse(false, 'Data Penarikan Tidak Ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data Penarikan Berhasil Diambil', new WithdrawalResource($withdrawal), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve(WithdrawalApproveRequest $request, string $id)
    {
        $request = $request->validated();
        try {
            $withdrawal = $this->withdrawalRepository->getById($id);

            if (!$withdrawal) {
                return ResponseHelper::jsonResponse(false, 'Data Penarikan Tidak Ditemukan', null, 404);
            }

            $withdrawal = $this->withdrawalRepository->approve($id, $request['proof']);

            return ResponseHelper::jsonResponse(true, 'Data Penarikan Berhasil Disetujui', new WithdrawalResource($withdrawal), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
