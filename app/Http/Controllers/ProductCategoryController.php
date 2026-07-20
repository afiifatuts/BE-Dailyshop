<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\ProductCategoryResource;
use App\Interface\ProductCategoryInterface;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private ProductCategoryInterface $productCategoryRepository;

    public function __construct(ProductCategoryInterface $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $productCategories = $this->productCategoryRepository->getAll(
                $request->search, 
                $request->limit,
                true
            );
            return ResponseHelper::jsonResponse(true, 'Product categories retrieved successfully', ProductCategoryResource::collection($productCategories),200);
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
            $productCategories = $this->productCategoryRepository->getAllPaginated(
                $request->input('search') ?? null, 
                $request->input('row_per_page')
            );
            return ResponseHelper::jsonResponse(true, 'Data product category berhasil diambil', PaginateResource::make($productCategories, ProductCategoryResource::class),200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
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
        //
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
