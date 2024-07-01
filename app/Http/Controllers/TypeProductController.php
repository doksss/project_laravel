<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use Illuminate\Http\Request;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeproduct = TypeProduct::all(); //pake Eloquent ORM
        return view('frontend.typeproduct-list', ['data' => $typeproduct]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new TypeProduct();
        $data->nama_tipe = $request->get('type_name');
        $data->save();

        //confirmation
        return redirect()->route('typeproduct.index')->with('status', 'Hooray ! your data is successfully recorded!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=TypeProduct::find($id);
        $data->name = $request->get('type_name');
        $data->update();
        return redirect()->route('typeproduct.index')->with('status','Yesss! your data is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function deleteData(Request $request){
        $id = $request->id;
        $data = TypeProduct::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed!'
        ),200);
    }
    public function getEditForm(Request $request){
        $id = $request->id;
        $data = TypeProduct::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('typeproduct.getEditForm', compact('data'))->render()
        ),200);
    }
}
