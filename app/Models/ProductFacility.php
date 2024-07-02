<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductFacility extends Model
{
    use HasFactory;
    protected $table = 'product_facility';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_facility', 'product_id', 'facility_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
