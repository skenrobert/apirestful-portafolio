<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use App\Models\BillToCharge;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

class SaleInvoiceController extends ApiController
{
    
    
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    // public function index()
    // {
    //     // $saleinvoices= SaleInvoice::orderBy('id','DESC')->get();
    //     // $data = ['data'=>$saleinvoices];
    //     // return $this->showAll($data);
    // }

    public function store(Request $request)//generar pdf los campos deben ser llenados durante la consultas externas
    {

        $billtocharge = BillToCharge::find($request->bill_to_charge_id);

        if($billtocharge->total_paid == $billtocharge->total_cost){


            $typemovementinventories = $billtocharge->typemovementinventory()
            //  ->whereHas('shops')
            ->with('item')
            ->orderBy('id','DESC')
            ->get()
            ->where('movement_type_id','=', 3)
            // ->pluck('Provider')
            ->unique()
            ->values();

            $array = [];

            foreach($typemovementinventories as $typemovementinventory){
        //item, precio, cantidad,  total
                $array[] = [ 
                    'item' => $typemovementinventory->item->name, 
                    'price' => $typemovementinventory->unitpriceOut, 
                    'quantity' => $typemovementinventory->quantityOut, 
                    'total' => $typemovementinventory->totalOut, 
                 ];
            }


            $json = json_encode($array);


            $saleinvoice = new SaleInvoice();
            $saleinvoice->sub_total = $billtocharge->total_cost;
            $saleinvoice->total = $billtocharge->total_cost;
            $saleinvoice->details = $json;
            $saleinvoice->bill_to_charge_id = $billtocharge->id;
            $saleinvoice->save();




            $company = $saleinvoice->bill_to_charge()
            ->with('shop.company')
            ->orderBy('id','DESC')
            ->get()
            ->pluck('shop')
            ->unique()
            ->values();

            
            if($company->number_control == 0){

                $increment= 1;
                $increment = str_pad($increment, 4, '0', STR_PAD_LEFT);
                $saleinvoice->number = $increment;
                $saleinvoice->save();

                $company->number_control = 1;
                $company->save();
                
            }else{

                $increment= $company->number_control + 1;
                $increment = str_pad($increment, 4, '0', STR_PAD_LEFT);
                $saleinvoice->number = $increment;
                $saleinvoice->save();

                $company->number_control = $company->number_control + 1;
                $company->save();
            }


            $person = $saleinvoice->bill_to_charge()
            ->with('clienthaspayment.person')
            ->orderBy('id','DESC')
            ->get()
            ->pluck('clienthaspayment')
            ->collapse()
            ->pluck('person')
            ->unique()
            ->values();

            // dd($person);

            // return $this->showOne($saleinvoice, 201);

            $pdf = PDF::loadView('pdf.saleinvoice', compact('saleinvoice','company','person'));

            return $pdf->download('factura.pdf');


        }else{

            return response()->json(['error' => 'No a Pagado la Totalidad de la Deuda '.$billtocharge->total_cost.' de '.$billtocharge->total_paid,
             'code' => 422], 422);
        }



    }

    public function show(SaleInvoice $saleinvoice)//generar pdf
    {

        $company = $saleinvoice->bill_to_charge()
        ->with('shop.company')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('shop')
        ->pluck('company')
        // ->collapse()
        ->unique()
        ->values();

        $person = $saleinvoice->bill_to_charge()
        ->with('clienthaspayment.person')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('clienthaspayment')
        ->collapse()
        ->pluck('person')
        ->unique()
        ->values();

        // $data = ['data'=>$person];
        // return $this->showOne($data);
        // dd($company[0]->name);

        $pdf = PDF::loadView('pdf.saleinvoice', compact('saleinvoice','company','person'));

        return $pdf->download('factura.pdf');

        $data = ['data'=>$company, 'data'=>$person];
        return $this->showOne($data);
    }

    public function update(Request $request, SaleInvoice $saleinvoice)// si se anula la factura debe agregar la descripcion campo description null
    {
        if($request->has('description_null')){
            $saleinvoice->description_null = $request->description_null;
            $saleinvoice->save();
            return $this->showOne($saleinvoice); // anulada no gerera pdf

        }

    }

    // public function destroy(SaleInvoice $saleinvoice)
    // {
    //     $saleinvoice->delete($saleinvoice);
    //     return $this->showOne($saleinvoice);
    // }

}
