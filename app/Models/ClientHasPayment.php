<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientHasPayment extends Model
{
    
    use SoftDeletes;
    // use Sluggable;

        // public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
        //     return [
        //         'slug' => [
        //             'source' => 'name'
        //         ]
        //     ];
        // }

        protected $table = "client_has_payment";
        
        protected $dates = ['deleted_at'];

        protected $fillable = [

           'description',
           'payment_method',
           'transfer_code',
           'dues',
           'paid',
            'person_id',
            'bill_to_charge_id'
        
        ];


        public function person()//m a n
        {
            return $this->belongsTo('App\Models\Person');
        } 
        
        public function bill_to_charge()//m a n
        {
            return $this->belongsTo('App\Models\BillToCharge');
        }





    

}
