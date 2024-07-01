<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use PDOException;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        $hotel = Hotel::all();
        // dd($product); ini untuk melihat isi array hanya berlaku di laravel
        foreach ($product as $r) {
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

        return view('product.index', ['data' => $product, 'hotel' => $hotel]); //ini ke folder product yaitu file index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotel = Hotel::all();
        return view('product.formcreate', ['data' => $hotel]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Product();
        $data->name = $request->get('name_product'); //ambil name dari textfieldnya
        $data->price = $request->get('price_product'); //ambil name dari textfieldnya
        $data->hotel_id = $request->get('hotel_product'); //ambil name dari textfieldnya
        $data->image = ""; //ambil name dari textfieldnya
        $data->available_room = $request->get('available_room'); //ambil name dari textfieldnya
        $data->type_product = $request->get('typeproduct'); //ambil name dari textfieldnya
        $data->save();

        //confirmation
        return redirect()->route('laralux.index')->with('status', 'Hooray ! your data is successfully recorded!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::find($id);
        // dd($data); //untuk melihat data kek print_r
        // return view('product.show',['data'=>$data]);
        return view('product.show', compact('data')); //bisa juga pake compact atau ['data'=>$data]
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotel = Hotel::all();
        $data = Product::find($id);
        return view('product.edit', ['data' => $data, 'hotel' => $hotel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Product::find($id);
        $data->name = $request->get('name_product'); //ambil name dari textfieldnya
        $data->price = $request->get('price_product'); //ambil name dari textfieldnya
        $data->hotel_id = $request->get('hotel_product'); //ambil name dari textfieldnya
        $data->image = $request->get('image_product'); //ambil name dari textfieldnya
        $data->available_room = $request->get('available_room'); //ambil name dari textfieldnya
        $data->update();
        return redirect()->route('product.index')->with('status', 'Yesss! your data is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Product::find($id);
            $data->delete();
            return redirect()->route('product.index')->with('status', 'Yesss! your data is successfully Deleted!');
        } catch (PDOException $ex) {
            $msg = "Failed to delete data!, Make sure there is no related data before deleting it!";
            return redirect()->route('product.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        $hotel = Hotel::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('product.getEditForm', ['data' => $data, 'hotel' => $hotel])->render()
        ), 200);
    }
    public function deleteData(Request $request)
    {

        try {
            $id = $request->id;
            $data = Product::find($id);
            $data->delete();
            return response()->json(array(
                'status' => 'oke',
                'msg' => 'type data is removed!'
            ), 200);
        } catch (PDOException $ex) {
            $msg = "Failed to delete data!, Make sure there is no related data before deleting it!";
            return response()->json(array(
                'status' => 'failed',
                'msg' => $msg
            ), 200);
        }
    }

    public function simpanPhoto(Request $request)
    {
        $file = $request->file("file_photo");
        $folder = 'products/' . $request->product_id;
        @File::makeDirectory(public_path() . "/" . $folder);
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->move($folder, $filename);
        return redirect()->route('laralux.index')->with('status', 'photo terupload');
    }
    public function uploadPhoto(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        return view('product.formUploadLogo', compact('product'));
    }

    public function delPhoto(Request $request)
    {
        File::delete(public_path() . "/" . $request->filepath);
        return redirect()->route('product.index')->with('status', 'photo dihapus');
    }
}
