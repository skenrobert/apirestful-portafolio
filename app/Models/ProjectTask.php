<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTask extends Model
{
    use SoftDeletes;

    protected $table = "projects";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
      
        'name',
        'description',
        'activities_id',
        'employees_functions_id'
  
    ];


    public function employeefunctions()//m a 1
    {
        return $this->belongsTo('App\Models\EmployeeFunction');
    }

    public function activities()//m a 1
    {
        return $this->belongsTo('App\Models\Activities');
    }
}
