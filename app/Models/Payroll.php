<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Payroll extends Model
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

    protected $table = "payroll";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'Observation',
        'beginning',
        'end',
        'assistance_controls_id',
        'company_id',
        'number_control',
        'employee_id'
    ];


    public function accounting()//1 a 1
    {
        return $this->belongsTo('App\Models\Accounting');
    }

    public function company()//1 a 1
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function event() //1 a M
    {
        return $this->hasMany('App\Models\Event');
    }

    public function assistanceControl()//1 a  1
    {
        return $this->belongsTo('App\Models\AssistanceControl');
    }

    public function employee()//1 a 1
    {
        return $this->belongsTo('App\Models\Accounting');
    }


    public function receiptpayments() //1 a M
    {
        return $this->hasMany('App\Models\ReceiptPayment');
    }

}
