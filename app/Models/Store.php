<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $table = "stores";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'phone',
        'address'
    ];


    // public function inventories()// relacion polimorfica que se asocia con la tabla responsables de type_movement_has_incentories
    //   {
    //   return $this->morphToMany('App\Models\Inventory', 'typemovementhasincentories');
    //   }

    public function typemovementinventory()// relacion polimorfica que se asocia con la tabla responsables de type_movement_has_incentories
    {
        return $this->hasMany('App\Models\TypeMovementInventory');
    }

        
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
    
}
