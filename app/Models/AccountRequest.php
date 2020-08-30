<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountRequest extends Model
{
    // use Sluggable;
    use SoftDeletes;
  
    // public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }
  
  
  
      protected $table = "account_request";
      
      protected $dates = ['deleted_at'];
  
      protected $fillable = [
          'nickname',
          'couples',
          'name_couple',
          'document_number',
          'provider_id',
          'user_request_id',
          'company_id',
          'sites'

      ];


/*****************  solicitud de cuenta *****************/

    public function user_request() //1 a m
    {
        return $this->belongsTo('App\Models\User');
    }

    public function account() //1 a m
    {
        return $this->hasMany('App\Models\Account');
    }

    public function provider() //1 a m
    {
        return $this->belongsTo('App\Models\Provider');
    }
    
    public function company() //1 a m
    {
        return $this->belongsTo('App\Models\Company');
    }

     
//************************************************************************************ */

    public function images()
    {
        return $this->belongsToMany('App\Models\Image')->withTimestamps();
    }
    
}
