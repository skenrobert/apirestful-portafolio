<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsHasShift extends Model
{
    use SoftDeletes;

    protected $table = "rooms_has_shift";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'dolar',
        'tkn',
        'productiondetailsconnec_id',
        'accounts_id'
    ];

}
