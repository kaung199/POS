<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainBox extends Model
{
    protected $fillable = [
        'code', 'Barcode', 'qty', 'status','date', 'type', 'product_id', 'purchase_id', 'user_id'
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
