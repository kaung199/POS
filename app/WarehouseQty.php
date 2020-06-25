<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseQty extends Model
{
    protected $table = 'warehoust_qty';
    protected $fillable = [
        'product_id', 'qty'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
