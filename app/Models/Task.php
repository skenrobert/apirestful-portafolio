<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $table = "tasks";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'company_id'

    ];

    public function company() //1 a m
    {
        return $this->belongsTo('App\Models\Company');
    }

//     public function shifthasemployee()//la relacion polimorfica de muchos a muchos apunta desde producion a las otras 3 tablas
// {
//     return $this->morphedByMany('App\Models\ShiftHasEmployee', 'shifthasemployee');
// }

// **************************************************************
    //monitors_has_shifts

    public function monitorshift()
    {
      return $this->hasMany('App\Models\MonitorShift');
    }

    // public function Employee()
    // {
    //     return $this->belongsToMany('App\Models\Employee');
    // }

    // public function shifthasemployes()//monitores de horario
    // {
    //   return $this->belongsToMany('App\Models\ShiftHasEmployee');
    // }
// **************************************************************


}
