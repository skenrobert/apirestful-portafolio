<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $table = "rooms";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'address',
        'description',
        'status',
        'company_id'

    ];

    public function company() //1 a m
    {
        return $this->belongsTo('App\Models\Company');
    }

//     public function shifthasproviders()// relacion polimorfica que se asocia con la tabla responsables de projectos y acciones especificas
//     {
//     return $this->morphToMany('App\Models\ShiftHasProvider', 'shifthasproviders');
//    }
// ////////////////////////////////////////////////////////////////
// public function production()//1 a 1 esta relacion polimorfica le pertenece a una produccion
// {
//     return $this->belongsTo('App\Models\Production');
// }

// public function shifthasproviders()
//     {
//         // return $this->belongsToMany('App\Models\Room');

//         return $this->belongsToMany('App\Models\ShiftHasProvider')->using('App\Models\ProviderPlanning')
//         ->withPivot(
//             'observation',
//             'used',
//             'provider_id',
//             'room_id',
//             'shifthasproviders_id'
//         )->withTimestamps();
//     }

// public function providers()
//     {
//         // return $this->belongsToMany('App\Models\Provider');

//         return $this->belongsToMany('App\Models\Provider')->using('App\Models\ProviderPlanning')
//         ->withPivot(
//             'observation',
//             'used',
//             'provider_id',
//             'room_id',
//             'shifthasproviders_id'
//             // 'dolar',
//             // 'tkn',
//             // 'productiondetailsconnec_id',
//             // 'accounts_id'
//         )->withTimestamps();
    // }


//************************************************************************************ */

public function planningprovider()
    {
      return $this->hasMany('App\Models\PlanningProvider');
    }
   
}
