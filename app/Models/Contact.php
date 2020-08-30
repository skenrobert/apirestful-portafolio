<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contact extends Model
{

  use Sluggable;
  use SoftDeletes;

  public function sluggable(){
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }
  
  protected $table = "contacts";
    
  protected $dates = ['deleted_at'];

  protected $fillable = [
            
    'name',
    'last_name',
    'email',
    'phone',
    'address'
  ];

  
}
