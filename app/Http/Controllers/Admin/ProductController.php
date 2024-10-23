<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Satuan;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function index(): mixed
    {
        if (session('userRole') == 'admin' || session('userRole') == 'superadmin') {
            $products = Product::all();
        } else {
            $user = User::find(auth()->user()->id);
            $products = Product::where('id_ukm', $user->ukm->id)->get();
        }
        return view('admin.product.index', compact('products'));
    }

    function create(): mixed
    {
        $categories = Category::all();
        $satuan = Satuan::all();
        return view('admin.product.create', compact('categories', 'satuan'));
    }

    function store(Request $request): mixed
    {
        try {

            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'jml_jual_per_satuan' => 'required|numeric',
                'file' => 'required|image',
            ], [
                'product_name.required' => 'Kolom nama produk diperlukan.',
                'price.required' => 'Kolom harga produk diperlukan.',
                'price.numeric' => 'Kolom harga produk harus berupa angka.',
                'jml_jual_per_satuan.required' => 'Kolom jumlah jual per satuan diperlukan.',
                'jml_jual_per_satuan.numeric' => 'Kolom jumlah jual per satuan harus berupa angka.',
                'description.required' => 'Kolom deskripsi produk diperlukan.',
                'file.required' => 'Kolom gambar produk diperlukan.',
                'file.image' => 'File harus berupa gambar.'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            DB::beginTransaction();

            $user = User::find(auth()->user()->id);

            $product = Product::create([
                'id_ukm' => $user->ukm->id,
                'id_category' => $request->id_category, // tambahkan field category_id pada table
                'id_satuan' => $request->id_satuan, // tambahkan field satuan_id pada table
                'product_name' => $request->product_name,
                'jml_jual_per_satuan' => $request->jml_jual_per_satuan,
                'price' => $request->price,
                'description' => $request->description,
                'product_status' => 1
            ]);

            if ($request->file('file')) {
                // Menyimpan file dan mendapatkan path

                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $filePath = '/uploads/' . $fileName;

                // save data to file model
                File::create([
                    'model_id' => $product->id,
                    'model' => App::make(Product::class)->getTable(),
                    'filename' => $filePath,
                    'type' => 'image'
                ]);
            }

            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    function edit($id): mixed
    {
        $product = Product::find($id);
        $categories = Category::all();
        $satuan = Satuan::all();
        $file = File::where('model_id', $product->id)->where('model', 'products')->first();
        return view('admin.product.edit', compact(
            'product',
            'categories',
            'satuan',
            'file'
        ));
    }

    function update(Request $request): mixed
    {
        try {

            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'jml_jual_per_satuan' => 'required|numeric',
                'file' => 'image',
            ], [
                'product_name.required' => 'Kolom nama produk diperlukan.',
                'price.required' => 'Kolom harga produk diperlukan.',
                'price.numeric' => 'Kolom harga produk harus berupa angka.',
                'jml_jual_per_satuan.required' => 'Kolom jumlah jual per satuan diperlukan.',
                'jml_jual_per_satuan.numeric' => 'Kolom jumlah jual per satuan harus berupa angka.',
                'description.required' => 'Kolom deskripsi produk diperlukan.',
                'file.image' => 'File harus berupa gambar.'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            DB::beginTransaction();

            $product = Product::find($request->id);

            $product->update([
                'id_category' => $request->id_category,
                'id_satuan' => $request->id_satuan, 
                'product_name' => $request->product_name,
                'jml_jual_per_satuan' => $request->jml_jual_per_satuan,
                'price' => $request->price,
                'description' => $request->description,
            ]);

            if ($request->file('file')) {
                // Menyimpan file dan mendapatkan path

                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);

                $filePath = '/uploads/' . $fileName;

                // save data to file model
                $file = File::where('model_id', $product->id)->where('model', 'products')->first();
                if ($file) {
                    $file->update([
                        'filename' => $filePath,
                    ]);
                } else {
                    File::create([
                        'model_id' => $product->id,
                        'model' => App::make(Product::class)->getTable(),
                        'filename' => $filePath,
                        'type' => 'image'
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    function delete($id): mixed
    {
        try {
            $product = Product::find($id);
            $product->delete();

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
