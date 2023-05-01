<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    // use Sluggable;
    use SoftDeletes;
  
    // public function sluggable(){
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }
    
    protected $table = "contracts";
      
    protected $dates = ['deleted_at'];
  
    protected $fillable = [
              
            'name',
            'last_name',
            'document_type',
            'document_number',
            'issued',
            'address',
            'email',
            'mobile_phone',
            'percentage_mandatario',
            'percentage_mandante',
            'number_mandato',
            'department',
            'couple_name',
            'document_type_couple',
            'document_number_couple',
            'percentage_number',
            'percentage',
            'valor',
            'equipment',
            'nationality',
            'position',
            'salary',
            'salary_written',
            'start_date',
            'end_date',
            'function',
            'duration',
            'finished',
            'contract_type',
            // 'subStudy_id',
            'user_id',
            'company_id',
            'status',

    ];
  
    public function images()
    {
         return $this->belongsToMany('App\Models\Image')->withTimestamps();
    }

    public function company()//m a n
    {
        return $this->belongsTo('App\Models\Company');
    }

    // public function substudy()//m a n
    // {
    //     return $this->belongsTo('App\Models\Company');
    // }

    public function user()//m a n
    {
        return $this->belongsTo('App\Models\User');
    }

}
