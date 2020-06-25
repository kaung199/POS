<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name',
        'code',
        'photo',
        'sale_price',
        'description',
        'category_id',
        'online_qty',
        'user_id',
        'mainbox_id','qty', 'min'
    ];

    public function category()
    {
        return $this->belongsTo('App\Categories');
    }
    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }
    public function mainBox()
    {
        return $this->belongsTo('App\MainBox', 'mainbox_id');
    }
    public function productDetail()
    {
        return $this->hasMany('App\ProductDetail');
    }
    public function stocks()
    {
        return $this->hasMany('App\Stock');
    }
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
