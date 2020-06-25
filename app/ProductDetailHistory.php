<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetailHistory extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'Barcode', 'sale_product_id', 'shop_id', 'mainBox_id', 'status'
    ];
}
