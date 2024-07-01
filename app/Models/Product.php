<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    public function hotel():BelongsTo
    {
        return $this->belongsTo(Hotel::class);//ini sesuai nama model ini hanya berlaku di Eloquent ORM model
    }
    public function transactions():BelongsToMany
    {
        return $this->belongsToMany(Transaction::class,'product_transaction','product_id','transaction_id')
        ->withPivot('quantity','subtotal');;
    }
    
}
