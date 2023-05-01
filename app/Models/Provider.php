<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\ProviderScope;


class Provider extends Model
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

  //   protected static function boot()//TODO: implementacion de los Scope ojo implementar en tablas relaciones tener cuidado mas efectivo id firttofail o lo otro es scope modificando el boot del modelo
	// {
	// 	parent::boot();
	// 	static::addGlobalScope(new ProviderScope);
	// }

    protected $table = "providers";

    protected $dates = ['deleted_at'];

    protected $fillable = [        
       'person_id','jobtype_id','init'
    ];

    public function boutiques()//m a n
    {
        return $this->belongsToMany('App\Models\Boutique');
    }

    public function lockers()//m a n
    {
        return $this->belongsToMany('App\Models\Locker');
    }


    public function event(){// 1 a M

      return $this->hasMany('App\Models\Event');

  
    }

    public function audiovisuals(){// 1 a M

      return $this->hasMany('App\Models\Audiovisual');
  
    }

    public function resources(){// 1 a M

      return $this->hasMany('App\Models\Resource');
  
    }

    public function person()//1 a  1
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function jobtype()//1 a  1
    {
        return $this->belongsTo('App\Models\JobType');
    }

    public function accounts(){// 1 a M

      return $this->hasMany('App\Models\Account');
  
    }

    // public function shifthasproviders()//la relacion polimorfica de muchos a muchos apunta desde producion a las otras 3 tablas
    // {
    //     return $this->morphedByMany('App\Models\ShiftHasProvider', 'shifthasproviders');
    // }
//************************************************************************************ */


// public function rooms()
//     {
//         // return $this->belongsToMany('App\Models\Room');

//         return $this->belongsToMany('App\Models\Room')->using('App\Models\ProviderPlanning')
//         ->withPivot(
//             'observation',
//             'used',
//             'provider_id',
//             'room_id',
//             'shifthasproviders_id'
//         )->withTimestamps();
//     }

//     public function shifthasproviders()
//     {
//         // return $this->belongsToMany('App\Models\Room');

//         return $this->belongsToMany('App\Models\ShiftHasProvider')->using('App\Models\ProviderPlanning')
//         ->withPivot(
//             'observation',
//             'used',
//             'provider_id',
//             'room_id',
//             'shifthasproviders_id'
//         )->withTimestamps();
//     }


//************************************************************************************ */

//************************************************************************************ */


// public function employees()
//     {
//         // return $this->belongsToMany('App\Models\Room');

//         return $this->belongsToMany('App\Models\Employee')->using('App\Models\CompareProviderWeek')
//         ->withPivot(
//             'total_provider_week',
//             'participation_current_week',//porcentaje en base a la semana anterior
//             'provider_id',
//             'employee_id',
//             'productiondetailsweek_id'
//         )->withTimestamps();
//     }




//************************************************************************************ */

public function images()
{
    return $this->belongsToMany('App\Models\Image')->withTimestamps();
}
//********************************************************************************** */
// public function compareproviderweek()
// {
//     return $this->belongsToMany('App\Models\CompareProviderWeek');
// }

// *****************************************************************



    //************************************************************************************ */

    // public function planningprovider()
    // {
    //   return $this->hasMany('App\Models\PlanningProvider');
    // }

    public function compareproviderweek()//1 a 1
    {
        return $this->hasMany('App\Models\CompareProviderWeek');
    }

    /*****************  solicitud de cuenta *****************/

    public function accountrequest() //1 a m
    {
        return $this->hasMany('App\Models\AccountRequest');
    }

    /*****************  solicitud de orden de compra *****************/

    public function purchaseorders(){// 1 a M

        return $this->hasMany('App\Models\PurchaseOrder');
  
    
      }

      
    public function accountreceiptprovider()//1 a m
    {
        return $this->hasMany('App\Models\AccountReceiptProvider');
    }

}

