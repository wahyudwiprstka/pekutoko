<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Ukm;

class LandingController extends Controller
{
    function index(): mixed
    {
        $products = Product::all();
        $categories = Category::all();
        return view('landing.index', compact('products', 'categories'));
    }

    function category($id): mixed
    {
        $products = Product::where('id_category', $id)->get();
        $categories = Category::all();
        $category = Category::find($id);
        return view('landing.category', compact('products', 'categories', 'category'));
    }

    function search(Request $request): mixed
    {
        $product = $request->query('product');

        if (!$product) {
            return redirect()->route('landing');
        }

        $products = Product::where('product_name', 'like', '%' . $product . '%')->get();
        $categories = Category::all();
        return view('landing.search', compact('products', 'categories'));
    }

    function ukm($id = null): mixed
    {

        if ($id) {
            $ukm = Ukm::find($id);
            $products = Product::where('id_ukm', $id)->get();
            $categories = Category::all();
            return view('landing.search', compact('ukm', 'categories', 'products'));
        } else {
            $categories = Category::all();
            $products = Product::all();
            $ukm = Ukm::all();
            return view('landing.umkm', compact('ukm', 'categories', 'products'));
        }
    }

    function show($id): mixed
    {
        $product = Product::find($id);
        $categories = Category::all();
        $products = Product::all();

        $phoneNumber = $product->ukm->wa_pic;
        $phoneNumber = str_replace('0', '62', $phoneNumber);
        // URL produk
        $productUrl = route('landing.detail', ['id' => $product->id]); // Ganti dengan rute produk Anda

        // Pesan yang akan dikirim
        $message = "Apakah produk ini ($productUrl) tersedia?";
        $encodedMessage = urlencode($message);

        // URL WhatsApp
        $whatsappUrl = "https://wa.me/$phoneNumber?text=$encodedMessage";

        return view('landing.detail', compact('product', 'categories', 'products', 'whatsappUrl'));
    }
}
