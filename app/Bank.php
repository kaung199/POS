<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'pawn_bank';
    protected $fillable = [
        'investment',
        'date',
        'cost',
        'min',
    ];
}
