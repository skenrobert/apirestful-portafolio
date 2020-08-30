<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TypeMovementInventory extends Model
{
    use SoftDeletes;

    protected $table = "type_movement_inventories";

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'description',
        'invoce_number',
        'quantityIn',
        'totalIn',
        'unitpriceIn',
        'totalOut',
        'unitpriceOut',
        'quantityOut',
        'totalInventory',
        'unitpriceInventory',
        'quantityInventory',
        'date',
        'movement_type_id',
        'inventory_id',
        'store_id',
        'item_id',
        'bill_to_charge_id',
        'purchase_order_id'

    ];

    public function billtocharge() //1 a m
    {
        return $this->belongsTo('App\Models\BillToCharge');
    }

    public function movementType() //1 a m
    {
        return $this->belongsTo('App\Models\MovementType');
    }

    public function inventory() //1 a m
    {
        return $this->belongsTo('App\Models\Inventory');
    }

    public function store() //1 a m
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function item() //1 a m
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function purchaseorder() //1 a m
    {
        return $this->belongsTo('App\Models\PurchaseOrder');
    }
}
