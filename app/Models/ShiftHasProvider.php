<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ShiftHasProvider extends Model
{
    use SoftDeletes;

    protected $table = "shift_has_providers";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'confirmed',
        // 'providers',//TODO: todas las modelos por turno y por semana
        'status',
        'observation',
        'goal_week',
        'beginning_week',
        'end_week',
        'shift_id'
    ];

//     public function shifthasproviders()// probando para que se pueda la relacion polimorfica de shift_has_employees
//     {
//         return $this->morphTo();
//         //return $this->morphToMany('App\Models\ShiftHasEmployee', 'taggable'); creo que se agrega otra funcion donde estaria fuera el morphTo y esta quedaria apuntando a la funcion (igual que los otros metodos) con su clase
//     }
    

//         /////////////////////////////////////////////////////////////////
// public function shifts()//la relacion polimorfica de muchos a muchos apunta desde producion a las otras 3 tablas
// {
//     return $this->morphedByMany('App\Models\Shift', 'shifthasproviders');
// }

// public function providers()
// {
//     return $this->morphedByMany('App\Models\Provider', 'shifthasproviders');
// }

// public function room()
// {
//     return $this->morphedByMany('App\Models\Room', 'shifthasproviders');
// }

// // se intenta guardar la relacion polimorfica de empleado que entrega y recibe el rooms TODO: se puede intentar sin ORM
// public function monitor_delivery()
// {
//     return $this->morphedByMany('App\Models\Employee', 'shifthasproviders');
// }

// public function monitor_receives()
// {
//     return $this->morphedByMany('App\Models\Employee', 'shifthasproviders');
// }



// ////////////////////////////////////////////////////////////////
// public function production()//1 a 1 esta relacion polimorfica le pertenece a una produccion
// {
//     return $this->belongsTo('App\Models\Production');
// }

// public function rooms()
//     {
//         // return $this->belongsToMany('App\Models\Room');

//         return $this->belongsToMany('App\Models\Room')->using('App\Models\ProviderPlanning')
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
//     }


    public function planningprovider()
    {
      return $this->hasMany('App\Models\PlanningProvider');
    }


//************************************************************************************ */
    public function shift()
    {
        return $this->belongsTo('App\Models\Shift');
    }



    public function productiondetailsweek()//1 a m
    {
       return $this->hasMany('App\Models\ProductionDetailsWeek');
    }


}
