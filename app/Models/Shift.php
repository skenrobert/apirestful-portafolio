<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Shift extends Model
{
    use SoftDeletes;
    

    protected $table = "shifts";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'start',
        'end',
        'break'

    ];


    public function activity()//1 a m
    {
        return $this->hasMany('App\Models\Activity');
    }


//     public function shifthasemployee()//la relacion polimorfica de muchos a muchos apunta desde producion a las otras 3 tablas
//     {
//         return $this->morphedByMany('App\Models\ShiftHasEmployee', 'shifthasemployee');
//     }

//     public function shifthasproviders()//la relacion polimorfica de muchos a muchos apunta desde producion a las otras 3 tablas
// {
//     return $this->morphedByMany('App\Models\ShiftHasProvider', 'shifthasproviders');
// }

    // public function shifthasproviders()//1 a m
    // {
    //    return $this->hasMany('App\Models\ShiftHasProvider');
    // }

    public function productiondetailsshitf()//1 a m
    {
        return $this->hasMany('App\Models\ProductionDetailsShitf');
    }

    public function planningprovider()//1 a m
    {
    return $this->hasMany('App\Models\PlanningProvider');
    }

    public function monitorshift()//1 a m
    {
    return $this->hasMany('App\Models\MonitorShift');
    }

}
