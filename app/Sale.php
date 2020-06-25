<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'qty',
        'date',
        'paid',
        'transfer_status',
        'r_change',
        'discount',
        'invoice_no',
        'total_price',
        'township_id',
        'discount',
    ];

    
    public function saleDetail()
    {
        return $this->hasMany('App\SaleDetail');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function township()
    {
        return $this->belongsTo('App\Township');
    }
}
