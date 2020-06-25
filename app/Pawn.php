<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pawn extends Model
{
    protected $table = "pawn";
    protected $fillable = [
        'name',
        'date',
        'repayDate',
        'voucher',
        'amount',
        'repay_amount',
        'interest',
        'total',
        'status',
        'auto_voucher',
        'quantity',
        'weight',
        'stone_weight',
        'price',
        'cashier_name',
        'real_price',
        'discount',
        'yawe_status',
        'customer_id'
    ];

    public function photos()
    {
        return $this->hasMany('App\PawnPhoto');
    }
    public function customer()
    {
        return $this->belongsTo('App\PawnCustomer');
    }
}
