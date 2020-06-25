<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AladdinProduct extends Model
{
    protected $table = 'aladdin_products';
    protected $fillable = ['name', 'category_id','code', 'quantity', 'price', 'count_method', 'photo', 'youtube', 'images', 'description'];

    public function photos()
    {
        return $this->hasMany('App\AladdinProductPhoto', 'product_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Categories');
    }
}
