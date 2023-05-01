<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    //

    use SoftDeletes;
    use Sluggable;

    public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    protected $table = "companies";

    protected $dates = ['deleted_at'];

    protected $fillable = [
      'company_id',
      'email',
      'nit',            
      'name',
      'fundation',
      'address',
      'description',
      'phone',
      'website',
      'name_owner',
      'last_name_owner',
      'document_number',
      'enrollment',
      'Trade',
      'companytype_id'
    ];

    
  public function user()// 1 a 1
  {

    return $this->hasMany('App\Models\User');
  }

  public function contract()// 1 a 1
  {
    return $this->hasMany('App\Models\Contract');
  }

  public function polls()// 1 a 1
  {
    return $this->hasMany('App\Models\Poll');
  }

  public function payroll()// 1 a 1
  {
    return $this->hasMany('App\Models\Payroll');
  }


  public function items()// 1 a 1
  {

    return $this->hasMany('App\Models\Item');
  }

  public function eventType()// 1 a 1
  {

    return $this->hasMany('App\Models\EventType');
  }

  public function events()// 1 a 1
  {

    return $this->hasMany('App\Models\Event');
  }

  public function room()// 1 a 1
  {

    return $this->hasMany('App\Models\Room');
  }

  public function account()// 1 a 1
  {

    return $this->hasMany('App\Models\Account');
  }

  public function task()// 1 a 1
  {

    return $this->hasMany('App\Models\Task');
  }

  public function productionmaster()// 1 a 1
  {

    return $this->hasMany('App\Models\ProductionMaster');
  }

  public function locker()// 1 a 1
  {

    return $this->hasMany('App\Models\Locker');
  }



  public function boutique()// 1 a 1
  {

    return $this->hasMany('App\Models\Boutique');
  }

  public function shifthasplanning()// 1 a 1
  {

    return $this->hasMany('App\Models\ShiftHasPlanning');
  }

    public function accounts()// 1 a 1
  {

    return $this->hasMany('App\Models\Account');
  }

  //************************************************************************** */

  public function project()// 1 a M
  {

    return $this->hasMany('App\Models\Project');
  }

  public function people()//m a n
  {
      return $this->belongsToMany('App\Models\Person');
  }



  public function shops()// 1 a M
  {

    return $this->hasMany('App\Models\Shop');
  }

  // public function client()//m a n
  // {
  //     return $this->belongsToMany('App\Models\Client');
  // }

  public function training()//m a n
  {
      return $this->belongsToMany('App\Models\Training');
  }

  public function companytype()// n a 1
  {
    return $this->belongsTo('App\Models\CompanyType');
  }

  public function articles()// 1 a M
  {

    return $this->hasMany('App\Models\Article');
  }

  
//************************************************************************************ */

public function images()
{
    return $this->belongsToMany('App\Models\Image')->withTimestamps();
}
//************************************************************************************ */

public function accountrequest()// 1 a 1
{

  return $this->hasMany('App\Models\AccountRequest');
}

public function referrer_companies()// 1 a 1
{

  return $this->hasMany('App\Models\Company');
}

public function accounting()// 1 a 1
{

  return $this->hasOne('App\Models\Accounting');
}

public function stores()// 1 a 1
{

  return $this->hasMany('App\Models\Store');
}

public function purchaseorders()// 1 a 1
{

  return $this->hasMany('App\Models\PurchaseOrder');
}

public function records()// 1 a 1
{

  return $this->hasMany('App\Models\Record');
}

public function audiovisuals()// 1 a 1
{

  return $this->hasMany('App\Models\Audiovisual');
}

public function billtopay()//m a n
{
    return $this->belongsToMany('App\Models\BillToPay');
}

public function accountreceiptproviders()// 1 a 1
{

  return $this->hasMany('App\Models\AccountReceiptProvider');
}

public function comissionstudies()//1 a m
{
    return $this->hasMany('App\Models\ComissionStudy');
}

}

