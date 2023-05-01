<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\ApiController;
use App\Models\Company;
use App\Models\Person;
use App\Models\ProductionMaster;
use App\Models\AccountProductionDetails;
use App\Models\Account;
use App\Models\User;
use App\Models\Locker;
use App\Models\MonitorShift;
use App\Models\TypeMovementInventory;
use App\Models\Item;
use App\Models\ComissionStudy;
use App\Models\ComissionModel;
use Illuminate\Http\Request;

use App\Models\Contract;

use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;

use Carbon\Carbon;

class CompanyOrderProviderController extends ApiController
{
    public function index(Request $request, Company $company)//TODO: las ganacias de cada modelo estan en la Cuentas por pagar  producion master, eventos, cuentas por pagar
    {
//1. Ganancia de Modelos, de Mayor a menor
      //   dd($request->fechain);
         $fechain = $request->fechain;
        $fechater = $request->fechater;

        $ganaciasmodelos = $company->productionmaster()
        ->whereHas('events.billtopay')
        ->with('events.billtopay.owner')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('events')
        ->collapse()

         ->where('event_type_id', '=', 10)
         ->whereBetween('created_at', array($request->fechain,$request->fechater))

        ->pluck('billtopay')
        ->collapse()
        ->sortByDesc('total_cost')

      //   ->pluck('productiondetailsconnec')
      //   ->groupBy('provider_id')

        ->unique()
        ->values();

      //   $data = ['data'=>$ganaciasmodelos];
      //   return $this->showAll($data);

        $pdf = PDF::loadView('pdf.modelearnings', compact('ganaciasmodelos','fechain','fechater'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

        return $pdf->download('ganacia-modelo-monitor.pdf');
    }

    public function bestModel(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
    {

//         2. Mejor modelo  
// a. Rango de fecha 
// b. Se mide por producción
//  c. Mayor aumento de % 
        // dd('s');

        $fechain = $request->fechain;
        $fechater = $request->fechater;

       $bestmodels = $company->productionmaster()
       ->whereHas('productiondetailsdays.productiondetailsshift.productiondetailsconnec')
       ->with('productiondetailsdays.productiondetailsshift.productiondetailsconnec.accountproductiondetails')
       ->with('productiondetailsdays.productiondetailsshift.productiondetailsconnec.user.person')

       ->orderBy('id','DESC')
       ->get()
       ->where('id','=',$request->productionmaster_id)
       ->pluck('productiondetailsdays')
       ->collapse()
       ->pluck('productiondetailsshift')
       ->collapse()
       ->pluck('productiondetailsconnec')
       ->collapse()
       ->whereBetween('created_at', array($request->fechain,$request->fechater))
       ->sortByDesc('dolar_total_provider')

       // ->pluck('account_production_details')
       // ->collapse()

       ->unique()
       ->values();


      //  $data = ['data'=>$bestmodels];
      //  return $this->showAll($data);

       $pdf = PDF::loadView('pdf.bestmodel', compact('bestmodels','fechain','fechater'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

       return $pdf->download('mejor-modelo-producion.pdf');

    }
    
    public function productionModel(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
    {

// 4. Ver producción de Modelos  
// a. Rango de fechas 
// b. Filtrado por cada página y/o grupal.

      $fechain = $request->fechain;
      $fechater = $request->fechater;

       $productionmodels = $company->accounts()
       ->whereHas('account_production_details')
       ->with('account_production_details')
       ->with('user.person')
       ->with('site')
    //    ->with('provider.productiondetailsconnec')
       ->orderBy('id','DESC')
       ->get()
       ->whereBetween('created_at', array($request->fechain,$request->fechater))

       ->groupBy('user_id');
      //  ->groupBy('provider_id');

      //  ->unique()
      //  ->values();


      //  $data = ['data'=>$productionmodels];
      //  return $this->showAll($data);


       $pdf = PDF::loadView('pdf.productionmodel', compact('productionmodels','fechain','fechater'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

       return $pdf->download('sitio-modelo-producion.pdf');
    }

    
    public function productionStudio(Request $request, Company $company)//tiene estudios y sud estudios
    {

        // 5. Ganancia/Producción/Pagina/total (Grafica) 
        // a. Estudio.
   
       // $fechain = '2020-04-07 00:00:00';
       // $fechater = '2020-04-09 00:00:00';
      //  $productionstudio = $company->productionmaster()
      // //  ->whereHas('account_production_details')
      //  ->with('company')
      //  ->orderBy('id','DESC')
      //  ->get()
      //  ->whereBetween('created_at', array($request->fechain,$request->fechater))
      // // ->whereNull('number_receipt')

      // //  ->groupBy('provider_id');
      //  ->unique()
      //  ->values();

// dd($request->fechain);
       $productionstudios = ProductionMaster::whereBetween('created_at', array($request->fechain,$request->fechater))->orderBy('company_id','DESC')->get();//TODO: si lo dejo asi deberia mostrarlos de manera lineal todo los estudios  y lo que han comisionado

       foreach($productionstudios as $productionstudio){
          $productionstudio->company;
 
       }


       // $data = ['data'=>$accountproductiondetails];
       $data = ['data'=>$productionstudios];
       return $this->showAll($data);


    }


    public function productionSubstudio(Request $request, Company $company)//solo los sud estudios de la compañea
    {
        // 5. Ganancia/Producción/Pagina/total (Grafica) 
        // a. Estudio.
        //  b. Sub-Estudio
       
       // $fechain = '2020-04-07 00:00:00';
       // $fechater = '2020-04-09 00:00:00';
       $productionsubstudio = $company->referrer_companies()
      //  ->whereHas('account_production_details')
       ->with('productionmaster')
    //    ->with('provider.productiondetailsconnec')
       ->orderBy('id','DESC')
       ->get()
      ->whereBetween('created_at', array($request->fechain,$request->fechater))

    //    ->groupBy('provider_id')
      //  ->groupBy('provider_id');

       ->unique()
       ->values();


       // $data = ['data'=>$accountproductiondetails];
       $data = ['data'=>$productionsubstudio];
       return $this->showAll($data);


    }

    public function productionSatelite(Request $request, Company $company)//es para todas las modelos tipos
    {
        // 5. Ganancia/Producción/Pagina/total (Grafica) 
        //  c. Satélite  
        // d. Satélite-Pc 
        
      $productionsatelite = $company->people() //TODO:deberia mostrar las 7 ultimas conexiones de cada modelo en un solo grafico
      ->whereHas('user.productiondetailsconnec')
      //  ->whereHas('account_production_details')
      ->with('user.person.provider.jobtype')
      ->with('user.productiondetailsconnec')
      ->orderBy('id','DESC')
      ->get()
      ->whereIn('user.person.provider.jobtype.id', $request->jobtype_id) //aqui hace las 3 tipos de modelos o todas juntas
       
     // ->whereBetween('user.productiondetailsconnec.created_at', array($request->fechain,$request->fechater))

       ->unique()
       ->values();


       // $data = ['data'=>$accountproductiondetails];
       $data = ['data'=>$productionsatelite];
       return $this->showAll($data);


    }

   //  public function productionSatelitePc(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   //  {

   //      // 5. Ganancia/Producción/Pagina/total (Grafica) 

   //      // d. Satélite-Pc 
        
   //      $productionsatelitepc = $company->people()
   //      ->whereHas('user.productiondetailsconnec')
   //      //  ->whereHas('account_production_details')
   //      ->with('user.person.provider.jobtype')
   //      ->with('user.productiondetailsconnec')
   //      ->orderBy('id','DESC')
   //      ->get()
       
   //    //  ->whereBetween('created_at', array($request->fechain,$request->fechater))

   //  //    ->groupBy('provider_id')
   //    //  ->groupBy('provider_id');

   //     ->unique()
   //     ->values();


   //     // $data = ['data'=>$accountproductiondetails];
   //     $data = ['data'=>$productionsatelitepc];
   //     return $this->showAll($data);

   //  }



public function gananciaEstudio(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
    {

      
//  5. Ganancia
//  a. Estudio.
//   b. Sub-Estudio

 
      // $gananciaestudio = $company->accounting()
      // ->whereHas('billtopay.study.companytype')
      // ->with('billtopay.study.companytype')
      // ->orderBy('id','DESC')
      // ->get()
      // // ->pluck('shift_has_planning')
      // // ->collapse()
      // // ->whereBetween('created_at', array($request->fechain,$request->fechater))
      // ->values();

      $gananciaestudios = ComissionStudy::whereBetween('created_at', array($request->fechain,$request->fechater))->orderBy('company_id','DESC')->get();//TODO: si lo dejo asi deberia mostrarlos de manera lineal todo los estudios  y lo que han comisionado

      foreach($gananciaestudios as $gananciaestudio){
         $gananciaestudio->company;

      }

       // $data = ['data'=>$accountproductiondetails];
       $data = ['data'=>$gananciaestudios];
       return $this->showAll($data);

    }


    public function gananciaModelos(Request $request, Company $company)//TODO: el calculo de la ganacia de los sud-estudios tambien debe ser por produccion
    {

      
//  5. Ganancia

//   c. Satélite  
//  d. Satélite-Pc 
 
      // $gananciamodelos = $company->accounting()
      // ->whereHas('billtopay.users.person.provider.jobtype')
      // ->with('billtopay.users.person.provider.jobtype')
      // ->orderBy('id','DESC')
      // ->get()
      // // ->pluck('shift_has_planning')
      // // ->collapse()
      // ->whereBetween('created_at', array($request->fechain,$request->fechater))
      // ->values();
     
      $gananciamodelos = ComissionModel::whereBetween('created_at', array($request->fechain,$request->fechater))->orderBy('user_id','DESC')->get();//TODO: si lo dejo asi deberia mostrarlos de manera lineal todo los estudios  y lo que han comisionado

      foreach($gananciamodelos as $gananciamodelo){
         $gananciamodelo->user->person;

      }

       $data = ['data'=>$gananciamodelos];
      //  $data = ['data'=>$gananciamodelos,'data1'=>$commission, 'data2'=>$ganacias];
       return $this->showAll($data);

    }
    
public function pagoComisionesMonitores(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
{
         //        6. Pago de Comisiones (Monitores) (Grafica)
         //  a. Estudio
         //  b. Sub-estudios 
         // c. Satélites
         //  d. Satelite-Pc 
// dd($request->fechain);


         $comisionesmonitores = $company->productionmaster()
          ->whereHas('events')
         ->with('events.comissionemployees.user.person')
         // ->with('events.user')
         ->orderBy('id','DESC')
         ->get()
         // ->collapse()
         // ->whereBetween('created_at', array($request->fechain,$request->fechater))

         ->where('id','=', $request->masterproduction_id)
         ->pluck('events')
         ->collapse()
         ->pluck('comissionemployees')
         ->collapse()

         // ->pluck('user_id')
         // ->groupBy('user_id')
         
         ->unique()
         ->values();
         // ->toArray();


         
       $data = ['data'=>$comisionesmonitores];
       //  $data = ['data'=>$gananciamodelos,'data1'=>$commission, 'data2'=>$ganacias];
        return $this->showAll($data);

}

public function pagoComisionesEstudio(Request $request, $id)//dejar la funcion del modelo es mas optimo
{
         //        6. Pago de Comisiones 
         //  a. Estudio
         //  b. Sub-estudios 

         $comissionstudies = ComissionStudy::whereBetween('created_at', array($request->fechain,$request->fechater))->get();

         foreach($comissionstudies as $comissionstudy){
            $comissionstudy->company;

         }


         $data = ['data'=>$comissionstudies];
         //  $data = ['data'=>$gananciamodelos,'data1'=>$commission, 'data2'=>$ganacias];
          return $this->showAll($data);

      //  $fechain = '2020-04-07 00:00:00';
      //  $fechater = '2020-04-09 00:00:00';

      //    $productionmaster = $company->productionmaster()
      //     ->whereHas('events')
      //   ->with('events.comissionstudies.company')
      //    // ->with('events.user')
      //    ->orderBy('id','DESC')
      //    ->get()
      //    // ->collapse()
      //    // ->whereBetween('created_at', array($request->fechain,$request->fechater))

      //    // ->where('id','=', $request->masterproduction_id)
      //    // ->pluck('events')
      //    // ->collapse()
      //    // ->pluck('comissionstudies')
      //    // ->collapse()

      //    // ->pluck('user_id')
      //    // ->groupBy('user_id')
         
      //    ->unique()
      //    ->values();
      //    // ->toArray();


         
      //  $data = ['data'=>$comissionstudies];
      //  //  $data = ['data'=>$gananciamodelos,'data1'=>$commission, 'data2'=>$ganacias];
      //   return $this->showAll($data);

}

public function pagoComisionesModelos(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
{
         //        6. Pago de Comisiones  (Grafica)
         // c. Satélites
         //  d. Satelite-Pc 


         $comisionesmonitores = $company->productionmaster()
          ->whereHas('events')
         ->with('events.comissionmodels.user.person')
         // ->with('events.user')
         ->orderBy('id','DESC')
         ->get()
         // ->collapse()
         // ->whereBetween('created_at', array($request->fechain,$request->fechater))

         ->where('id','=', $request->masterproduction_id)
         ->pluck('events')
         ->collapse()
         ->pluck('comissionmodels')
         ->collapse()

         // ->pluck('user_id')
         // ->groupBy('user_id')
         
         ->unique()
         ->values();
         // ->toArray();


         
       $data = ['data'=>$comisionesmonitores];
       //  $data = ['data'=>$gananciamodelos,'data1'=>$commission, 'data2'=>$ganacias];
        return $this->showAll($data);

}

public function contratos1(Request $request, $id)//dejar la funcion del modelo es mas optimo
{

 
//    switch ($request->get('submitbutton')) {
      $expedida = $request->expedida;

      $user = User::find($id);
      
         $user->person;

         $contract = new Contract();
         $contract->name = $user->person->name;
         $contract->last_name = $user->person->last_name;
         $contract->document_type = $user->person->document_type;
         $contract->document_number = $user->person->document_number;

         $contract->issued = $request->expedida;

         $contract->address = $user->person->address;
         $contract->email = $user->email;
         $contract->mobile_phone = $user->person->mobile_phone;
         $contract->user_id = $user->id;
         $contract->company_id = $user->company_id;
         $contract->contract_type = 1;
         $contract->save();

         //contract_type
         //{{ date("d") }} de <?php setlocale(LC_TIME, "spanish"); echo strftime("%B"); ? >  del año  {{ date("Y") }}
      //  $data = ['data'=>$contract];
      //   return $this->showAll($contract);

      $pdf = PDF::loadView('pdf.contractRepreAr', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

        return $pdf->download('contrato-tipo-1.pdf');

}

public function contratos2(Request $request, $id)//dejar la funcion del modelo es mas optimo
{
   $user = User::find($id);

   $contract = new Contract();
   $contract->name = $user->person->name;
   $contract->last_name = $user->person->last_name;
   $contract->document_type = $user->person->document_type;
   $contract->document_number = $user->person->document_number;

   $contract->issued = $request->expedida;

   $contract->address = $user->person->address;
   $contract->email = $user->email;
   $contract->mobile_phone = $user->person->mobile_phone;
   $contract->user_id = $user->id;
   $contract->company_id = $user->company_id;
   $contract->contract_type = 2;

   $contract->number_mandato = $request->numeroMandato;
   $contract->department = $request->departamento;
   $contract->percentage_mandante = $request->mandante;
   $contract->percentage_mandatario = $request->mandatario;

   $contract->save();

  // $pdf = PDF::loadView('pdf.contractSateStu', compact('user','mandante','mandatario','numeroMandato','expedida','departamento'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global
   $pdf = PDF::loadView('pdf.contractSateStu', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

   return $pdf->download('contrato-tipo-2.pdf');
}

public function contratos3(Request $request, $id)//dejar la funcion del modelo es mas optimo
{
   $user = User::find($id);

   $contract = new Contract();
   $contract->name = $user->person->name;
   $contract->last_name = $user->person->last_name;
   $contract->document_type = $user->person->document_type;
   $contract->document_number = $user->person->document_number;

   $contract->issued = $request->expedida;

   $contract->address = $user->person->address;
   $contract->email = $user->email;
   $contract->mobile_phone = $user->person->mobile_phone;
   $contract->user_id = $user->id;
   $contract->company_id = $user->company_id;
   $contract->contract_type = 3;

   $contract->couple_name = $request->pareja;
   $contract->document_type_couple = $request->tipo_documento_pareja;
   $contract->document_number_couple = $request->numero_documento_pareja;
   $contract->department = $request->departamento;
   $contract->percentage_number = $request->porciento_nu;
   $contract->percentage = $request->porciento;
   $contract->valor = $request->valor;
   $contract->equipment = $request->equipo;
   $contract->save();

//{{ date("d") }} del mes de <?php setlocale(LC_TIME, "spanish"); echo strftime("%B"); ? > del año {{ date("Y") }}
    //$pdf = PDF::loadView('pdf.contractInven', compact('user','pareja','numero_documento','departamento','porciento_nu','porciento','valor','equipo'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global
    $pdf = PDF::loadView('pdf.contractInven', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

      return $pdf->download('contrato-tipo-3.pdf');
}

public function contratos4(Request $request, $id)//dejar la funcion del modelo es mas optimo
{

   $user = User::find($id);

   $contract = new Contract();
   $contract->name = $user->person->name;
   $contract->last_name = $user->person->last_name;
   $contract->document_type = $user->person->document_type;
   $contract->document_number = $user->person->document_number;

   $contract->issued = $request->expedida;

   $contract->address = $user->person->address;
   $contract->email = $user->email;
   $contract->mobile_phone = $user->person->mobile_phone;
   $contract->user_id = $user->id;
   $contract->company_id = $user->company_id;
   $contract->contract_type = 4;
   $contract->save();

  // $pdf = PDF::loadView('pdf.contractDereIm', compact('user','expedida'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global
  $pdf = PDF::loadView('pdf.contractDereIm', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

   return $pdf->download('contrato-tipo-4.pdf');

}

public function contratos5(Request $request, $id)//dejar la funcion del modelo es mas optimo
{

      $expedida = $request->expedida;
      $porciento = $request->porciento;
      $porciento_nu = $request->porciento_nu;

      //$subStudy = Company::find($id);//si los datos no estan lleno validar que exitan antes de


      $contract = new Contract();
      //$contract->name = $user->person->name;
     // $contract->last_name = $user->person->last_name;
     // $contract->document_type = $user->person->document_type;
     // $contract->document_number = $user->person->document_number;
   
      $contract->issued = $request->expedida;
   
      //$contract->address = $user->person->address;
      //$contract->email = $user->email;
      //$contract->mobile_phone = $user->person->mobile_phone;
      //$contract->user_id = $user->id;
      $contract->company_id = $id;
      $contract->contract_type = 5;

      $contract->percentage_number = $request->porciento_nu;
      $contract->percentage = $request->porciento;

      $contract->save();


      //dd($contract->company->name_owner);
      // $data = ['data'=>$contract];
      // return $this->showAll($contract);

      //{{ date("d") }} del mes de <?php setlocale(LC_TIME, "spanish"); echo strftime("%B"); ? >  del año {{ date("Y") }}
     // $pdf = PDF::loadView('pdf.contractSubEst', compact('subStudy','expedida','porciento_nu','porciento'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global
     $pdf = PDF::loadView('pdf.contractSubEst', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

      return $pdf->download('contrato-tipo-5.pdf');
}

public function contratos6(Request $request, $id)//dejar la funcion del modelo es mas optimo
{

      $user = User::find($id);
      
         $user->person;

      $contract = new Contract();
      $contract->name = $user->person->name;
      $contract->last_name = $user->person->last_name;
      $contract->document_type = $user->person->document_type;
      $contract->document_number = $user->person->document_number;

      $contract->issued = $request->expedida;

      $contract->address = $user->person->address;
      $contract->email = $user->email;
      $contract->mobile_phone = $user->person->mobile_phone;
      $contract->user_id = $user->id;
      $contract->company_id = $user->company_id;
      $contract->contract_type = 6;


      $contract->nationality = $request->LugNacNacionalidad;
      $contract->position = $request->cargo;
      $contract->salary = $request->salario;
      $contract->salary_written = $request->salarioEscri;
      $contract->payment_period = $request->peripago;
      $contract->start_date = $request->fechain;
      $contract->end_date = $request->fechafin;
      $contract->finished = $request->termino;
      $contract->function = $request->funciones;
      $contract->duration = $request->duracion;
      $contract->save();
      
      //  $data = ['data'=>$user];
      //   return $this->showAll($data);

      //$pdf = PDF::loadView('pdf.contractTermFijo', compact('user', 'LugNacNacionalidad', 'cargo', 'salario', 'salarioEscri', 'peripago', 'fechain', 'fechafin', 'expedida', 'termino', 'funciones', 'duracion'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global
      $pdf = PDF::loadView('pdf.contractTermFijo', compact( 'contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

        return $pdf->download('contrato-tipo-6.pdf');

}

public function removablepayment(Request $request, Company $company) //hacer un metodo que los genere uno por uno y otro que genere todos en el mismo pdf
{
    
      $payrolls = $compaskeskny->payroll()
      ->whereHas('receiptpayments')
      ->with('receiptpayments.user.person')
      ->orderBy('id','DESC')
      ->get()

      ->whereBetween('beginning', array($request->fechain,$request->fechater))
      ->pluck('receiptpayments')
      ->collapse()
      ->where('user_id','=', $request->user_id)


      // ->pluck('roles')
      // ->collapse()
      // ->pluck('pivot')
      // ->pluck('user_id')
      ->unique()
      ->values();


      // $data = ['data'=>$payrolls];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.removablepayment', compact('payrolls'));////habilita el pdf true

      return $pdf->download('desprendible-pago.pdf');
}

// removable payment

          
   public function modelosMulta(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {
     
      // 8. Multas (Grafica) 
      // a. Horas de Conexión y Desconexión b. Break
      //  c. Aseo Room. d. Daños e. Clases de ingles 
      // f. Clases de maquillaje
      // g. Clases de Baile h. Redes Sociales
      //  i. Otros
      
         $modelos = $company->user()
         //  ->whereHas('account_production_details')
         ->with('roles')
         ->orderBy('id','DESC')
         ->get()
         ->pluck('roles')
         ->collapse()
         ->where('id','=', 1)
         ->pluck('pivot')
         ->pluck('user_id')
         ->unique()
         ->values()
         ->toArray();

         $multas = $company->user()
            ->with('events')
            ->orderBy('id','DESC')
            ->get()
            ->pluck('events')
            ->collapse() 
            ->where('event_type_id','=', 3)
            ->whereBetween('created_at', array($request->fechain,$request->fechater))
            ->pluck('user_id')
            ->unique()
            ->values()
            ->toArray();


            $longitud1 = count($modelos);
            $longitud = count($multas);

   //                dd( $longitud);
   // $data = ['data'=>$modelos, 'data1'=>$multas];
   //    return $this->showAll($data);

            if($longitud1 >= 1 && $longitud >= 1){
               $resultado = array_intersect($modelos, $multas);
               $users= User::findOrFail($resultado);//la funcion find me falla

                  $users->each(function($users){//1 a 1

                     $users->person;
                        $users->roles;
                        foreach ($users->events as $event) {// m a n
                           $event->eventtype;
                        }
                       
                  });
            
               }else if($longitud == 0){
                  // dd('aquis2');

                  $users = $multas;
         }

      $data = ['data'=>$users];
      // // $data = ['data'=>$modelos, 'data1'=>$multas, 'data2'=>$users];
      return $this->showAll($data);

      // $pdf = PDF::loadView('pdf.modelfine', compact('users'));//habilita el pdf true

      // return $pdf->download('modelos-con-multa.pdf');

   }



         public function modelosMultaSin(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
         {
           
            // 9. Modelos que no tengan multas a. Por rango de fechas
              $modelos = $company->user()
              //  ->whereHas('account_production_details')
              ->with('roles')
              ->orderBy('id','DESC')
              ->get()
              ->pluck('roles')
              ->collapse()
              ->where('id','=', 1)
              ->pluck('pivot')
              ->pluck('user_id')
              ->unique()
              ->values()
              ->toArray();

              $multas = $company->user()
                ->with('events')
                ->orderBy('id','DESC')
                ->get()
               ->pluck('events')
                ->collapse() 
                ->where('event_type_id','=', 3)
                 ->whereBetween('created_at', array($request->fechain,$request->fechater))
                 ->pluck('user_id')
                ->unique()
                ->values()
                ->toArray();


                $longitud1 = count($modelos);
                $longitud = count($multas);
        
                  //   $data = ['data'=>$modelos, 'data1'=>$multas];
                  //   return $this->showAll($data);

                if($longitud1 >= 1 && $longitud >= 1){
        
                    $resultado = array_intersect($modelos, $multas);
                    $users= User::find($resultado);
        
                        $users->each(function($users){//1 a 1
        
                            foreach ($users->events as $event) {// m a n
                                $event->eventType;
                            }
                            $users->roles;
                            $users->person;
                        });
               }else if($longitud == 0){

                  $users = $company->user()
                  //  ->whereHas('account_production_details')
                  ->with('roles')
                  ->with('person')
                  ->with('events')
                  ->orderBy('id','DESC')
                  ->get()
                  ->unique()
                  ->values();
               }
     
            // $data = ['data'=>$users];
            // // $data = ['data'=>$modelos, 'data1'=>$multas, 'data2'=>$users];
            // return $this->showAll($data);

            $pdf = PDF::loadView('pdf.users', compact('users'));

            return $pdf->download('user-sin-multa.pdf');
     
         }



    public function productividadMonitores(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
    {

      
         // 11. Productividad por monitor/monitores (Grafica
 
      $productividadmonitores = $company->productionmaster()
       ->whereHas('shift_has_planning')
      ->with('shift_has_planning.monitorshift.monitor.person')
      ->with('shift_has_planning.monitorshift.productiondetailsshift')
     
      ->orderBy('id','DESC')
      ->get()
      ->pluck('shift_has_planning')
      ->where('id','=',$request->shifthasplanning_id)
      // ->pluck('monitorshift')
      // ->collapse()
      //  ->whereBetween('created_at', array($request->fechain,$request->fechater))
       ->unique()
       ->values();

       // $data = ['data'=>$accountproductiondetails];
       $data = ['data'=>$productividadmonitores];
       return $this->showAll($data);

    }



    public function productionNuevas(Request $request, Company $company)// recorro si lo que hizo en la suma de las conneciones es mas que 600 dolares guardo el id del usuario 
    {

      // 12. Reporte nuevas que pasaron la meta - 4000 Tokens de los primeros 3 días o 1er semana (viernes, sábado y Domingo) 

    //    dd('kenn');

       //TODO si se hace por aqui se debe borrar provider id de connect
    //    dd($request->fechain);
       // $fechain = '2020-04-07 00:00:00';
       // $fechater = '2020-04-09 00:00:00';

       $knownDate = Carbon::now();
       $knownDate = new Carbon('next monday');

       $productionnuevas = $company->accounts()
       ->whereHas('account_production_details')
       ->with('account_production_details.production_details_connec.user.person.provider.jobtype')
      //  ->with('provider.productiondetailsconnec')
       ->orderBy('id','DESC')
       ->get()
       ->whereBetween('created_at', array($knownDate->modify('this week -7 days')->format('Y-m-d'), $knownDate->endOfWeek()->format('Y-m-d')))

      ->pluck('account_production_details')
      ->collapse()
      ->pluck('production_details_connec')
      // ->where('account_production_details')

    //    ->groupBy('provider_id')
       ->groupBy('user_id')
      
      //  ->unique()
       ->values();
      //  ->toArray();

      //  $longitud = 0;
       $longitud1 = count($productionnuevas);

       $nueva = [];
       $sumaproduc = [];
    
       for($i=0; $i<$longitud1; $i++)
       {
          if(count($productionnuevas[$i]) >= 2 && 600 <= $productionnuevas[$i]->sum('dolar_total_provider') ){
             $nueva[] = $productionnuevas[$i][1]->user_id;
             $sumaproduc[] = $productionnuevas[$i]->sum('dolar_total_provider');
          }else if(600 <= $productionnuevas[$i][0]->dolar_total_provider) {
    
            $nueva[] = $productionnuevas[$i][0]->user_id;
            $sumaproduc[] = $productionnuevas[$i][0]->dolar_total_provider;
 
          }
      }

      $users = User::findOrFail($nueva);    

      foreach ($users as $user) {// m a n
         $user->productiondetailsconnec;    
         $user->person;    

     }

   //     $data = ['data'=>$productionnuevas];
   //   //  $data = ['data'=>$nueva,'data1'=>$sumaproduc,'data2'=>$users];
   //     return $this->showAll($data);

       $pdf = PDF::loadView('pdf.newproduction', compact('users','sumaproduc','nueva'));

       return $pdf->download('modelos-nueva-production.pdf');

    }


   public function turnoDiario(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {
   //     13. Reporte por turno diario, para saber cual es el mejor turno, diario y por semana. 

   // dd($request->productionmaster_id);
   $productiondetailsshifts = $company->productionmaster()
   // ->whereHas('productiondetailsdays.productiondetailsshift')
   ->with('productiondetailsdays.productiondetailsshift')
   ->orderBy('id','DESC')
   ->get()
   ->where('id', '=', $request->productionmaster_id)
   ->pluck('productiondetailsdays')
   ->collapse()
   ->pluck('productiondetailsshift')
   ->collapse()
   // ->whereBetween('created_at', array($request->fechain,$request->fechater))
   ->sortByDesc('dolar_total_monitor_shift')
   ->groupBy('production_details_day_id')
   // ->groupBy('shift_id')
   ->unique()
   ->values();

      foreach ($productiondetailsshifts as $productiondetailsshift) {// m a n
         for($i=0; $i< count($productiondetailsshift); $i++)
         {
            $productiondetailsshift[$i]->shift;    
            $productiondetailsshift[$i]->production_details_day;    
            $productiondetailsshift[$i]->monitor_shift->monitor->person;    

         }

     }

   // //   $data = ['data'=>$productiondetailsshifts[0][0]->id];
   //   $data = ['data'=>$productiondetailsshifts];
   //    return $this->showAll($data);

      $pdf = PDF::loadView('pdf.dailyshift', compact('productiondetailsshifts'));

      return $pdf->download('mejor-turno-production.pdf');
   }




   public function mejorMonitoresProduc(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {

     
        // 14. Mejor monitor por Producción y % 

     $productividadmonitores = $company->productionmaster()
      ->whereHas('shift_has_planning')
     ->with('shift_has_planning.monitorshift.planningprovider')
    
     ->orderBy('id','DESC')
     ->get()
      ->where('id', '=', $request->productionmaster_id)
     ->pluck('shift_has_planning')
     ->pluck('monitorshift')
     ->collapse()
     ->pluck('planningprovider')
     ->collapse()
      // ->whereBetween('created_at', array($request->fechain,$request->fechater))
     ->sortByDesc('production_total_dollar')
     ->groupBy('monitor_shift_id')
      ->unique()
      ->values();

   //    $data = ['data'=>$productividadmonitores];
   //   return $this->showAll($data);


      $longitud = 0;
      $longitud1 = count($productividadmonitores);
      $mejormonitor = [];
      $sumaproduc = [];

      // dd($longitud1);
   
      for($i=0; $i<$longitud1; $i++)
      {
         if(count($productividadmonitores[$i]) >= 2){
            // dd($productividadmonitores[$i]->sum('production_total_dollar'));

           // $mejorturno[] = $productividadmonitores[$i][1]; // otra manera de para mandarlo sin hacer la ultima consulta
            $mejormonitor[] = $productividadmonitores[$i][1]->monitor_shift_id;
            $sumaproduc[] = $productividadmonitores[$i]->sum('production_total_dollar');

         }else {
   
           // $mejorturno[] = $productividadmonitores[$i][0];
            $mejormonitor[] = $productividadmonitores[$i][0]->monitor_shift_id;
            $sumaproduc[] = $productividadmonitores[$i][0]->production_total_dollar;

         }
      }

     
     $productividadmonitores = MonitorShift::find($mejormonitor);    

     foreach ($productividadmonitores as $productividadmonitore) {// m a n
         $productividadmonitore->monitor->person;
         $productividadmonitore->shift;
         $productividadmonitore->task;

     }
      // $data = ['data'=>$mejormonitor, 'data1'=>$sumaproduc, 'data2'=>$productividadmonitores];
      // // $data = ['data'=>$productividadmonitores];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.bestmonitor', compact('productividadmonitores','sumaproduc','mejormonitor'));

      return $pdf->download('mejor-monitor-production.pdf');

   }



   

   public function modelosPlantaSatelites(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {

     
      // 15. Reporte Modelo Satelital y de planta juntos “la misma modelo puede volverse satelital o puede volver al estudio” 

     $modelosplantasatelites = $company->productionmaster()
      ->whereHas('shift_has_planning')
     ->with('shift_has_planning.monitorshift.planningprovider.model.roles')
     ->with('shift_has_planning.monitorshift.planningprovider.model.person')
     ->with('shift_has_planning.monitorshift.planningprovider.room')
    
     ->orderBy('id','DESC')
     ->get()
     ->where('id', '=', $request->productionmaster_id)
     ->pluck('shift_has_planning')
   //   ->pluck('monitorshift')
   //   ->collapse()
   //   ->pluck('planningprovider')
   //   ->collapse()
   //    ->whereBetween('created_at', array($request->fechain,$request->fechater))
   //   ->sortByDesc('production_total_dollar')
   //   ->groupBy('monitor_shift_id')
      ->unique()
      ->values();


      // $data = ['data'=>$productividadmonitores, 'data1'=>$sumaproduc];
      // $data = ['data'=>$modelosplantasatelites];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.allmodels', compact('modelosplantasatelites'));

      return $pdf->download('todas-modelos-production.pdf');
   }


   public function reporteStockminimo(Request $request, Company $company)
   {
      // 16. Reporte de Stock Mínimo = Mayor cada semana ítems para reposición. 

      $reporteitem = $company->items()// tiene que pasar la plannificacion
      // ->whereHas('shift_has_planning')
     ->with('taxes')
     ->orderBy('id','DESC')
     ->whereColumn('stockAlert','>=', 'stock')
     ->get()
     ->unique()
     ->values();
     
      // $data = ['data'=>$roomSemana, 'data1'=>$sumaproduc];
      // $data = ['data'=>$reporteitem];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.minimumstock', compact('reporteitem'));

      return $pdf->download('stock-minimo-articulo.pdf');
  
   }


   public function numeroEmpleados(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {

   // 18. Número de empleados  a. nomina  b. Proveedores Servicio (Modelos) c. Proveedores Servicio (Maicol) Ejemplo    

        $numeroempleados = $company->people()
         ->whereHas('employee')
        ->with('employee.jobtype')
        ->orderBy('id','DESC')
        ->get()
      //   ->pluck('provider')
        // ->whereIn('jobtype_id',[3,4]) TODO: sirve en uno solo
      //   ->where('jobtype_id','=','4')
        //  ->whereBetween('created_at', array($request->fechain,$request->fechater))
         // ->groupBy('employee.jobtype.jobtype_id')
      //   ->unique()
        ->values();

        $numeromodelos = $company->people()
         ->whereHas('provider.jobtype')
        ->with('provider.jobtype')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('provider')//6 5
        ->whereIn('jobtype_id',[5,6])
        ->pluck('person_id')//6 5

      //   ->where('jobtype_id','=','4')
        //  ->whereBetween('created_at', array($request->fechain,$request->fechater))
         // ->groupBy('provider.jobtype.jobtype_id')
      //   ->unique()
        ->values();

        $providers = Person::findOrFail($numeromodelos);
        foreach ($providers as $provider) {// m a n
         $provider->provider->jobtype;
     }
      //   $provider->provider;
      // $data = ['data'=>$providers];
      // $data = ['data'=>$numeroempleados,'data1'=>$providers];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.employeenumber', compact('numeroempleados','providers'));

      return $pdf->download('numero-empleado-provedor-estudio.pdf');
   }


   public function monitorRoom(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {

     
      // 19. Reportes de quien uso el Room, quien fue el monitor en ese turno especificado 

     $monitorroom = $company->productionmaster()//TODO POR produccion especifica
     ->whereHas('shift_has_planning')
     ->with('shift_has_planning.monitorshift.shift')
     ->with('shift_has_planning.monitorshift.monitor.person')
     ->with('shift_has_planning.monitorshift.planningprovider.model.person')
     ->with('shift_has_planning.monitorshift.planningprovider.room')
     ->orderBy('id','DESC')
     ->get()
     ->where('id','=',$request->productionmaster_id)

     ->pluck('shift_has_planning')
   //   ->pluck('monitorshift')
   //   ->collapse()
   //   ->pluck('planningprovider')
   //   ->collapse()
   //    ->whereBetween('created_at', array($request->fechain,$request->fechater))
   //   ->sortByDesc('production_total_dollar')
   //   ->groupBy('shift_has_planning.monitorshift.shift.shift_id')
      ->unique()
      ->values();


      // $data = ['data'=>$productividadmonitores, 'data1'=>$sumaproduc];
      // $data = ['data'=>$monitorroom];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.roomhistory', compact('monitorroom'));

      return $pdf->download('historico-room-estudio.pdf');

   }



   public function modelosNuevas(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {
     
      // 21. Cuantas Modelos ingresan nuevas. a. Rango de fecha   

      $modelos = $company->user()//esto ya esta fultrado por empresa y por modelo multada por connecion
      ->with('roles')
      ->orderBy('id','DESC')
      ->get()
      ->whereBetween('created_at', array($request->fechain,$request->fechater))//como el estatus es la ultima edicion
      ->where('status','=', 1)
     ->pluck('roles')
      ->collapse() 
      ->pluck('pivot')
      ->where('role_id','=', 1)
      ->pluck('user_id')
      // ->collapse() 
      ->unique()
      ->values()
      ->toArray();

          $longitud = count($modelos);
  
              $users= User::find($modelos);
  
                  $users->each(function($users){//1 a 1
                      $users->person->provider;
                      $users->roles;
                  });

      $fechain = $request->fechain;
      $fechater = $request->fechater;

      // $data = ['data'=>$users];
      // // $data = ['data'=>$modelos, 'data1'=>$users];//, 'data2'=>$users
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.newmodels', compact('users','fechain','fechater'));

      return $pdf->download('nueva-modelo-estudio.pdf');

   }


   public function activaronInactivaron(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {
     
           // 22. Cuantas modelos se (Activaron - inactivaron). a. Rango de fecha  

      $modelos = $company->user()//esto ya esta fultrado por empresa y por modelo multada por connecion
      ->with('roles')
      ->orderBy('id','DESC')
      ->get()
      ->whereBetween('updated_at', array($request->fechain,$request->fechater))//como el estatus es la ultima edicion
      ->where('status','=', 0)
     ->pluck('roles')
      ->collapse() 
      ->pluck('pivot')
      ->where('role_id','=', 1)
      ->pluck('user_id')
      // ->collapse() 
      ->unique()
      ->values()
      ->toArray();

          $longitud = count($modelos);
  
              $users= User::find($modelos);
  
                  $users->each(function($users){//1 a 1
                      $users->person->provider;
                      $users->roles;
                  });

   //   // $data = ['data'=>$users, 'data1'=>$longitud];
   //    // $data = ['data'=>$modelos];
   //    return $this->showAll($data);

      $fechain = $request->fechain;
      $fechater = $request->fechater;

      $pdf = PDF::loadView('pdf.activatedinactivated', compact('users','fechain','fechater'));

      return $pdf->download('desactivaron-modelo-estudio.pdf');
   }


   public function agendaronAudiovisuales(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {

      // 23. Cuantas modelos agendaron para fotografía a. Nombre. b. Nick c. Fecha

        $agendaronaudiovisuales = $company->audiovisuals()
         ->whereHas('provider')
        ->with('provider.jobtype')
        ->with('provider.person.user')
        ->orderBy('id','DESC')
        ->get()
         // ->whereBetween('time', array($request->fechain,$request->fechater))

      //   ->pluck('provider')
        // ->whereIn('jobtype_id',[3,4]) TODO: sirve en uno solo
      //   ->where('jobtype_id','=','4')
         // ->groupBy('employee.jobtype.jobtype_id')
      //   ->unique()
        ->values();

        $fechain = $request->fechain;
        $fechater = $request->fechater;

      // $data = ['data'=>$agendaronaudiovisuales];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.audiovisualschedules', compact('agendaronaudiovisuales','fechain','fechater'));

      return $pdf->download('agendaron-modelo-estudio.pdf');

   }

   
   public function modelosTarde(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {
     
   // 24. Cuantas modelos llegan tarde o se conectan tarde, se pasan de break, se desconectan temprano. 
   // el evento es el 3 y la connecion son los filtro para la multa

        $multas = $company->user()//esto ya esta fultrado por empresa y por modelo multada por connecion
          ->with('events')
          ->orderBy('id','DESC')
          ->get()
         ->pluck('events')
          ->collapse() 
          ->where('event_type_id','=', 3)
          ->where('productiondetailsconnec_id','!=', null)
          ->whereBetween('created_at', array($request->fechain,$request->fechater))
          ->pluck('user_id')
          ->unique()
          ->values()
          ->toArray();

         //  $longitud1 = count($modelos);
          $longitud = count($multas);
  
  
         //  if($longitud1 >= 1 && $longitud >= 1){
  
         //      $resultado = array_intersect_assoc($modelos, $multas);
              $users= User::find($multas);
  
                  $users->each(function($users){//1 a 1
  
                      foreach ($users->events as $event) {// m a n
                          $event->eventType;
                      }
                      $users->roles;
                      $users->person;
                  });

         $fechain = $request->fechain;
         $fechater = $request->fechater;
         
      // $data = ['data'=>$users];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.latemodels', compact('users','fechain','fechater'));

      return $pdf->download('modelos-tarde-estudio.pdf');

   }

   
   public function roomSemana(Request $request, Company $company)
   {
      // 25. Quienes van estipuladas en los Rooms de la semana.  

     $roomsemana = $company->productionmaster()// tiene que pasar la plannificacion
      ->whereHas('shift_has_planning')
     ->with('shift_has_planning.monitorshift.monitor.person')
     ->with('shift_has_planning.monitorshift.task')
     ->with('shift_has_planning.monitorshift.shift')
     ->with('shift_has_planning.monitorshift.planningprovider.model.person')
     ->with('shift_has_planning.monitorshift.planningprovider.room')
     ->orderBy('id','DESC')
     ->get()
     ->pluck('shift_has_planning')
     ->where('id','=',$request->shift_has_planning_id)
   //   ->pluck('monitorshift')
   //   ->collapse()
   //   ->pluck('planningprovider')
   //   ->collapse()
   //    ->whereBetween('created_at', array($request->fechain,$request->fechater))
   //   ->sortByDesc('production_total_dollar')
   //   ->groupBy('monitor_shift_id')
      ->unique()
      ->values();
     
      // $data = ['data'=>$roomSemana, 'data1'=>$sumaproduc];
      // $data = ['data'=>$roomsemana];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.roomweek', compact('roomsemana'));

      return $pdf->download('modelos-room-estudio.pdf');

   }

   public function cuantosLockers(Request $request, Company $company)
   {
         // 26. Cuantos lockers  a. Disponibles / Ocupados. b. Locker para modelo nueva 

   $todos = $company->locker()// tiene que pasar la plannificacion
   // ->whereHas('providers')
   ->with('providers')
   ->orderBy('id','DESC')
   ->get()
   ->pluck('id')
   ->unique()
   ->values()
   ->toArray();

     $ocupados = $company->locker()// tiene que pasar la plannificacion
     ->whereHas('providers')
     ->with('providers')
     ->orderBy('id','DESC')
     ->get()
     ->pluck('id')
   //   ->where('id','=',$request->shift_has_planning_id)
   //   ->pluck('monitorshift')
   //   ->collapse()
   //   ->pluck('planningprovider')
   //   ->collapse()
   //    ->whereBetween('created_at', array($request->fechain,$request->fechater))
   //   ->sortByDesc('production_total_dollar')
   //   ->groupBy('monitor_shift_id')
      ->unique()
      ->values()
      ->toArray();

      // $data = ['data'=>$todos, 'data1'=>$ocupados];
      // return $this->showAll($data);

      if (empty($ocupados)){
               // dd('aqui');
            $disponibles = $company->locker()// tiene que pasar la plannificacion
            // ->whereHas('providers')
            ->with('providers')
            ->orderBy('id','DESC')
            ->get()
             ->unique()
             ->values();

             $ocupados = [];

      }else {

         $resultado = array_diff($todos, $ocupados);
         $disponibles = Locker::find($resultado);    
         $ocupados = Locker::find($ocupados);   
         
        $ocupados->each(function($ocupados){//1 a 1
          foreach($ocupados->providers as $provider){
            $provider->person;
          }
         // $ocupados->providers;  
        });
      }

      // $data = ['data'=>$disponibles, 'data1'=>$ocupados];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.manylocker', compact('disponibles','ocupados'));

      return $pdf->download('locker-disponible-ocupado.pdf');

   }

 

   public function reporteDano(Request $request, Company $company)
   {
   // 27. Reporte de daños   

     $reportedano = $company->productionmaster()// tiene que pasar la plannificacion
      ->whereHas('productiondetailsdays.productiondetailsshift.productiondetailsconnec')
      ->with('productiondetailsdays.productiondetailsshift.productiondetailsconnec.accountproductiondetails.account.user.person')
      ->with('productiondetailsdays.productiondetailsshift.productiondetailsconnec.auditshift.monitordelivery.person')
      ->with('productiondetailsdays.productiondetailsshift.productiondetailsconnec.auditshift.monitorreceives.person')
     ->orderBy('id','DESC')
     ->get()
     ->where('id','=',$request->productionmaster_id)
     ->pluck('productiondetailsdays')
     ->collapse()
   //   ->pluck('planningprovider')
   //   ->collapse()
   //    ->whereBetween('created_at', array($request->fechain,$request->fechater))
   //   ->sortByDesc('production_total_dollar')
   //   ->groupBy('monitor_shift_id')
      ->unique()
      ->values();
     
      // $data = ['data'=>$reportedano];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.damagereport', compact('reportedano'));

      return $pdf->download('reporte-daño-estudio.pdf');

   }


   
   public function reporteInventario(Request $request, Company $company)
   {
      // 28. Reporte de Inventarios a. ventas b. Todos los productos c. Los que están por agotarse  d. Diferidos  
// dd($request->fechain);

     $typemovementinventories = TypeMovementInventory::join('items', 'items.id', '=', 'type_movement_inventories.item_id')
    ->select('type_movement_inventories.unitpriceOut', 'type_movement_inventories.quantityOut','items.name','items.stock','items.stockAlert','items.code','items.id')
    ->where('type_movement_inventories.movement_type_id', '=', 3)
    ->where('items.company_id', '=', $company->id)
    ->get();

   $items = TypeMovementInventory::join('items', 'items.id', '=', 'type_movement_inventories.item_id')
   ->select('items.id')
   ->where('type_movement_inventories.movement_type_id', '=', 3)
   ->where('items.company_id', '=', $company->id)
   ->get();

   $items2 = Item::whereNotIn('id', $items)->get();


// $data = ['data'=>$typemovementinventories, 'data1'=>$items2];
//       return $this->showAll($data);


      $pdf = PDF::loadView('pdf.reportInventory', compact('typemovementinventories','items2'));
      return $pdf->download('reporte-imventario.pdf');

   }





   public function premiosUser(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {
     
         // 29. Premios a. Modelos b. Monitores 

      $multas = $company->user()//esto ya esta fultrado por empresa y por modelo multada por connecion
      ->with('events')
      ->orderBy('id','DESC')
      ->get()
     ->pluck('events')
      ->collapse() 
      ->whereBetween('created_at', array($request->fechain,$request->fechater))
      ->where('event_type_id','=', 2)//TODO:si tiene una multa debe ser espuesta aqui con la exoneracion
      ->pluck('user_id')
      ->unique()
      ->values()
      ->toArray();

          $longitud = count($multas);
  
              $users= User::find($multas);
  
                  $users->each(function($users){//1 a 1
  
                      foreach ($users->events as $event) {// m a n
                          $event->eventType;
                      }
                      $users->roles;
                  });

      // $data = ['data'=>$users];
      // // $data = ['data'=>$modelos, 'data1'=>$multas];//, 'data2'=>$users
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.awardstudi', compact('users'));

      return $pdf->download('premio-del-estudio.pdf');
   }




   public function modelosPermisos(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {
     
      //30. Cuantas modelos tuvieron incapacidades médicas, permisos, por semanas y/o por mes. 

      $multas = $company->user()//esto ya esta fultrado por empresa y por modelo multada por connecion
      ->with('events')
      ->orderBy('id','DESC')
      ->get()
     ->pluck('events')
      ->collapse() 
      ->where('event_type_id','=', 4)//TODO:si tiene una multa debe ser espuesta aqui con la exoneracion
      ->whereBetween('created_at', array($request->fechain,$request->fechater))
      ->pluck('user_id')
      ->unique()
      ->values()
      ->toArray();

          $longitud = count($multas);
  
              $users= User::find($multas);
  
                  $users->each(function($users){//1 a 1
  
                      foreach ($users->events as $event) {// m a n
                          $event->eventType;
                      }
                      $users->roles;
                  });

      // $data = ['data'=>$users];
      // // $data = ['data'=>$modelos, 'data1'=>$multas];//, 'data2'=>$users
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.permissionmodels', compact('users'));

      return $pdf->download('permisos-modelos-estudio.pdf');

   }

 

   public function reporteTRM(Request $request, Company $company)
   {
  //32. Reporte del TRM  a. Grafica  b. Rango de fecha  

//   dd($request->fechain);
     $reportetmr = $company->productionmaster()// tiene que pasar la plannificacion
      ->whereHas('company')
      ->with('company')
     ->orderBy('id','ASC')
     ->get()
   //   ->pluck('productiondetailsdays')
   //   ->collapse() 

      // ->whereBetween('created_at', array($request->fechain,$request->fechater))

   //   ->sortByDesc('production_total_dollar')
   //   ->groupBy('monitor_shift_id')
      ->unique()
      ->values();
     
      // $data = ['data'=>$roomSemana, 'data1'=>$sumaproduc];
      $data = ['data'=>$reportetmr];
      return $this->showAll($data);

   }

   public function reporteAudiovisuales(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {

      // 33. Reporte de Programación de Audiovisuales 

        $auidovisual = $company->audiovisuals()
         ->whereHas('provider')
        ->with('employee.jobtype')
        ->with('employee.person')
        ->with('provider.jobtype')
        ->with('provider.person')
        ->orderBy('id','DESC')
        ->get()
      //   ->pluck('provider')
        // ->whereIn('jobtype_id',[3,4]) TODO: sirve en uno solo
        ->where('assistance','=', null)
        //  ->whereBetween('created_at', array($request->fechain,$request->fechater))
         // ->groupBy('employee.jobtype.jobtype_id')
      //   ->unique()
        ->values();

      // $data = ['data'=>$auidovisual];
      // // $data = ['data'=>$numeroempleados,'data1'=>$numeromodelos];
      // return $this->showAll($data);

      
      $pdf = PDF::loadView('pdf.audiovisual', compact('auidovisual'));

      return $pdf->download('programacion-audiovisual-estudio.pdf');
   }

   public function reporteAntiguedad(Request $request, Company $company)//dejar la funcion del modelo es mas optimo
   {

    //34. Reporte de Antigüedad a. Modelo y Monitor  

        $numeroempleados = $company->people()
         ->whereHas('employee')
        ->with('employee.jobtype')
        ->orderBy('id','DESC')
        ->get()
      //   ->pluck('provider')
        // ->whereIn('jobtype_id',[3,4]) TODO: sirve en uno solo
      //   ->where('jobtype_id','=','4')
        //  ->whereBetween('created_at', array($request->fechain,$request->fechater))
         // ->groupBy('employee.jobtype.jobtype_id')
        ->unique()
        ->values();

        $numeromodelos = $company->people()
         ->whereHas('provider')
        ->with('provider.jobtype')
        ->orderBy('id','DESC')
        ->get()
      //   ->pluck('provider')
        // ->whereIn('jobtype_id',[3,4]) TODO: sirve en uno solo
      //   ->where('jobtype_id','=','4')
        //  ->whereBetween('created_at', array($request->fechain,$request->fechater))
         // ->groupBy('provider.jobtype.jobtype_id')
        ->unique()
        ->values();

      // $data = ['data'=>$accountproductiondetails];
      // $data = ['data'=>$numeroempleados,'data1'=>$numeromodelos];
      // return $this->showAll($data);

      $pdf = PDF::loadView('pdf.antiquemodelmonitor', compact('numeroempleados','numeromodelos'));

      return $pdf->download('antiguedad-modelo-monitor.pdf');

   }

}
