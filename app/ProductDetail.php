<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';
    protected $fillable = [
        'product_id', 'purchase_id', 'Barcode', 'qty', 'mainBox_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }

}
