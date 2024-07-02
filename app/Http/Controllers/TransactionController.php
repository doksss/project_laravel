<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\ProductTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

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
        return view('transaction.index', ['data' => $transactions, 'customer' => $customer, 'product' => $product, 'user' => $user]); //ke folder index.blade.php dan mengirim data dengan key 'data' valuenya hotels
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        $product = Product::all();
        $user = User::all();
        return view('transaction.formcreate', ['customer' => $customer, 'product' => $product, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Transaction();
        $data->customer_id = $request->get('customer_id'); //ambil name dari textfieldnya
        $data->user_id = $request->get('user_id'); //ambil name dari textfieldnya
        $data->save();

        $idTransactionNew = $data->id; //mendapatkan id transaksi yg baru di insert
        $product_id = $request->get('product_id');
        $quantity = $request->get('quantity');
        $subtotal = $request->get('subtotal');
        DB::insert(
            'insert into product_transaction(product_id,transaction_id,quantity,subtotal) values (?,?,?,?)',
            [$product_id, $idTransactionNew, $quantity, $subtotal]
        );

        $this->calculatePoint($data->customer_id, $idTransactionNew);

        //confirmation
        return redirect()->route('transaction.index')->with('status', 'Hooray ! your data is successfully recorded!');
    }

    public function calculatePoint(int $customerId, int $transactionId)
    {
        $transactions = Transaction::where(['customer_id' => $customerId, 'id' => $transactionId])->get();//tinggal ganti mau customer atau transaction kalau cust banyak kalau transac 1 aja

        // if (!$transactions) {
        //     return redirect()->back()->with('error', 'Transaction not found.');
        // }

        $productTransactions = DB::table('product_transaction')
        ->join('products', 'product_transaction.product_id', '=', 'products.id')
        ->join('type_products', 'products.type_product', '=', 'type_products.id')
        ->where('product_transaction.transaction_id', '=', $transactionId)
        ->select('product_transaction.*', 'type_products.nama_tipe')
        ->get();
        // dd($productTransactions);
        $totalPoints = 0;

        // foreach ($transactions as $transaction) {
        //     $productTransactions = $transaction->productTransactions;

        //     foreach ($productTransactions as $productTransaction) {
        //         $productType = $productTransaction->products->type_products->nama_tipe;

        //         if (in_array($productType, ['Deluxe', 'Suite', 'Superior'])) {
        //             $multiplier = 5;
        //             $totalPoints += $productTransaction->quantity * $multiplier;
        //         } else {
        //             $multiplier = 1;
        //             $totalPoints += floor($productTransaction->subtotal / 100) * $multiplier;
        //         }
        //     }
        // }
        foreach ($productTransactions as $productTransaction) {
            $productType = $productTransaction->nama_tipe;
    
            if (in_array($productType, ['Deluxe', 'Suite', 'Superior'])) {
                $multiplier = 5;
                $totalPoints += $productTransaction->quantity * $multiplier;
            } else {
                $multiplier = 1;
                $totalPoints += floor($productTransaction->subtotal / 300000) * $multiplier;
            }
        }

        
        // Update the customer's points
        $customer = Customer::find($customerId);
        $customer->point = $totalPoints;
        $customer->save();

        return redirect()->route('transaction.index')->with('status', 'Yesss! Your data is successfully updated!');
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
        return view('transaction.edit', ['customer' => $customer, 'product' => $product, 'user' => $user, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Transaction::find($id);
        $data->customer_id = $request->get('customer_id'); //ambil name dari textfieldnya
        $data->user_id = $request->get('user_id'); //ambil name dari textfieldnya
        $data->update();

        $product_id = $request->get('product_id');
        $quantity = $request->get('quantity');
        $subtotal = $request->get('subtotal');
        DB::update('update product_transaction set product_id=?,quantity=?,subtotal=? where transaction_id=?', [$product_id, $quantity, $subtotal, $id]);
        return redirect()->route('transaction.index')->with('status', 'Yesss! your data is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::delete('delete from product_transaction where transaction_id=?', [$id]);
            $data = Transaction::find($id);
            $data->delete();
            return redirect()->route('transaction.index')->with('status', 'Yesss! your data is successfully Deleted!');
        } catch (PDOException $ex) {
            $msg = "Failed to delete data!, Make sure there is no related data before deleting it!";
            return redirect()->route('transaction.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $customer = Customer::all();
        $product = Product::all();
        $user = User::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('transaction.getEditForm', ['data' => $data, 'customer' => $customer, 'product' => $product, 'user' => $user])->render()
        ), 200);
    }
    public function deleteData(Request $request)
    {
        try {
            $id = $request->id;
            DB::delete('delete from product_transaction where transaction_id=?', [$id]);
            $data = Transaction::find($id);
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
}
