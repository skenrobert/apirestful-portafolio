<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ShiftHasPlanning extends Model
{
    use SoftDeletes;
    
    protected $table = "shift_has_planning";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'confirmed','status','observation','beginning_week','end_week','company_id'
        
        ];


    
    // public function shifthasemployees()// probando para que se pueda la relacion polimorfica de shift_has_employees
    // {
    //     return $this->morphTo();
    //     //return $this->morphToMany('App\Models\ShiftHasEmployee', 'taggable'); creo que se agrega otra funcion donde estaria fuera el morphTo y esta quedaria apuntando a la funcion (igual que los otros metodos) con su clase
    // }
    

//         /////////////////////////////////////////////////////////////////
// public function shifts()//la relacion polimorfica de muchos a muchos apunta desde producion a las otras 3 tablas
// {
//     return $this->morphedByMany('App\Models\Shift', 'shifthasemployees');
// }

// public function employees()
// {
//     return $this->morphedByMany('App\Models\Employee', 'shifthasemployees');
// }

// public function tasks()
// {
//     return $this->morphedByMany('App\Models\Task', 'shifthasemployees');
// }

////////////////////////////////////////////////////////////////
// public function production()//1 a 1 esta relacion polimorfica le pertenece a una produccion
// {
//     return $this->belongsTo('App\Models\Production');
// }
    

public function production_master()//1 a m
{
   return $this->hasOne('App\Models\ProductionMaster');
}



// public function backup_monitor()//1 a 1
// {
//     return $this->belongsTo('App\Models\Employee');
// }

// **************************************************************
//monitors_has_shifts


// **************************************************************
    //monitors_has_shifts

    public function monitorshift()
    {
      return $this->hasMany('App\Models\MonitorShift');
    }

// public function Employees()
// {
//     return $this->belongsToMany('App\Models\Employee');
// }

// public function tasks()
// {
//   return $this->belongsToMany('App\Models\Task');
// }
// // **************************************************************



//************************************************************************************ */


}


