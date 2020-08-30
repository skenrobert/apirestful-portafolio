<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Account extends Model
{
    use Sluggable;
    use SoftDeletes;


    public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    protected $table = "accounts";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nickname',
        'description',
        'password',
        'create_date',
        'email',
        'status',
        'site_id',
        'user_request_id',
        'user_id',//Modelo
        'company_id'

    ];

    public function company() //1 a m
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function site()//1 a m
    {
        return $this->belongsTo('App\Models\Site');
    }

    public function user()//1 a m
    {
        return $this->belongsTo('App\Models\User');
    }

    // public function production()//n a m
    // {
    //     return $this->belongsToMany('App\Production');
    // }

    public function employee(){// 1 a m

        return $this->belongsTo('App\Models\Employee');
      }

    //   public function productiondetailsconnec()//n a m
    //   {
    //     //   return $this->belongsToMany('App\ProductionDetailsConnec');
    //       return $this->belongsToMany('App\Models\ProductionDetailsConnec')->using('App\Models\AccountProductionDetails')
    //       ->withPivot(
    //         'dolar',
    //         'tkn',
    //         'production_details_connec_id',
    //         'accounts_id'
    //       );
    //   }

    public function account_production_details()//n a m
  {
    //   return $this->belongsToMany('App\Models\Account');
    return $this->hasMany('App\Models\AccountProductionDetails');//,'accounts', 'productiondetailsconnec_id', 'account_id')->using('App\Models\AccountProductionDetails')
    // ->withPivot(
    //     'dolar',
    //     'tkn',
    //     'productiondetailsconnec_id',
    //     'account_id'
    // )->withTimestamps();
  }

    /*****************  solicitud de cuenta *****************/

  public function accountrequest() //1 a m
  {
      return $this->belongsTo('App\Models\AccountRequest');
  }

  public function user_create() //1 a m
  {
      return $this->belongsTo('App\Models\User');
  }

}
