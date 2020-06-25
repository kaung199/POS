<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $table = 'costs';
    protected $fillable = [
        'name',
        'amount',
        'reason',
        'date',
    ];
}
