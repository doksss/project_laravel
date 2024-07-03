<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use PDOException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('role','guest')->get();
        return view('customer.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.formcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new User();
        $data->name = $request->get('name_cust');
        $data->address = $request->get('address_cust');
        $data->role = 'guest'; // ensure the role is set to guest
        $data->save();

        //confirmation
        return redirect()->route('customer.index')->with('status','Hooray ! your data is successfully recorded!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('role', 'guest')->FindOrFail($id);
        return view('customer.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::where('role', 'guest')->FindOrFail($id);
        $data->name = $request->get('name_cust');
        $data->address = $request->get('address_cust');
        $data->update();
        return redirect()->route('customer.index')->with('status', 'Yesss! your data is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = User::where('role', 'guest')->FindOrFail($id);
            $data->delete();
            return redirect()->route('customer.index')->with('status', 'Yesss! your data is successfully Deleted!');
        } catch (PDOException $ex) {
            $msg = "Failed to delete data!, Make sure there is no related data before deleting it!";
            return redirect()->route('customer.index')->with('status',$msg);
        }
    }

    public function getEditForm(Request $request){
        $id = $request->id;
        $data = User::where('role', 'guest')->FindOrFail($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('customer.getEditForm', compact('data'))->render()
        ),200);
    }
    public function deleteData(Request $request){
        $id = $request->id;
        $data = User::where('role', 'guest')->FindOrFail($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed!'
        ),200);
    }
}
