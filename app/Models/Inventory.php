<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Inventory extends Model
{
    use SoftDeletes;

    protected $table = "inventories";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'description',
        'shop_id'
        // 'user_id',
        // 'company_id'

    ];


    // use Sluggable;

    //     public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
    //         return [
    //             'slug' => [
    //                 'source' => 'name'
    //             ]
    //         ];
    //     }

    public function shop() //1 a m
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function accounting()// 1 a 1
    {
        return $this->belongsTo('App\Models\Accounting');
    }

    // public function users()//1 a  1
    // {
    //     return $this->belongsTo('App\Models\User');
    // }

    public function movementType()//1 a  1
    {
        return $this->belongsTo('App\Models\MovementType');
    }


    public function typemovementinventory()// relacion polimorfica que se asocia con la tabla responsables de type_movement_has_incentories
    {
        return $this->hasMany('App\Models\TypeMovementInventory');
    }


        /////////////////////////////////////////////////////////////////

// public function billstocharge() //la relacion polimorfica de muchos a muchos apunta desde empleados a las otras 2 tablas
// {
//     return $this->morphedByMany('App\Models\BillToCharge', 'typemovementhasincentories');
// }

// // public function inventory()
// // {
// //     return $this->morphedByMany('App\Models\Inventory', 'typemovementhasincentories');
// // }

// public function items()
// {
//     return $this->morphedByMany('App\Models\Item', 'typemovementhasincentories');
// }

// public function movementtypes()
// {
//     return $this->morphedByMany('App\Models\MovementType', 'typemovementhasincentories');
// }

// public function stores()
// {
//     return $this->morphedByMany('App\Models\Store', 'typemovementhasincentories');
// }


}
