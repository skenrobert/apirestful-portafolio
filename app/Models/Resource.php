<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;

    protected $table = "resources";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'employees_id',
        'providers_id',
        'projects_id'
    ];


    public function project(){// 1 a M

        return $this->belongsTo('App\Models\Project');
   }    
         
   
   public function employee(){// 1 a M

    return $this->belongsTo('App\Models\Employee');
    }    
}
