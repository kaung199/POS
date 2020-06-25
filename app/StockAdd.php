<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockAdd extends Model
{
    protected $table = 'stock_add';
    protected $fillable = [
        'product_id', 'qty','date', 'user_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
