<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovementType extends Model
{
    use SoftDeletes;

    protected $table = "movement_type";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description'
       
    ];

    // public function inventories()
    // {
    //     return $this->hasMany('App\Models\Inventory');
    // }

    public function typemovementinventory()// relacion polimorfica que se asocia con la tabla responsables de type_movement_has_incentories
    {
        return $this->hasMany('App\Models\TypeMovementInventory');
    }

}
