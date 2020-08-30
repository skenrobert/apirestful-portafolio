<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductionMaster extends Model
{
    use SoftDeletes;
    

    // use Sluggable;

    // public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }


    protected $table = "production_masters";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        // 'name',
        'tkn_total_week',
        'beginning_week',
        'end_week',
        'value_trm',
        'minimum_limit',
        'commission_employed_payment',
        'estimated',
        'commission_id',
        'company_id',
        'shift_has_planning_id',
        'dolar_total_assigned',
        'tkn_total_assigned',
        'closed'//TODO al estar cerrada no se debe editar

    ];
 
    public function audists() //1 a m
    {
        return $this->hasMany('App\Models\Audists');
    }

    public function commission() //1 a m
    {
        return $this->belongsTo('App\Models\Commission');
    }

    public function shift_has_planning() //1 a m
    {
        return $this->belongsTo('App\Models\ShiftHasPlanning');
    }

    public function company() //1 a m
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function compareproviderweek() //1 a m
    {
        return $this->hasMany('App\Models\CompareProviderWeek');
    }

    public function productiondetailsdays() //1 a m
    {
        return $this->hasMany('App\Models\ProductionDetailsDay');
    }

    public function events() //1 a m
    {
        return $this->hasMany('App\Models\Event');
        // return $this->belongsToMany('App\Models\Event', 'events_production_masters')->withPivot('observations');

    }

    // public function accounts()//m a n
    // {
    //     return $this->belongsToMany('App\Models\Accounts');
    // }

    // public function shifthasemployee()//1 a 1 con una relacion polimorfica
    // {
    //     return $this->hasOne('App\Models\ShiftHasEmployee');
    // }

    // public function shifthasprovider()//1 a 1 con una relacion polimorfica
    // {
    //     return $this->hasOne('App\Models\ShiftHasEmployee');
    // }


}
