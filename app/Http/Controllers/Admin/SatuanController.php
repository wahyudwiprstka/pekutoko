<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Satuan;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuan = Satuan::all();

        return view('admin.satuan.index', compact('satuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ], [
                'name.required' => 'Kolom nama satuan diperlukan.',
                'name.string' => 'Kolom nama satuan harus berupa teks.',
                'name.max' => 'Kolom nama satuan tidak boleh lebih dari :max karakter.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            Satuan::create([
                'name' => $request->name
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $satuan = Satuan::find($id);
        return view('admin.satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ], [
                'name.required' => 'Kolom nama satuan diperlukan.',
                'name.string' => 'Kolom nama satuan harus berupa teks.',
                'name.max' => 'Kolom nama satuan tidak boleh lebih dari :max karakter.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $satuan = Category::find($request->id);
            if (!$satuan) {
                return response()->json([
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'Satuan tidak ditemukan.'
                ], 404);
            }

            $satuan->update([
                'name' => $request->name
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $satuan = Satuan::find($id);

        if (!$satuan) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Satuan tidak ditemukan.'
            ], 404);
        }

        $satuan->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Satuan berhasil dihapus.'
        ]);
    }
}
