<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Site extends Model
{

    use Sluggable;
    use SoftDeletes;


    public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    protected $table = "sites";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'url',
        'pay',
        'token_value'
    ];

    public function accounts(){// 1 a M

        return $this->hasMany('App\Models\Account');
    
      }

      public function bulkload()// 1 a M
      {
  
          return $this->hasMany('App\Models\BulkLoad');
      }
    

}
