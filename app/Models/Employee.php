<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
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

    protected $table = "employees";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
    'init','person_id','jobtype_id'

];

  public function person(){// 1 a 1

    return $this->belongsTo('App\Models\Person');
  }
        
  
  public function audiovisuals(){// 1 a M

    return $this->hasMany('App\Models\Audiovisual');

  }

  public function jobtype()//1 a  1
  {
      return $this->belongsTo('App\Models\JobType');
  }

  public function resource(){// 1 a M

    return $this->hasMany('App\Models\Resource');

  }

  public function assistancecontrols(){// 1 a M

    return $this->hasMany('App\Models\AssistanceControl');

  }



    public function accounts()//1 a m
    {
        return $this->hasMany('App\Models\Account');
    }
 
 
    public function receiptpayment()//1 a m
    {
        return $this->hasMany('App\Models\ReceiptPayment');
    }
  

    // public function shifthasemployee()//monitor de respaldo
    // {
    //   return $this->hasOne('App\Models\ShiftHasEmployee');
    //   // return $this->morphedByMany('App\Models\ShiftHasEmployee', 'shifthasemployee');
    // }

// **************************************************************
    //monitors_has_shifts

    // public function monitorshift()
    // {
    //   return $this->hasMany('App\Models\MonitorShift');
    // }

    // public function tasks()
    // {
    //   return $this->belongsToMany('App\Models\Task');
    // }

    // public function shifthasemployes()//monitores de horario
    // {
    //   return $this->belongsToMany('App\Models\ShiftHasEmployee');
    // }



    //************************************************************************************ */


    public function productiondetailsweek()
    {
        return $this->hasMany('App\Models\ProductionDetailsWeek');
    }

//************************************************************************************ */

public function productiondetailsshift()//1 a m 
{
    return $this->hasMany('App\Models\ProductionDetailsShitf');
}

//************************************************************************************ */
public function compareproviderweek()//1 a 1
    {
        return $this->hasMany('App\Models\CompareProviderWeek');
    }
// public function company_valide($user)//1 a m 
// {
    
//   $user = $this->company->companytype;

//   // if(!$roles->contains($roleId)){
//   //     return $this->roles()->attach($roleId);

//   // }

//   return false;



// }



}

