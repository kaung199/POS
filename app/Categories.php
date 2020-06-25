<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'code', 'name'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
