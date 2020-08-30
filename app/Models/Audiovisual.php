<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Audiovisual extends Model
{

    use SoftDeletes;
    use Sluggable;

    public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
     return [
            'slug' => [
                'source' => 'name'
             ]
        ];
    }

    
    protected $table = "audiovisuals";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'category',
        'time',
        'assistance',
        'employee_id',
        'provider_id',
        'company_id'
];

    public function employee(){// 1 a M

        return $this->belongsTo('App\Models\Employee');
    }    

    public function provider(){// 1 a M

         return $this->belongsTo('App\Models\Provider');
    }    

    public function company(){// 1 a M

        return $this->belongsTo('App\Models\Company');
   } 

   public function event()// 1 a 1
   {
       return $this->hasMany('App\Models\Event');
   }

   public function images()
   {
        return $this->belongsToMany('App\Models\Image')->withTimestamps();
   }
   
}
