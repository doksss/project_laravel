<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    public function index()
    {

        $products = Product::all();
        $hotel = Hotel::all();
        $typeproduct = TypeProduct::all();
        foreach ($products as $r) {
            $directory = public_path('products/' . $r->id);
            if (File::exists($directory)) {
                $files = File::files($directory);
                $filenames = [];
                foreach ($files as $file) {
                    $filenames[] = $file->getFilename();
                }
                $r['filenames'] = $filenames;
            }
        }
        return view('frontend.product-list', ['products' => $products, 'hotel' => $hotel, 'typeproduct' => $typeproduct]);
    }

    public function show($id)
    {

        $product = Product::find($id);
        if ($product) {
            $directory = public_path('products/' . $product->id);
            if (File::exists($directory)) {
                $files = File::files($directory);
                $filenames = [];
                foreach ($files as $file) {
                    $filenames[] = $file->getFilename();
                }
                $product->filenames = $filenames; // Attach filenames to the product instance
            }
        }
        return view('frontend.product-detail', compact('product'));
    }
    public function addToCart($id)
    {
        $product = Product::find($id);
        // $point=0;
        $cart = session()->get('cart');
        if (!isset($cart[$id])) {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'type_product' => $product->typeproduct->nama_tipe,
                'quantity' => 1,
                'price' => $product->price,
                'photo' => $product->image,
            ];
        } else {
            $cart[$id]['quantity']++;
        }
        session()->put('cart', $cart);
        return redirect()->back()->with("status", "Produk Telah ditambahkan ke Cart");
    }


    public function addQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        $product = Product::find($cart[$id]['id']);
        if (isset($cart[$id])) {
            $jumlahawal = $cart[$id]['quantity'];
            $jumlahpesan = $jumlahawal + 1;
            if ($jumlahpesan <= $product->available_room) {
                $cart[$id]['quantity']++;
            } else {
                return redirect()->back()->with('error', 'jumlah kamar tidak tersedia');
            }
        }
        session()->forget('cart');
        session()->put('cart', $cart);
    }
    public function reduceQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 0) {
                $cart[$id]['quantity']--;
            }
        }
        session()->forget('cart');
        session()->put('cart', $cart);
    }

    public function redeemPoints(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        $total -= 100000;
        if ($total < 0) {
            $total = 0;
        }
        session(['total' => $total]);

        return response()->json(['total' => $total]);
    }



    public function cart()
    {
        return view('frontend.cart');
    }

    public function deleteFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->forget('cart');
        session()->put('cart', $cart);
        return redirect()->back()->with("status", "Produk telah dibuang dari cart");
    }
}
