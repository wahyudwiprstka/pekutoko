<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(): mixed
    {
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    public function create(): mixed
    {
        return view('admin.category.create');
    }

    public function store(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required|string|max:255',
            ], [
                'category_name.required' => 'Kolom nama kategori diperlukan.',
                'category_name.string' => 'Kolom nama kategori harus berupa teks.',
                'category_name.max' => 'Kolom nama kategori tidak boleh lebih dari :max karakter.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            Category::create([
                'category_name' => $request->category_name
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function edit($id): mixed
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required|string|max:255',
            ], [
                'category_name.required' => 'Kolom nama kategori diperlukan.',
                'category_name.string' => 'Kolom nama kategori harus berupa teks.',
                'category_name.max' => 'Kolom nama kategori tidak boleh lebih dari :max karakter.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $category = Category::find($request->id);
            if (!$category) {
                return response()->json([
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'Kategori tidak ditemukan.'
                ], 404);
            }

            $category->update([
                'category_name' => $request->category_name
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function delete($id): mixed
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan.'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}
