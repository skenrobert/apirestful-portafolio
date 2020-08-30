<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AccountPlan extends Model
{
  use SoftDeletes;
    
    protected $table = "account_plan";

    protected $dates = ['deleted_at'];

  protected $fillable = [
    'name',
    'code',
    'description',
    // 'accounting_id'
  ];


    public function accounting()//M a 1
    {
            return $this->belongsTo('App\Models\Accounting');
    }


    public function item()// M a N
    {
        return $this->belongsToMany('App\Models\Item');
    }

}
