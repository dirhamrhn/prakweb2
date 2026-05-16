<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    protected CategoryService $svc;

    public function __construct(CategoryService $svc)
    {
        $this->svc = $svc;
    }

    // GET ALL
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->svc->all(),
            'message' => 'Berhasil mengambil semua data'
        ]);
    }

    // STORE
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->svc->create($request->validated());

        return response()->json([
            'status' => 'success',
            'data' => $category,
            'message' => 'Kategori berhasil dibuat'
        ], 201);
    }

    // SHOW
    public function show($id)
    {
        try {
            $category = $this->svc->find($id);

            return response()->json([
                'status' => 'success',
                'data' => $category,
                'message' => 'Berhasil mengambil data'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    // UPDATE
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->svc->update($id, $request->validated());

        return response()->json([
            'status' => 'success',
            'data' => $category,
            'message' => 'Kategori berhasil diupdate'
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $this->svc->delete($id);

        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}