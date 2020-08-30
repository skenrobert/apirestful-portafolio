<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    
    use SoftDeletes;
       
    protected $table = "commissions";
    
    protected $dates = ['deleted_at'];

  protected $fillable = [
    'commission1',
    'percentage1',
    'commission2',
    'percentage2',
    'commission3',
    'percentage3'
    
  ];


  public function productionmaster()//m a 1
  {
      return $this->hasMany('App\Models\ProductionMaster');
  }


}
