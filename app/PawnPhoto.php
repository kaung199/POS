<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PawnPhoto extends Model
{
    protected $table = 'pawn_photos';
    protected $fillable = [
        'filename',
        'pawn_id',
    ];

    public function pawn()
    {
        return $this->belongsTo('App\Pawn');
    }
}
