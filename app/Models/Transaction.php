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
        return $this->belongsTo(customer::class,'customer_id');//ini sesuai nama model ini hanya berlaku di Eloquent ORM model
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_transaction','transaction_id','product_id')
        ->withPivot('quantity','subtotal');
    }
}
