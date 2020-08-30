<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Boutique extends Model
{
    use SoftDeletes;

    protected $table = "boutiques";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'price',
        'name',
        'description',
        'code',
        'company_id',
        'status'

    
    
    ];

   
    use Sluggable;

        public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
            return [
                'slug' => [
                    'source' => 'name'
                ]
            ];
        }

    public function provider()//m a n
    {
        // return $this->belongsToMany('App\Models\Provider');
        return $this->belongsToMany('App\Models\Provider', 'boutique_provider')->withPivot('observations','replacement_value','monitor_id');
    }

    public function company() //1 a m
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function monitor()//m a n
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function images()
    {
         return $this->belongsToMany('App\Models\Image')->withTimestamps();
    }

}
