<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CompareProviderWeek extends Model
{
    use SoftDeletes;

    protected $table = "compare_provider_week";
    protected $dates = ['deleted_at'];

        protected $fillable = [

            'total_provider_week',
            'participation_current_week',//porcentaje en base a la semana anterior
            'provider_id',
            'employee_id',
            'production_master_id'
                 
            ];


     

        public function production_master()// 1 a m
        {
            return $this->belongsTo('App\Models\ProductionMaster');
        }

        public function provider()
        {

            return $this->belongsTo('App\Models\Provider');
        }

        public function employee()
        {

            return $this->belongsTo('App\Models\Employee');
        }


}
