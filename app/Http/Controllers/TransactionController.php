<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PDOException;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all(); //pake Eloquent ORM
        $customer = Customer::all();
        $product = Product::all();
        $user = User::all();
        // dd($transactions);
        return view('frontend.transaction-list',['data'=>$transactions,'customer'=>$customer,'product'=>$product,'user'=>$user]); //ke folder index.blade.php dan mengirim data dengan key 'data' valuenya hotels
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        $product = Product::all();
        $user = User::all();
        return view('transaction.formcreate',['customer'=>$customer,'product'=>$product,'user'=>$user]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Transaction();
        $data->customer_id = $request->get('customer_id');//ambil name dari textfieldnya
        $data->user_id = $request->get('user_id');//ambil name dari textfieldnya
        $data->save();

        $idTransactionNew = $data->id; //mendapatkan id transaksi yg baru di insert
        $product_id = $request->get('product_id');
        $quantity = $request->get('quantity');
        $subtotal = $request->get('subtotal');
        DB::insert('insert into product_transaction(product_id,transaction_id,quantity,subtotal) values (?,?,?,?)',
        [$product_id,$idTransactionNew,$quantity,$subtotal]);

        //confirmation
        return redirect()->route('transaction.index')->with('status','Hooray ! your data is successfully recorded!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Transaction::find($id);
        $customer = Customer::all();
        $product = Product::all();
        $user = User::all();
        return view('transaction.edit',['customer'=>$customer,'product'=>$product,'user'=>$user,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Transaction::find($id);
        $data->customer_id = $request->get('customer_id');//ambil name dari textfieldnya
        $data->user_id = $request->get('user_id');//ambil name dari textfieldnya
        $data->update();

        $product_id = $request->get('product_id');
        $quantity = $request->get('quantity');
        $subtotal = $request->get('subtotal');
        DB::update('update product_transaction set product_id=?,quantity=?,subtotal=? where transaction_id=?',[$product_id,$quantity,$subtotal,$id]);
        return redirect()->route('transaction.index')->with('status', 'Yesss! your data is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::delete('delete from product_transaction where transaction_id=?',[$id]);
            $data = Transaction::find($id);
            $data->delete();
            return redirect()->route('transaction.index')->with('status', 'Yesss! your data is successfully Deleted!');
        } catch (PDOException $ex) {
            $msg = "Failed to delete data!, Make sure there is no related data before deleting it!";
            return redirect()->route('transaction.index')->with('status',$msg);
        }
    }

    public function getEditForm(Request $request){
        $id = $request->id;
        $data = Transaction::find($id);
        $customer = Customer::all();
        $product = Product::all();
        $user = User::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('transaction.getEditForm', ['data'=>$data,'customer'=>$customer,'product'=>$product,'user'=>$user])->render()
        ),200);
    }
    public function deleteData(Request $request){
        try{
            $id = $request->id;
            DB::delete('delete from product_transaction where transaction_id=?',[$id]);
            $data = Transaction::find($id);
            $data->delete();
            return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed!'
            ),200);
        }catch(PDOException $ex){
            $msg = "Failed to delete data!, Make sure there is no related data before deleting it!";
            return response()->json(array(
                'status' => 'failed',
                'msg' => $msg
            ),200);
        }
    
    }

    public function checkout(){
        $cart = session('cart');
        $user = Auth::user();

        $t = new Transaction();
        $t->user_id = $user->id;
        $t->customer_id = 1;
        $t->transaction_date = Carbon::now()->toDateTimeString();

        $t->save();
        $idTransactionNew = $t->id;


        $totalpoint = $t->insertProducts($cart,$idTransactionNew);
        
        $cust = Customer::find(1);
        $point = $cust->point;
        $totalpoint+=$point;

        DB::update('update customers set point=? where id=?',[$totalpoint, 1]);

        session()->forget('cart');
        return redirect()->route('laralux.index')->with('status','checkout berhasil');
    }

}
