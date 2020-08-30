<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Item extends Model
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


    protected $table = "items";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'code',
        'description',
        'unity',
        'sale_price',
        'stock',
        'stockAlert',
        'company_id'
    ];

    public function accounplan()// M a N 
    {
        return $this->belongsToMany('App\Models\AccounPlan');
    }

    public function taxes()//N a M
    {
        return $this->belongsToMany('App\Models\Tax')->withTimestamps();
    }

    public function typemovementinventory()// relacion polimorfica que se asocia con la tabla responsables de type_movement_has_incentories
    {
        return $this->hasMany('App\Models\TypeMovementInventory');
    }

    public function company()//m a n
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function purchaseorders()// M a N 
    {
        return $this->belongsToMany('App\Models\PurchaseOrder');
    }

    public function images()
    {
         return $this->belongsToMany('App\Models\Image')->withTimestamps();
    }
    
}
