<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable = [
        'product_id', 'qty', 'min_qty', 'voucher', 'bad_qty', 'good_qty', 'loss_qty', 'delivery_date', 'user_id', 'status', 'remark'
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
