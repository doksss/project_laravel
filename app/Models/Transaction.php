<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;
    public function user():BelongsTo
    {
        return $this->belongsTo(user::class,'user_id');//ini sesuai nama model ini hanya berlaku di Eloquent ORM model
    }
    public function customer():BelongsTo
    {
        return $this->belongsTo(user::class,'customer_id');//ini sesuai nama model ini hanya berlaku di Eloquent ORM model
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_transaction','transaction_id','product_id')
        ->withPivot('quantity','subtotal');
    }

    public function insertProducts($cart,$idtrans){
        $total = 0;
        $point = 0;
        $totalpoint=0;
        foreach($cart as $c){
            $subtotal = $c['quantity']*$c['price'];
            if($c['type_product']=="Deluxe"||$c['type_product']=="Superior"||$c['type_product']=="Suite"){
                $point = 5;
                $totalpoint += $point * $c['quantity'];
            }else{
                $totalpoint += floor($subtotal/300000);
            }
            $total+=$subtotal;
            $this->products()->attach($c['id'],['quantity'=>$c['quantity'],'subtotal'=>$subtotal,'transaction_id'=>$idtrans]);

            
        }
        return $totalpoint;
    }
}
