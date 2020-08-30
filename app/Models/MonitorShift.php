<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;


class MonitorShift extends Model
{
    // use SoftDeletes;

    protected $table = "monitor_shifts";
    
    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'observation',
        'shift_has_planning_id',
        'shift_id',
        'monitor_id',
        'task_id',
        'support',
        'sunday',
        'goal_dollar_monitor',
        'goal_tkn_monitor',
        'dolar_assigned',
        'tkn_assigned',
        'commission_payment'

    ];


    public function monitor()//n a 1
    {
        return $this->belongsTo('App\Models\User');
    }

    public function task()//n a 1
    {
        return $this->belongsTo('App\Models\Task');
    }

    public function shift_has_planning()//n a 1
    {
        return $this->belongsTo('App\Models\ShiftHasPlanning');
    }  

    public function shift()
    {
        return $this->belongsTo('App\Models\Shift');
    }
        
    public function planningprovider()
    {
    return $this->hasMany('App\Models\PlanningProvider');
    }

    public function productiondetailsshift()//1 a m 
    {
        return $this->hasMany('App\Models\ProductionDetailsShift');
    }
}
