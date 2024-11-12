<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Ukm;
use App\Models\Order;
use App\Services\Ipaymu\IpaymuService;
class LandingController extends Controller
{
    function __construct(
        protected IpaymuService $ipaymuService 
    ){}

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

    function addToCart(Request $request, $id): mixed {

        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "product_id" => $id,
                "quantity" => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('landing.show-cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');    
    }

    function showCart(): mixed {
        $cart = session()->get('cart', []);
        $categories = Category::all();
        $products = [];
        $totalPrice = 0;

        foreach ($cart as $key => $value) {
            $product = Product::where('id', $value['product_id'])->first();
            
            if ($product) { // Check if the product exists
                $product->quantity = $value['quantity'];
                $totalPrice += $product->price * $product->quantity;
                $products[] = $product;
            }
        }
    
        return view('landing.cart', compact('products', 'categories', 'totalPrice'));
    }

    function removeCart(): mixed {
        session()->forget('cart');
        return redirect()->route('landing.show-cart')->with('success', 'Keranjang berhasil dihapus!');
    }

    function removeCartProduct($id): mixed {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->route('landing.show-cart')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    function checkout(): mixed {
        $cart = session()->get('cart', []);
        $categories = Category::all();
        $products = [];
        $totalPrice = 0;

        foreach ($cart as $key => $value) {
            $product = Product::where('id', $value['product_id'])->first();
            
            if ($product) { // Check if the product exists
                $product->quantity = $value['quantity'];
                $totalPrice += $product->price * $product->quantity;
                $products[] = $product;
            }
        }

        return view('landing.checkout', compact('products', 'categories', 'totalPrice'));
    }

    function processCheckout(Request $request) : mixed {
        $cart = session()->get('cart', []);
        $productName = [];
        $qty = [];
        $price = [];
        $description = [];

        foreach ($cart as $key => $value) {
            $product = Product::where('id', $value['product_id'])->first();
        
            if ($product) {
                $product->quantity = $value['quantity'];
                $product->total_price = $product->price * $product->quantity;

                $productName[] = $product->product_name;
                $qty[] = $product->quantity;
                $price[] = $product->price;
                $description[] = '-';
        
                $newProductDetail = [
                    'product_id' => $product->id,
                    'name' => $product->product_name,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                    'total_price' => $product->total_price,
                ];
    
                $order = Order::where('id_ukm', $product->id_ukm)->first();
        
                if ($order) {
                    $existingOrderDetails = json_decode($order->order_detail, true);
    
                    $existingOrderDetails[] = $newProductDetail;
        
                    $order->update([
                        'full_name' => $request->input('full_name'),
                        'address' => $request->input('address'),
                        'regency' => $request->input('regency'),
                        'postal_code' => $request->input('postal_code'),
                        'phone_number' => $request->input('phone_number'),
                        'email' => $request->input('email'),
                        'notes' => $request->input('notes'),
                        'order_detail' => json_encode($existingOrderDetails),
                    ]);
                } else {
                    Order::create([
                        'id_ukm' => $product->id_ukm,
                        'full_name' => $request->input('full_name'),
                        'address' => $request->input('address'),
                        'regency' => $request->input('regency'),
                        'postal_code' => $request->input('postal_code'),
                        'phone_number' => $request->input('phone_number'),
                        'email' => $request->input('email'),
                        'notes' => $request->input('notes'),
                        'order_detail' => json_encode([$newProductDetail]),
                    ]);
                }
            }
        }

        // prepare data for ipaymu
        $data = [
            'product' => $productName,
            'qty' => $qty,
            'price' => $price,
            'returnUrl' => 'http://localhost.com',
            'notifyUrl' => 'http://localhost.com',
            'cancelUrl' => 'http://localhost.com',
            'buyerName' => $request->input('full_name'),
            'lang' => 'id'
        ];

        $resp = $this->ipaymuService->createPayment($data);

        return "ok";
        
    }
}
