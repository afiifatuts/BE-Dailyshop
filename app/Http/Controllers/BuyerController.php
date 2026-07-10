<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\BuyerResource;
use App\Interface\BuyerInterface;
use Illuminate\Http\Request;
use App\Http\Requests\BuyerStoreRequest;

class BuyerController extends Controller
{
    private BuyerInterface $buyerRepository;

    public function __construct(BuyerInterface $buyerRepository)
    {
        $this->buyerRepository = $buyerRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $buyers = $this->buyerRepository->getAll(
                $request->search, 
                $request->limit,
                true
            );
            return ResponseHelper::jsonResponse(true, 'Buyers retrieved successfully', BuyerResource::collection($buyers),200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    
    public function getAllPaginated(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
            'row_per_page' => 'required|integer',
        ]);
        try {
            $buyers = $this->buyerRepository->getAllPaginated(
                $request->input('search') ?? null, 
                $request->input('row_per_page')
            );
            return ResponseHelper::jsonResponse(true, 'Data buyer berhasil diambil', PaginateResource::make($buyers, BuyerResource::class),200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BuyerStoreRequest $request)
    {
        $request = $request->validated();
        try {
            $buyer = $this->buyerRepository->create($request);
            return ResponseHelper::jsonResponse(true, 'Buyer created successfully', new BuyerResource($buyer), 201);
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
            $buyer = $this->buyerRepository->getById($id);
            if (!$buyer) {
                return ResponseHelper::jsonResponse(false, 'Buyer not found', null, 404);
            }
            return ResponseHelper::jsonResponse(true, 'Buyer retrieved successfully', new BuyerResource($buyer), 200);
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
}
