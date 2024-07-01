<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;

    //ini akan mengarah lgsg ke nama table di database yaitu Hotels
    // protected $table = 'hotel';//kalau nama database bukan hotels tidak ada s di akhir maka nama table diganti dlu ini
    
    public function products():HasMany{
        return $this->hasMany(Product::class);
    }
    public function type():BelongsTo
    {
        return $this->belongsTo(Type::class,'hotel_type');//ini sesuai nama model ini hanya berlaku di Eloquent ORM model
    }

    
}
