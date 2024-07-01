<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $cart = session()->get('cart');
        if (!isset($cart[$id])) {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
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

    public function cart(){
        return view('frontend.cart');
    }
}
