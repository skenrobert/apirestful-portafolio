<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AccountProductionDetails extends Model
{
    use SoftDeletes;

    protected $table = "account_production_details";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'dolar',
        'tkn',
        'production_details_connec_id',
        'account_id'
    ];


    public function account(){// 1 a m

        return $this->belongsTo('App\Models\Account');
      }

      public function production_details_connec(){// 1 a m

        return $this->belongsTo('App\Models\ProductionDetailsConnec');
      }
}
