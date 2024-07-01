<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use PDOException;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Type::all();
        return view('type.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type.formcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Type();
        $data->name = $request->get('type_name');//ambil name dari textfieldnya
        $data->description = $request->get('type_desc');//ambil name dari textfieldnya
        $data->save();

        //confirmation
        return redirect()->route('type.index')->with('status','Hooray ! your data is successfully recorded!');
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
        // dd($id);
        $data=Type::find($id);
        return view('type.edit',compact('data'));
        // dd($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id);
        $data=Type::find($id);
        $data->name = $request->get('type_name');
        $data->description = $request->get('type_desc');//ambil name dari textfieldnya
        $data->update();
        return redirect()->route('type.index')->with('status','Yesss! your data is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user= Auth::user();
        $this->authorize('delete-permission',$user);
        try{

        }catch(PDOException $ex){

        }
    }

    public function getEditForm(Request $request){
        $id = $request->id;
        $data = Type::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('type.getEditForm', compact('data'))->render()
        ),200);
    }

    public function getEditFormB(Request $request){
        $id = $request->id;
        $data = Type::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('type.getEditFormB', compact('data'))->render()
        ),200);
    }

    public function saveDataTD(Request $request){
        $id = $request->id;
        $data = Type::find($id);
        $data->name = $request->name;
        $data->save();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is up-to-date!'
        ),200);
    }

    public function deleteData(Request $request){
        $id = $request->id;
        $data = Type::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed!'
        ),200);
    }

}
