<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeMovementHasIncentorie extends Model
{

  use SoftDeletes;

    protected $table = "type_movement_has_incentories";

    protected $dates = ['deleted_at'];

    protected $fillable = [

      'quantity',
      'stock',
      'description',
      'movement_type_id',
      'stores_id',
      'inventories_id',
      'bill_to_charges_id',
      'items_id'
    ];

    /**
     * Get all of the owning commentable models.
      */
    // public function typemovementhasincentories()// probando para que se pueda la relacion polimorfica de empleado, projecto y accion especificas
    // {
    //     return $this->morphTo();
    // }


}

