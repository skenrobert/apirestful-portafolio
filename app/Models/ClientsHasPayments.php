<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsHasPayments extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
      
    protected $table = "clients_has_payments";

    protected $fillable = [
        
    'description',
    'payment_method',
    'transfer_code',
    'dues',
    'paid',
    'clients_id',
    'bill_to_charges_id'

    ];

   
}
