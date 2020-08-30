<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
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
  
  
      protected $table = "messages";
      
      protected $dates = ['deleted_at'];
  
    protected $fillable = [
              
        'from', 
        'to',
        'message'
  
    ];
}
