<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    protected $table = 'export';
    protected $fillable = [
        'product_id', 'qty','date', 'user_id', 'status', 'warehouse_id'
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
