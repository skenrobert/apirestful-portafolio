<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\ProductionMaster;
use App\Models\ReceiptPayment;
use App\Models\Company;
use App\Models\Accounting;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;


class PayrollController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
       //listar por el imventario
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Articulos"]
        // ];

        // $Payrolls= Payroll::orderBy('id','DESC')->get();

        // $data = ['data'=>$Payrolls, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    // public function store(Request $request)
    // {
    //     $Payroll = Payroll::create($request->all());

    //     // if($request->has('company_id')){
    //     //     $Payroll->company_id = $request->company_id;
    //     // }
        
    //     // $Payroll->save();
    //     // $Payroll->taxes()->syncwithoutdetaching($request->tax_id);
    //     // $Payroll->taxes;

    //     return $this->showOne($Payroll, 201);

    // }

    public function show(Payroll $Payroll)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Nomina"]
        ];
        
        // $Payroll->taxes;

        $data = ['data'=>$Payroll, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Payroll $Payroll)
    {

        if($Payroll->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }

        $Payroll->fill($request->all())->save();

        // $Payroll->taxes()->syncwithoutdetaching($request->tax_id);

        return $this->showOne($Payroll);
    }

    public function destroy(Payroll $Payroll)
    {
        // $Payroll->delete($Payroll);
        // return $this->showOne($Payroll);


        // if(!$company->Payroll()->find($request->tax_id))
        // {
        //     return $this->errorResponse("El Articulo especificado no esta Asociado a esa empresa",404);
        // }

        // $Payroll->taxes()->detach($request->tax_id);
        // $Payroll->taxes;
        // return $this->showAll($Payroll);
    }

    
    public function payroll(Request $request, $id)
    {
        $company = Company::find($id);
        
        $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
        $event->processed = 1;
        $event->company_id = $company->id;
        $event->observation = 'calculo de nomina';
        $event->event_type_id = 7;
        $event->save();

        $payroll = new Payroll();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
        $payroll->beginning = $request->beginning;
        $payroll->end = $request->end;
        $payroll->company_id = $company->id;
        $payroll->save();
       

        $employees = $company->people()
        ->whereHas('employee')
        ->with('employee.jobtype')
        ->with('user')
        ->orderBy('id','DESC')
        ->get()
        ->where('user.status','=','true')
        // ->pluck('employee')
        ->unique()
        ->values();


        // $data = ['data'=>$employees];
        // return $this->showOne($data, 201);

        $fecha = Carbon::createFromFormat('Y-m-d', $payroll->beginning);
        $fechaFin = Carbon::createFromFormat('Y-m-d', $payroll->end);
        $worked_days = $fecha->diffInDays($fechaFin);

        // dd($worked_days);
        foreach($employees as $employee){

            // dd($employee->name . ' ' . $employee->last_name);
            // dd($employee->user->id);
            $company->number_receipt = $company->number_receipt + 1;
            $company->save();

            $receiptpayment = new ReceiptPayment();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
            $receiptpayment->name = $employee->name . ' ' . $employee->last_name;
            $receiptpayment->document_number = $employee->document_number;
            $receiptpayment->worked_days = $worked_days;
            $receiptpayment->pay_salary = $employee->employee->jobtype->salary;
            $receiptpayment->pay_transport_aid = $employee->employee->jobtype->transport_aid;
            $receiptpayment->pay_additional_transport = $employee->employee->jobtype->food_aid;
            $receiptpayment->pay_food_aid = $employee->employee->jobtype->additional_transport_assistance;
            $receiptpayment->health = $employee->employee->jobtype->salary * 0.04;
            $receiptpayment->pension = $employee->employee->jobtype->salary * 0.04;
            $receiptpayment->total_income = $employee->employee->jobtype->salary + $employee->employee->jobtype->transport_aid + $employee->employee->jobtype->food_aid + $employee->employee->jobtype->additional_transport_assistance;
            $receiptpayment->total_discounts = $employee->employee->jobtype->salary * 0.04 + $employee->employee->jobtype->salary * 0.04;
            $receiptpayment->save();

            $receiptpayment->total_pay = $receiptpayment->total_income - $receiptpayment->total_discounts;
            $receiptpayment->number_receipt = $company->number_receipt;
            $receiptpayment->payroll_id = $payroll->id;
            $receiptpayment->event_id = $event->id;
            $receiptpayment->user_id = $employee->user->id;
            $receiptpayment->save();

    }
       
            $accounting = new Accounting();
            $accounting->name = 'nomina';
            $accounting->payroll_id = $payroll->id;
            $accounting->company_id = $company->id;
            $accounting->save();



            // $data = ['data'=>$payroll, 'data1'=>$accounting];
            // return $this->showOne($data, 201);

            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha = Carbon::createFromFormat('Y-m-d', $payroll->beginning);
            $fechaFin = Carbon::createFromFormat('Y-m-d', $payroll->end);
            $mes = $meses[($fecha->format('n')) - 1];
    
            // dd($mes);
            $periodo =  $mes .' '. $fecha->format('d') . ' AL ' . $fechaFin->format('d');

            $receiptpayments = ReceiptPayment::where('payroll_id','=',$payroll->id)->get();

        //      $data = ['data'=>$receiptpayments];
        // return $this->showOne($data, 201);

            $pdf = PDF::loadView('pdf.removablepaymentAll', compact('receiptpayments', 'periodo'));

            return $pdf->download('recibo-pagos.pdf');
    }

}
