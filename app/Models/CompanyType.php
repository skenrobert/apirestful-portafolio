<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyType extends Model
{
    use SoftDeletes;
    // use Sluggable;

    protected $table = "company_types";
    
    protected $dates = ['deleted_at'];

        // public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
        //     return [
        //         'slug' => [
        //             'source' => 'name'
        //         ]
        //     ];
        // }

        protected $fillable = [
            'name',
            'description',
            'commission'
            ];


        public function companies()// 1 a m
        {
            return $this->hasMany('App\Models\Company');
        }

        
}
