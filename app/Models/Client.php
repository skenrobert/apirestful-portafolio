<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Client extends Model
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

      
    protected $table = "clients";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        
       'person_id'

    ];

public function person(){// 1 a 1

    return $this->belongsTo('App\Models\Person');

  }

  public function billtocharge()//m a n
    {
        // return $this->belongsToMany('App\Models\BillToCharge')->using('App\Models\ClientsHasPayments');
        return $this->belongsToMany('App\Models\BillToCharge')->using('App\Models\ClientsHasPayments')
        ->withPivot(
            'description',
            'payment_method', 
            'transfer_code', 
            'dues', 
            'paid'
        );

    }



//     public function shops()//m a n
//   {
//       return $this->belongsToMany('App\Models\Shop');
//   }

//   public function company()//m a n
//   {
//       return $this->belongsToMany('App\Models\Company');
//   }


}
