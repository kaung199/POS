<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PawnCustomer extends Model
{
    protected $table = 'pawn_customer';
    protected $fillable = [
        'name', 'phone', 'address'
    ];

}
