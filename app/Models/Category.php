<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
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

        protected $table = "categories";
        
        protected $dates = ['deleted_at'];

        protected $fillable = [
            'name',
            'description',
            'referrer_categories_id'
        
        
        ];


        public function article()// 1 a M
        {
          return $this->hasMany('App\Models\Article');
        }
       


}
