<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssistanceControl extends Model
{
    use SoftDeletes;
    

    protected $table = "assistance_controls";
    
    protected $dates = ['deleted_at'];

  protected $fillable = [
    'beginning',
    'end',
    'description',
  ];



    public function employee()//1 a M
    {
        return $this->belongsTo('App\Models\Employee');
    }

    public function Payroll()//1 a 1
    {
        return $this->hasOne('App\Models\Payroll');
    }
}
