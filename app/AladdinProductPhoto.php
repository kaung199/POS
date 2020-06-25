<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AladdinProductPhoto extends Model
{
    protected $table = 'aladdin_product_photos';
    protected $fillable = ['product_id', 'filename'];
}
