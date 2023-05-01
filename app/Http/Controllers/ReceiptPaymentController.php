<?php

namespace App\Http\Controllers;

use App\Models\ReceiptPayment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;


class ReceiptPaymentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Tipos de Eventos"]
        // ];

        // $receiptpayment = ReceiptPayment::all();

          
        // $data = ['data'=>$receiptpayment, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $receiptpayment = ReceiptPayment::create($request->all());
        return $this->showOne($receiptpayment, 201);
    }

    public function show(ReceiptPayment $receiptpayment)
    {

        // dd($receiptpayment->payroll->beginning);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::createFromFormat('Y-m-d', $receiptpayment->payroll->beginning);
        $fechaFin = Carbon::createFromFormat('Y-m-d', $receiptpayment->payroll->end);
        $mes = $meses[($fecha->format('n')) - 1];

        // dd($mes);
        $periodo =  $mes .' '. $fecha->format('d') . ' AL ' . $fechaFin->format('d');
        // dd($periodo);

        // $data = ['data'=>$receiptpayment];
        // return $this->showOne($data);

        $pdf = PDF::loadView('pdf.removablepayment', compact('receiptpayment', 'periodo'));

        return $pdf->download('recibo-pago.pdf');
    }

    // public function update(Request $request, ReceiptPayment $receiptpayment)//no deberia meterlo en la nomina de una vez
    // {
    //     $receiptpayment->fill($request->all())->save();
    //     return $this->showOne($receiptpayment);
    // }

    // public function destroy(ReceiptPayment $receiptpayment)
    // {
    //     $receiptpayment->delete($receiptpayment);
    //     return $this->showOne($receiptpayment);
    // }
}
