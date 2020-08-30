<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;



class PlanningProvider extends Model
{
    //

    // use SoftDeletes;

    // use Sluggable;

    // public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }

    protected $table = "planning_provider";
    
    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'observation',
        'used',
        'shift_id',
        'monitor_shift_id',
        'model_id',
        'room_id',
        'goal_dollar',
        'goal_tkn'

    ];

    public function model()//n a 1
    {
        return $this->belongsTo('App\Models\User');
    }    

    // public function monitor()//n a 1
    // {
    //     return $this->belongsTo('App\Models\User');
    // } 

    public function monitor_shift()//n a 1
    {
        return $this->belongsTo('App\Models\MonitorShift');
    }  

    public function room()//n a 1
    {
        return $this->belongsTo('App\Models\Room');
    }  

    public function shift()
    {
        return $this->belongsTo('App\Models\Shift');
    }
    
}
