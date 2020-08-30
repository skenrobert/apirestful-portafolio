<?php

namespace App\Http\Controllers;

use App\Models\TypeMovementInventory;
use App\Models\Item;
use App\Models\Event;
use App\Models\BillToCharge;
use Illuminate\Http\Request;

class TypeMovementInventoryController extends ApiController
{
    
    // public function index()
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Inventario"]
    //     ];

    //     $typemovementinventorys= TypeMovementInventory::orderBy('id','DESC')->get();
          
    //     $data = ['data'=>$typemovementinventorys, 'breadcrumbs'=> $breadcrumbs];
    //     return $this->showAll($data);

    // }

    // 'description',
    //     'invoce_number',

    //     'quantityIn',
    //     'totalIn',
    //     'unitpriceIn',

    //     'totalOut',
    //     'unitpriceOut',
    //     'quantityOut',

    //     'totalInventory',
    //     'unitpriceInventory',
    //     'quantityInventory',
    //     'date',

    //     'movement_type_id',
    //     'inventory_id',
    //     'store_id',
    //     'item_id',
    //     'bill_to_charge_id',
    //     'purchase_order_id'


    public function store(Request $request)//falta purchase order y bill to charge y store (creo que deben tener su propio movimiento de inventario)
    {
        // $typemovementinventory = TypeMovementInventory::create($request->all());

        $item = TypeMovementInventory::findOrFail($request->item_id)->get();


        $typemovementinventory = new TypeMovementInventory();

        if($request->movement_type_id == 1){//saldo inicial debe estar en 0 entrada y salida solo afecta saldo inventario
            $typemovementinventory->description = $request->description;
            $typemovementinventory->invoce_number = $request->invoce_number;
            $typemovementinventory->date = $request->date;

            $typemovementinventory->quantityInventory = $request->quantityInventory;
            $typemovementinventory->unitpriceInventory = $request->unitpriceInventory;
            $typemovementinventory->totalInventory = $request->totalInventory;

            $typemovementinventory->item_id = $request->item_id;
            $typemovementinventory->inventory_id = $request->inventory_id;
            $typemovementinventory->movement_type_id = $request->movement_type_id;
            $typemovementinventory->store_id = $request->store_id;
            $typemovementinventory->save();

            $item->stock = $request->quantityInventory;
            $item->save();

        }

        if($request->movement_type_id == 2){//compra

            // latest()->firstOrFail();
            $latest = TypeMovementInventory::latest()->firstOrFail();

            $typemovementinventory->description = $request->description;
            $typemovementinventory->invoce_number = $request->invoce_number;
            $typemovementinventory->date = $request->date;

            $typemovementinventory->quantityIn = $request->quantityIn;
            $typemovementinventory->unitpriceIn = $request->unitpriceIn;
            $typemovementinventory->totalIn = $request->totalIn;

            // $typemovementinventory->quantityInventory = $latest->quantityInventory + $request->quantityIn;
            // $typemovementinventory->unitpriceInventory = $request->unitpriceIn;
            // $typemovementinventory->totalInventory  = $latest->totalInventory + $request->totalIn;

            $typemovementinventory->quantityInventory = $latest->quantityInventory + $request->quantityIn;
            $typemovementinventory->totalInventory = $latest->totalInventory + $request->totalIn;
            $typemovementinventory->unitpriceInventory = ($latest->totalInventory + $typemovementinventory->totalInventory)/$typemovementinventory->quantityInventory;

            $typemovementinventory->item_id = $request->item_id;
            $typemovementinventory->inventory_id = $request->inventory_id;
            $typemovementinventory->movement_type_id = $request->movement_type_id;
            $typemovementinventory->store_id = $request->store_id;
            $typemovementinventory->save();

            $item->stock += $request->quantityIn;
            $item->save();

        }

        if($request->movement_type_id == 3){//venta
            $latest = TypeMovementInventory::latest()->firstOrFail();

            $typemovementinventory->description = $request->description;
            $typemovementinventory->invoce_number = $request->invoce_number;
            $typemovementinventory->date = $request->date;

            $typemovementinventory->quantityOut = $request->quantityOut;
            $typemovementinventory->unitpriceOut = $request->unitpriceOut;
            $typemovementinventory->totalOut = $request->totalOut;

            $typemovementinventory->quantityInventory = $latest->quantityInventory - $request->quantityOut;
            $typemovementinventory->unitpriceInventory = $latest->unitpriceInventory;
            $typemovementinventory->totalInventory = $latest->totalInventory - $request->totalOut;

            $typemovementinventory->item_id = $request->item_id;
            $typemovementinventory->inventory_id = $request->inventory_id;
            $typemovementinventory->movement_type_id = $request->movement_type_id;
            $typemovementinventory->store_id = $request->store_id;
            $typemovementinventory->save();

            $item->stock += - $request->quantityOut;
            $item->save();

                if($request->has('bill_to_charge_id')){
                    $billtocharge = BillToCharge::find($request->bill_to_charge_id);
                    $billtocharge->total_cost += $request->totalOut;
                }

                if($item->stock < $item->stockAlert){//alarma
                    $event = new Event();
                    $event->processed = 0;
                    $event->title = 'El articulo '.$item->name.' Codigo '.$item->code.' Esta por debajo de su cantidad minima en el Inventario';
                    // $event->productionmaster_id = $productionmaster->id;
                    $event->observation = 'Ocurre tras la ultima venta el inventario tiene en existencia '.$item->stock;
                    $event->company_id = $item->company_id;
                    $event->event_type_id = 1;
                    $event->save();
                }

        }

        if($request->movement_type_id == 4){//devolucion cliente
            $latest = TypeMovementInventory::latest()->firstOrFail();

            $typemovementinventory->description = $request->description;
            $typemovementinventory->invoce_number = $request->invoce_number;
            $typemovementinventory->date = $request->date;

            $typemovementinventory->quantityOut = - $latest->quantityInventory - $request->quantityOut;
            $typemovementinventory->unitpriceOut = $latest->unitpriceInventory;
            $typemovementinventory->totalOut = - $latest->unitpriceInventory;

            $typemovementinventory->quantityInventory = $latest->quantityInventory + $request->quantityOut;
            $typemovementinventory->unitpriceInventory = $latest->unitpriceInventory;
            $typemovementinventory->totalInventory = $latest->totalInventory + ($latest->unitpriceInventory * $request->quantityOut) ;

            $typemovementinventory->item_id = $request->item_id;
            $typemovementinventory->inventory_id = $request->inventory_id;
            $typemovementinventory->movement_type_id = $request->movement_type_id;
            $typemovementinventory->store_id = $request->store_id;
            $typemovementinventory->save();

            $item->stock += $request->quantityOut;
            $item->save();

            if($request->has('bill_to_charge_id')){
                $billtocharge = BillToCharge::find($request->bill_to_charge_id);
                $billtocharge->total_cost = $billtocharge->total_cost - $request->totalOut;
            }
        }

        if($request->movement_type_id == 5){//devolucion proveedor
            $latest = TypeMovementInventory::latest()->firstOrFail();

            $typemovementinventory->description = $request->description;
            $typemovementinventory->invoce_number = $request->invoce_number;
            $typemovementinventory->date = $request->date;

            $typemovementinventory->quantityIn = - $request->quantityIn;
            $typemovementinventory->unitpriceIn = $request->unitpriceIn;
            $typemovementinventory->totalIn = - $request->totalIn;

            $typemovementinventory->quantityInventory = $latest->quantityInventory - $request->quantityIn;
            $typemovementinventory->totalInventory = $latest->totalInventory - $request->totalIn;
            $typemovementinventory->unitpriceInventory = $typemovementinventory->totalInventory / $typemovementinventory->quantityInventory;

            $typemovementinventory->item_id = $request->item_id;
            $typemovementinventory->inventory_id = $request->inventory_id;
            $typemovementinventory->movement_type_id = $request->movement_type_id;
            $typemovementinventory->store_id = $request->store_id;
            $typemovementinventory->save();

            $item->stock += - $request->quantityIn;
            $item->save();

                if($item->stock < $item->stockAlert){//alarma
                    
                    $event = new Event();
                    $event->processed = 0;
                    $event->title = 'El articulo '.$item->name.' Codigo '.$item->code.' Esta por debajo de su cantidad minima en el Inventario';
                    // $event->productionmaster_id = $productionmaster->id;
                    $event->observation = 'Ocurre tras la devolucion al proveedor el inventario tiene en existencia '.$item->stock;
                    $event->company_id = $item->company_id;
                    $event->event_type_id = 1;
                    $event->save();
                }
        }

        if($request->movement_type_id == 6){//retiro otro concepto
            $latest = TypeMovementInventory::latest()->firstOrFail();


            $typemovementinventory->description = $request->description;
            $typemovementinventory->invoce_number = $request->invoce_number;
            $typemovementinventory->date = $request->date;

            $typemovementinventory->quantityIn = $request->quantityIn;
            $typemovementinventory->unitpriceIn = $request->unitpriceIn;
            $typemovementinventory->totalIn = $request->totalIn;

            $typemovementinventory->quantityInventory = $latest->quantityInventory + $request->quantityIn;
            $typemovementinventory->totalInventory = $latest->totalInventory + $request->totalIn;
            $typemovementinventory->unitpriceInventory = ($latest->totalInventory + $typemovementinventory->totalInventory)/$typemovementinventory->quantityInventory;

            $typemovementinventory->item_id = $request->item_id;
            $typemovementinventory->inventory_id = $request->inventory_id;
            $typemovementinventory->movement_type_id = $request->movement_type_id;
            $typemovementinventory->store_id = $request->store_id;
            $typemovementinventory->save();

            $item->stock += $request->quantityIn;
            $item->save();

        }

            if($request->movement_type_id == 7){//movimiento de almacen
                $latest = TypeMovementInventory::latest()->firstOrFail();

                $typemovementinventory->description = $request->description;
                $typemovementinventory->invoce_number = $request->invoce_number;
                $typemovementinventory->date = $request->date;

                $typemovementinventory->quantityIn = - $request->quantityIn;
                $typemovementinventory->unitpriceIn = $request->unitpriceIn;
                $typemovementinventory->totalIn = - $request->totalIn;

                $typemovementinventory->quantityInventory = $latest->quantityInventory - $request->quantityIn;
                $typemovementinventory->totalInventory = $latest->totalInventory - $request->totalIn;
                $typemovementinventory->unitpriceInventory = $typemovementinventory->totalInventory / $typemovementinventory->quantityInventory;

                $typemovementinventory->item_id = $request->item_id;
                $typemovementinventory->inventory_id = $request->inventory_id;
                $typemovementinventory->movement_type_id = $request->movement_type_id;
                $typemovementinventory->store_id = $request->store_id;
                $typemovementinventory->save();

                $item->stock += - $request->quantityIn;
                $item->save();
    
                if($item->stock < $item->stockAlert){//alarma
                    $event = new Event();
                    $event->processed = 0;
                    $event->title = 'El articulo '.$item->name.' Codigo '.$item->code.' Esta por debajo de su cantidad minima en el Inventario';
                    // $event->productionmaster_id = $productionmaster->id;
                    $event->observation = 'Ocurre tras un Movimineto de Almacen el inventario tiene en existencia '.$item->stock;
                    $event->company_id = $item->company_id;
                    $event->event_type_id = 1;
                    $event->save();
                }
        }

        return $this->showOne($typemovementinventory, 201);
    }

    public function show(TypeMovementInventory $typemovementinventory)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver detalles de Inventario"]
        ];

        $data = ['data'=>$typemovementinventory, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, TypeMovementInventory $typemovementinventory)
    {
        // $typemovementinventory->fill($request->all())->save();
        // return $this->showOne($typemovementinventory);
    }

    public function destroy(TypeMovementInventory $typemovementinventory)
    {
        // $typemovementinventory->delete($typemovementinventory);
        // return $this->showOne($typemovementinventory);
    }
}
