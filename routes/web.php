<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypesController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // return view('front');
})->name("front");

Route::get('/user/{id?}', function ($id="aldo") {
    if($id == "aldo"){
        return "oke";
    }else{
        return "test ".$id;
    }
    
});

// Route::get('/front', function () {
//     return view('front');
// })->name("front");

// Route::get('/{namepage}', function ($namepage) {
//     return "ini page $namepage";
// })->name("page");

Route::get('/kategori', function () {
    return view('kategori');
})->name("kategori");

Route::get('/kategori/{namapage}', function ($namapage) {
    $detail="";
    if($namapage=="single"){
        $detail =$detail. '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_QXb1hJYXjXSH0jwdnUdmxO1C38baIftFVg&usqp=CAU">';
        $detail=$detail."<br><h4>Kamar Single Semi Double</h4>";
        
    }elseif($namapage=="standard-double"){
        $detail =$detail. '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtfDneiQB98lvyU8VoR9BcAlnfzj40JdPVNw&usqp=CAU">';
        $detail=$detail."<br><h4>Kamar Standard Double</h4>";
    }
    return $detail;
})->name("detailkategori");

Route::get('/hotel/{namapage}', function ($namapage) {
    if($namapage=="APA Hotel Asakusa Kuramae"){
        return "Deskripsi hotel APA Hotel Asakusa Kuramae";
    }
})->name("hotel");
// Route::resource('hotels',HotelsController::class);
// Route::resource("product",ProductsController::class);
// // Route::resource("type",TypesController::class)->middleware('auth');
// Route::resource("type",TypesController::class);

Route::middleware(['auth'])->group(function(){
    Route::resource('hotels',HotelsController::class);
    Route::resource("product",ProductsController::class);
    Route::resource("type",TypesController::class);
    Route::resource('transaction',TransactionController::class);
});

Route::resource("customer",CustomerController::class);
Route::get('report/availableHotelRooms',[HotelsController::class,'availableHotelRoom'])->name('reportShowHotel');//disebelah nama class ikutin 
Route::get('report/hotel/avgPriceByHotelType',[HotelsController::class,'averagePriceHotel'])->name('reportAvgPriceHotel');//disebelah nama class ikutin 
//nama function di HotelsControllernya
Route::view('ajaxExample','hotel.ajax');
Route::post("/hotel/showInfo",[HotelsController::class, 'showInfo'])->name("hotels.showInfo");
// Route::resource('transaction',TransactionController::class);

//Edit delete with Modal
Route::post("customtype/getEditForm",[TypesController::class, 'getEditForm'])->name("type.getEditForm");
Route::post("customcustomer/getEditForm",[CustomerController::class, 'getEditForm'])->name("customer.getEditForm");
Route::post("customproduct/getEditForm",[ProductsController::class, 'getEditForm'])->name("product.getEditForm");
Route::post("customtype/getEditFormB",[TypesController::class, 'getEditFormB'])->name("type.getEditFormB");
Route::post("customtransaction/getEditForm",[TransactionController::class, 'getEditForm'])->name("transaction.getEditForm");
Route::post("customtype/saveDataTD",[TypesController::class, 'saveDataTD'])->name("type.saveDataTD");
Route::post("customtype/deleteData",[TypesController::class, 'deleteData'])->name("type.deleteData");
Route::post("customtproduct/deleteData",[ProductsController::class, 'deleteData'])->name("product.deleteData");
Route::post("customcustomer/deleteData",[CustomerController::class, 'deleteData'])->name("customer.deleteData");
Route::post("customtransaction/deleteData",[TransactionController::class, 'deleteData'])->name("transaction.deleteData");



Auth::routes();

Route::get('hotel/uploadLogo/{hotel_id}', [HotelsController::class, 'uploadLogo']);
Route::post('hotel/simpanLogo', [HotelsController::class, 'simpanLogo']);
Route::get('hotel/uploadPhoto/{hotel_id}', [HotelsController::class, 'uploadPhoto']);
Route::post('hotel/simpanPhoto', [HotelsController::class, 'simpanPhoto']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('product/uploadPhoto/{product_id}', [ProductsController::class, 'uploadPhoto']);
Route::post('product/simpanPhoto', [ProductsController::class, 'simpanPhoto']);
Route::post('product/delPhoto', [ProductsController::class, 'delPhoto']);


Route::get('/laralux', [FrontEndController::class, 'index'])->name('laralux.index');
Route::get('/laralux/{laralux}', [FrontEndController::class, 'show'])->name('laralux.show');

Route::middleware(['auth'])->group(function(){
    Route::get('laralux/user/cart',function(){
        return view('frontend.cart');
    })->name('cart');
    Route::get('laralux/cart/add/{id}',[FrontEndController::class,'addToCart'])->name('addCart');
    Route::get('laralux/cart/delete/{id}',[FrontEndController::class,'deleteFromCart'])->name('delFromCart');
    Route::post('laralux/cart/addQty',[FrontEndController::class,'addQuantity'])->name('addQty');
    Route::post('laralux/cart/reduceQty',[FrontEndController::class,'reduceQuantity'])->name('redQty');
});

