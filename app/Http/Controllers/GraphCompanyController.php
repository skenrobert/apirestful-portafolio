<?php

namespace App\Http\Controllers;

use App\Models\AccountProductionDetails;
use App\Models\Company;
use App\Models\Event;
use App\Models\User;
use App\Models\TypeMovementInventory;
use App\Models\ProductionMaster;
use App\Models\ShiftHasPlanning;
use App\Models\ProductionDetailsConnec;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GraphCompanyController extends ApiController
{

    public function siteModels(Request $request, Company $company)//TODO: el calculo de la ganacia de los sud-estudios tambien debe ser por produccion
    {


      $fecha_arra = [];
      $total_date = [];
      $arra = [];
      $arra_total = [];

      if ($request->week == 1) {

        $start = Carbon::now()->startOfMonth()->toDateString(); 
        $end = Carbon::now()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->format('Y-m-d');

                  $fecha = Carbon::now()->startOfWeek();
                  $total_date[] = $fecha->toDateString();
            
                  for ($i=1; $i < 7; $i++) { 
            
                    $total_date[] = Carbon::now()->startOfWeek()->addDay($i)->toDateString();
                    
                  }
                  // dd($start.' '.$end );


      }else if ($request->week == 2) {

        $start = Carbon::now()->startOfWeek()->subWeek()->toDateString(); 
        $end = Carbon::now()->startOfWeek()->subWeek()->endOfWeek()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->subWeek()->endOfWeek()->format('Y-m-d');

            $fecha = Carbon::now()->startOfWeek()->subWeek(); 
            $total_date[] = $fecha->toDateString();
  
            for ($i=1; $i < 7; $i++) { 
      
              $total_date[] = Carbon::now()->startOfWeek()->subWeek(2)->addDay($i)->toDateString();
              
            }

      }else if ($request->week == 3) {

        $start = Carbon::now()->startOfWeek()->subWeek(4)->toDateString(); 
        $end = Carbon::now()->startOfWeek()->subWeek(4)->endOfWeek()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->subWeek(4)->endOfWeek()->toDateString();

              $fecha = Carbon::now()->startOfWeek()->subWeek(4); 
              $total_date[] = $fecha->toDateString();
      
                for ($i=1; $i < 7; $i++) { 
          
                  $total_date[] = Carbon::now()->startOfWeek()->subWeek(4)->addDay($i)->toDateString();
                  
                }
      }

      $countsitemodels_id = $company->accounts()
    ->with('account_production_details')
    ->orderBy('id','DESC')
    ->get()
    ->pluck('account_production_details')
    ->collapse()
    ->whereBetween('created_at', array($start,  $end.' 23:59:00'))
    ->pluck('id')
     ->unique()
     ->values();
     

        $countsitemodels = $company->accounts()
        ->with('account_production_details')
        ->orderBy('id','DESC')
        ->get()
        ->where('user_id','=', $request->user_id)
        ->where('site_id','=', 1)
        ->pluck('account_production_details')
         ->unique()
         ->collapse()
         ->whereIn('id', $countsitemodels_id)
         ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;
                
       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 2)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 3)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 4)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 5)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 6)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 7)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 8)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $data = [
        'data'=>$total_date,
        'data1'=>$arra_total,
      ];
       return $this->showAll($data);

    }




    public function siteModelsMonth(Request $request, Company $company)//TODO: el calculo de la ganacia de los sud-estudios tambien debe ser por produccion
    {


      $fecha_arra = [];
      $total_date = [];
      $arra = [];
      $arra_total = [];

      if ($request->week == 1) {

        $start = Carbon::now()->startOfWeek()->toDateString(); 
        $end = Carbon::now()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->format('Y-m-d');

                  $fecha = Carbon::now()->startOfWeek();
                  $total_date[] = $fecha->toDateString();
            
                  for ($i=1; $i < 7; $i++) { 
            
                    $total_date[] = Carbon::now()->startOfWeek()->addDay($i)->toDateString();
                    
                  }


      }else if ($request->week == 2) {

        $start = Carbon::now()->startOfWeek()->subWeek()->toDateString(); 
        $end = Carbon::now()->startOfWeek()->subWeek()->endOfWeek()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->subWeek()->endOfWeek()->format('Y-m-d');

            $fecha = Carbon::now()->startOfWeek()->subWeek(); 
            $total_date[] = $fecha->toDateString();
  
            for ($i=1; $i < 7; $i++) { 
      
              $total_date[] = Carbon::now()->startOfWeek()->subWeek(2)->addDay($i)->toDateString();
              
            }

      }else if ($request->week == 3) {

        $start = Carbon::now()->subMonth()->toDateString(); 
        $end = Carbon::now()->subMonth()->endOfMonth()->toDateString(); 

        // $end = Carbon::now()->startOfWeek()->subWeek(4)->endOfWeek()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->subWeek(4)->endOfWeek()->toDateString();

              $fecha = Carbon::now()->startOfWeek()->subWeek(4); 
              $total_date[] = $fecha->toDateString();
      
                for ($i=1; $i < 7; $i++) { 
          
                  $total_date[] = Carbon::now()->startOfWeek()->subWeek(4)->addDay($i)->toDateString();
                  
                }

          // dd($start.' '.$end );

      }

      $countsitemodels_id = $company->accounts()
    ->with('account_production_details')
    ->orderBy('id','DESC')
    ->get()
    ->pluck('account_production_details')
    ->collapse()
    ->whereBetween('created_at', array($start,  $end.' 23:59:00'))
    ->pluck('id')
     ->unique()
     ->values();
     

        $countsitemodels = $company->accounts()
        ->with('account_production_details')
        ->orderBy('id','DESC')
        ->get()
        ->where('user_id','=', $request->user_id)
        ->where('site_id','=', 1)
        ->pluck('account_production_details')
         ->unique()
         ->collapse()
         ->whereIn('id', $countsitemodels_id)
         ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;
                
       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 2)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 3)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 4)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 5)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 6)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 7)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $countsitemodels = $company->accounts()
       ->with('account_production_details')
       ->orderBy('id','DESC')
       ->get()
       ->where('user_id','=', $request->user_id)
       ->where('site_id','=', 8)
       ->pluck('account_production_details')
        ->unique()
        ->collapse()
        ->whereIn('id', $countsitemodels_id)
        ->sum('dolar');//3054

       $arra_total[] = $countsitemodels;

       $data = [
        'data'=>$arra_total
      ];
       return $this->showAll($data);

    }



    public function countSiteModels(Request $request, Company $company)//TODO: el calculo de la ganacia de los sud-estudios tambien debe ser por produccion
    {

      $fecha_arra = [];
      $total_date = [];
      $arra = [];
      $arra_total = [];

      if ($request->week == 1) {

        $start = Carbon::now()->startOfWeek()->toDateString(); 
        $end = Carbon::now()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->format('Y-m-d');

                  $fecha = Carbon::now()->startOfWeek();
                  $total_date[] = $fecha->toDateString();
            
                  for ($i=1; $i < 7; $i++) { 
            
                    $total_date[] = Carbon::now()->startOfWeek()->addDay($i)->toDateString();
                    
                  }


      }else if ($request->week == 2) {

        $start = Carbon::now()->startOfWeek()->subWeek()->toDateString(); 
        $end = Carbon::now()->startOfWeek()->subWeek()->endOfWeek()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->subWeek()->endOfWeek()->format('Y-m-d');

            $fecha = Carbon::now()->startOfWeek()->subWeek(); 
            $total_date[] = $fecha->toDateString();
  
            for ($i=1; $i < 7; $i++) { 
      
              $total_date[] = Carbon::now()->startOfWeek()->subWeek(2)->addDay($i)->toDateString();
              
            }

      }else if ($request->week == 3) {

        $start = Carbon::now()->startOfWeek()->subWeek(4)->toDateString(); 
        $end = Carbon::now()->startOfWeek()->subWeek(4)->endOfWeek()->toDateString(); 

        $fecha_arra[] = Carbon::now()->startOfWeek()->subWeek(4)->endOfWeek()->toDateString();

              $fecha = Carbon::now()->startOfWeek()->subWeek(4); 
              $total_date[] = $fecha->toDateString();
      
                for ($i=1; $i < 7; $i++) { 
          
                  $total_date[] = Carbon::now()->startOfWeek()->subWeek(4)->addDay($i)->toDateString();
                  
                }
      }

      $countsitemodels_id = $company->accounts()
    ->with('account_production_details')
    ->orderBy('id','DESC')
    ->get()
    ->pluck('account_production_details')
    ->collapse()
    ->whereBetween('created_at', array($start,  $end.' 23:59:00'))
    ->pluck('id')
     ->unique()
     ->values();
     

        $countsitemodels = $company->accounts()
        ->with('account_production_details')
        ->orderBy('id','DESC')
        ->get()
        ->where('user_id','=', $request->user_id)
        ->where('site_id','=', 1)
        ->pluck('account_production_details')
         ->unique()
         ->collapse()
         ->whereIn('id', $countsitemodels_id)
         ->values();//3054

              for ($i=0; $i < count($total_date) ; $i++) { 

                $valor = 0;

                        foreach($countsitemodels as $countsitemodel){

                                if ($total_date[$i] == $countsitemodel->created_at->format('Y-m-d')) {

                                      $valor = $valor + $countsitemodel->dolar;
                                }else {

                                  $valor = $valor + 0;
                                }
                        }
                            $arra[] = $valor;

                  }

                  $arra_total[] = $arra;
                  $arra = [];

                  $countsitemodels = $company->accounts()
                  ->with('account_production_details')
                  ->orderBy('id','DESC')
                  ->get()
                  ->where('user_id','=', $request->user_id)
                  ->where('site_id','=', 2)
                  ->pluck('account_production_details')
                   ->unique()
                   ->collapse()
                   ->whereIn('id', $countsitemodels_id)
                   ->values();//

          
                        for ($i=0; $i < count($total_date) ; $i++) { 
          
                          $valor = 0;
                                  foreach($countsitemodels as $countsitemodel){
          
                                                // dd(count($total_date));
                                  
                                          if ($total_date[$i] == $countsitemodel->created_at->format('Y-m-d')) {
          
                                                $valor = $valor + $countsitemodel->dolar;
                                          }else {
          
                                            $valor = $valor + 0;
                                          }
                                  }
                                      $arra[] = $valor;
          
                            }
          
                            $arra_total[] = $arra;
                            $arra = [];

                            $countsitemodels = $company->accounts()
                            ->with('account_production_details')
                            ->orderBy('id','DESC')
                            ->get()
                            ->where('user_id','=', $request->user_id)
                            ->where('site_id','=', 3)
                            ->pluck('account_production_details')
                             ->unique()
                             ->collapse()
                             ->whereIn('id', $countsitemodels_id)
                             ->values();//3054
                    
                                  for ($i=0; $i < count($total_date) ; $i++) { 
                    
                                    $valor = 0;
                                            foreach($countsitemodels as $countsitemodel){
                    
                                                          // dd(count($total_date));
                                            
                                                    if ($total_date[$i] == $countsitemodel->created_at->format('Y-m-d')) {
                    
                                                          $valor = $valor + $countsitemodel->dolar;
                                                    }else {
                    
                                                      $valor = $valor + 0;
                                                    }
                                            }
                                                $arra[] = $valor;
                    
                                      }
                    
                                      $arra_total[] = $arra;
                                      $arra = [];

                                      $countsitemodels = $company->accounts()
                                      //   ->whereHas('billtopay.users.person.provider.jobtype')
                                      ->with('account_production_details')
                                      ->orderBy('id','DESC')
                                      ->get()
                                      ->where('user_id','=', $request->user_id)
                                      ->where('site_id','=', 4)
                                      ->pluck('account_production_details')
                                       ->unique()
                                       ->collapse()
                                       ->whereIn('id', $countsitemodels_id)
                                       ->values();//3054
                              
                                            for ($i=0; $i < count($total_date) ; $i++) { 
                              
                                              $valor = 0;
                                                      foreach($countsitemodels as $countsitemodel){
                              
                                                                    // dd(count($total_date));
                                                      
                                                              if ($total_date[$i] == $countsitemodel->created_at->format('Y-m-d')) {
                              
                                                                    $valor = $valor + $countsitemodel->dolar;
                                                              }else {
                              
                                                                $valor = $valor + 0;
                                                              }
                                                      }
                                                          $arra[] = $valor;
                              
                                                }
                              
                                                $arra_total[] = $arra;
                                                $arra = [];

                                            $countsitemodels = $company->accounts()
                                            //   ->whereHas('billtopay.users.person.provider.jobtype')
                                            ->with('account_production_details')
                                            ->orderBy('id','DESC')
                                            ->get()
                                            ->where('user_id','=', $request->user_id)
                                            ->where('site_id','=', 5)
                                            ->pluck('account_production_details')
                                            ->unique()
                                            ->collapse()
                                            ->whereIn('id', $countsitemodels_id)
                                            ->values();//3054

                                                  for ($i=0; $i < count($total_date) ; $i++) { 

                                                    $valor = 0;
                                                            foreach($countsitemodels as $countsitemodel){

                                                                          // dd(count($total_date));
                                                            
                                                                    if ($total_date[$i] == $countsitemodel->created_at->format('Y-m-d')) {

                                                                          $valor = $valor + $countsitemodel->dolar;
                                                                    }else {

                                                                      $valor = $valor + 0;
                                                                    }
                                                            }
                                                                $arra[] = $valor;

                                                      }

                                                      $arra_total[] = $arra;
                                                      $arra = [];


                                                      $countsitemodels = $company->accounts()
                                                      //   ->whereHas('billtopay.users.person.provider.jobtype')
                                                      ->with('account_production_details')
                                                      ->orderBy('id','DESC')
                                                      ->get()
                                                      ->where('user_id','=', $request->user_id)
                                                      ->where('site_id','=', 6)
                                                      ->pluck('account_production_details')
                                                      ->unique()
                                                      ->collapse()
                                                      ->whereIn('id', $countsitemodels_id)
                                                      ->values();//3054
          
                                                            for ($i=0; $i < count($total_date) ; $i++) { 
          
                                                              $valor = 0;
                                                                      foreach($countsitemodels as $countsitemodel){
          
                                                                                    // dd(count($total_date));
                                                                      
                                                                              if ($total_date[$i] == $countsitemodel->created_at->format('Y-m-d')) {
          
                                                                                    $valor = $valor + $countsitemodel->dolar;
                                                                              }else {
          
                                                                                $valor = $valor + 0;
                                                                              }
                                                                      }
                                                                          $arra[] = $valor;
          
                                                                }
          
                                                                $arra_total[] = $arra;
                                                                $arra = [];  

                                                                $countsitemodels = $company->accounts()
                                                                ->with('account_production_details')
                                                                ->orderBy('id','DESC')
                                                                ->get()
                                                                ->where('user_id','=', $request->user_id)
                                                                ->where('site_id','=', 7)
                                                                ->pluck('account_production_details')
                                                                ->unique()
                                                                ->collapse()
                                                                ->whereIn('id', $countsitemodels_id)
                                                                ->values();//3054
                    
                                                                      for ($i=0; $i < count($total_date) ; $i++) { 
                    
                                                                        $valor = 0;
                                                                                foreach($countsitemodels as $countsitemodel){
                    
                                                                                              // dd(count($total_date));
                                                                                
                                                                                        if ($total_date[$i] == $countsitemodel->created_at->format('Y-m-d')) {
                    
                                                                                              $valor = $valor + $countsitemodel->dolar;
                                                                                        }else {
                    
                                                                                          $valor = $valor + 0;
                                                                                        }
                                                                                }
                                                                                    $arra[] = $valor;
                    
                                                                          }
                    
                                                                          $arra_total[] = $arra;
                                                                          $arra = [];

                                                                          $countsitemodels = $company->accounts()
                                                                          ->with('account_production_details')
                                                                          ->orderBy('id','DESC')
                                                                          ->get()
                                                                          ->where('user_id','=', $request->user_id)
                                                                          ->where('site_id','=', 8)
                                                                          ->pluck('account_production_details')
                                                                          ->unique()
                                                                          ->collapse()
                                                                          ->whereIn('id', $countsitemodels_id)
                                                                          ->values();//3054
                              
                                                                                for ($i=0; $i < count($total_date) ; $i++) { 
                              
                                                                                  $valor = 0;
                                                                                          foreach($countsitemodels as $countsitemodel){
                              
                                                                                                  if ($total_date[$i] == $countsitemodel->created_at->format('Y-m-d')) {
                              
                                                                                                        $valor = $valor + $countsitemodel->dolar;
                                                                                                  }else {
                              
                                                                                                    $valor = $valor + 0;
                                                                                                  }
                                                                                          }
                                                                                              $arra[] = $valor;
                              
                                                                                    }
                              
                                                                                    $arra_total[] = $arra;
       $data = [
        'data'=>$total_date,
        'data1'=>$arra_total,
      ];
       return $this->showAll($data);

    }

    
    //***********************************Dashboard Monitor */

    public function weekMonitor(Request $request, Company $company)
    {
        $arra = $company->shifthasplanning()
        // ->whereHas('shift')
        ->with('monitorshift.productiondetailsshift')
        ->orderBy('id','DESC')
        ->get()

        ->pluck('id')
        ->unique()
        ->values();

        if (isset($arra[0])) {

            $shifthasplanning1 = ShiftHasPlanning::find($arra[0]);

            $shifthasplanning1 = $shifthasplanning1->monitorshift()
            // ->whereHas('shift')
            ->with('productiondetailsshift')
            ->orderBy('id','DESC')
            ->get()

            ->where('monitor_id','=', $request->user_id)
            ->unique()
            ->values();

          }else{
            $shifthasplanning1 = 0;
          }

        if (isset($arra[1])) {

              $shifthasplanning2 = ShiftHasPlanning::find($arra[1]);

              $shifthasplanning2 = $shifthasplanning2->monitorshift()
              // ->whereHas('shift')
              ->with('productiondetailsshift')
              ->orderBy('id','DESC')
              ->get()

              ->where('monitor_id','=', $request->user_id)
              ->unique()
              ->values();

        }else{
          $shifthasplanning2 = 0;
        }

        $data = ['data'=>$shifthasplanning1, 'data2'=>$shifthasplanning2];
        // $data = $shifthasplannings;
        return $this->showAll($data);
    }


    public function commissionMonth(Request $request, Company $company)
    {

            $knownDate = Carbon::now();

            $PreviousMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString(); 
            $PreviousEndMonth = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString(); 
            // $PreviousMonth2 = Carbon::now()->startOfMonth()->subMonth(2)->toDateString(); 
            // $EndMonth2 = Carbon::now()->startOfMonth()->subMonth(2)->endOfMonth()->toDateString(); 

            $start = Carbon::now()->startOfMonth()->toDateString(); 
            // $start->startOfMonth()->subMonth()->toDateString(); 
            $end = Carbon::now()->startOfMonth()->endOfMonth()->toDateString(); 
            //$end->endOfMonth(); 

            //$data = ['month'=>$PreviousMonth, 'end'=> $EndMonth, 'start'=>$start, 'end2'=> $end];
          // return $this->showAll($data);
            //   $knownDate = new Carbon('next monday');

            //   $shifthasplanning = ShiftHasPlanning::orderBy('id','DESC')->where('company_id','=',$request->company_id)->where('beginning_week','=',$knownDate->format('Y-m-d'))->pluck('beginning_week')->toArray();

            $users = $company->user()
            // ->whereHas('user') 
            //->with('person')
            ->with('comissionemployees')
            ->orderBy('id','DESC')
            ->get()

            ->where('id','=', $request->user_id)
            ->pluck('comissionemployees')
            ->collapse()

            // ->groupBy('user_id');
            ->whereBetween('created_at', array($start,$end))

            ->sum('paycommission');
            // ->unique()
            // ->values();
          // ->toArray();

          $arre[] = $users;

            $users2 = $company->user()
            // ->whereHas('user') 
            //->with('person')
            ->with('comissionemployees')
            ->orderBy('id','DESC')
            ->get()

            ->where('id','=', $request->user_id)
            ->pluck('comissionemployees')
            ->collapse()

            // ->groupBy('user_id');
            ->whereBetween('created_at', array($PreviousMonth,$PreviousEndMonth))

            ->sum('paycommission');

            // ->unique()
            // ->values();
            // ->toArray();

          // $reversed = array_reverse($users);

          $arre[] = $users2;

          //  $arre = json_encode($arre);


      $data = ['data'=>$arre];
      return $this->showAll($data);
      
    }

    // $multas = $company->user()
    // ->with('events')
    // ->orderBy('id','DESC')
    // ->get()
    // ->pluck('events')
    // ->collapse() 
    // ->where('event_type_id','=', 3)
    // ->whereBetween('created_at', array($request->fechain,$request->fechater))
    // ->pluck('user_id')
    // ->unique()
    // ->values()
    // ->toArray();


    public function statusProductionMonitor(Request $request, Company $company)
    {

      $arra = $company->shifthasplanning()
      // ->whereHas('shift')
      ->with('monitorshift.productiondetailsshift')
      ->orderBy('id','DESC')
      ->get()

      ->pluck('id')
      ->unique()
      ->values();

      if (isset($arra[0])) {

          $shifthasplanning = ShiftHasPlanning::find($arra[0]);

          $production = $shifthasplanning->monitorshift()
          ->with('productiondetailsshift')
          ->orderBy('id','DESC')
          ->get()

          ->where('monitor_id','=', $request->user_id)
          ->pluck('productiondetailsshift')
          ->collapse()
          ->sum('dolar_total_monitor_shift');
          // ->unique()
          // ->values();

          $array_resul[] = $production;


          $meta = $shifthasplanning->monitorshift()
          ->orderBy('id','DESC')
          ->get()
          ->where('monitor_id','=', $request->user_id)
          ->unique()
          ->values();

             $array_resul[] = $meta[0]->goal_dollar_monitor;

        }else{
          $array_resul[] = 0;
          $array_resul[] = 0;
        }


      $data = ['data'=>$array_resul];
      // $data = $shifthasplannings;
      return $this->showAll($data);


    }


    //***********************************Dashboard */

    public function newModelBiannual(Request $request, Company $company)// pudiera hacerlo por la produccion total de los ultimos 6 meses 
    {
     
      $knownDate = Carbon::now();

      $today = Carbon::now()->toDateString(); 
      $start = Carbon::now()->startOfMonth()->toDateString(); 

      $TwoMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString(); 
      $TwoEndMonth = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString(); 

      $ThreeMonth = Carbon::now()->startOfMonth()->subMonth(2)->toDateString(); 
      $ThreeEndMonth = Carbon::now()->startOfMonth()->subMonth(2)->endOfMonth()->toDateString(); 

      $FourMonth = Carbon::now()->startOfMonth()->subMonth(3)->toDateString(); 
      $FourEndMonth = Carbon::now()->startOfMonth()->subMonth(3)->endOfMonth()->toDateString(); 

      $FiveMonth = Carbon::now()->startOfMonth()->subMonth(4)->toDateString(); 
      $FiveEndMonth = Carbon::now()->startOfMonth()->subMonth(4)->endOfMonth()->toDateString(); 

      $SixMonth = Carbon::now()->startOfMonth()->subMonth(5)->toDateString(); 
      $SixEndMonth = Carbon::now()->startOfMonth()->subMonth(5)->endOfMonth()->toDateString(); 

      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

      $users = $company->user()
      ->whereHas('roles')
      ->with('roles')
      ->get()
      ->where('status','=', true)
      ->pluck('roles')
      ->collapse()
      ->where('name','=', 'Modelo')
      ->pluck('pivot')
      ->pluck('user_id')
      ->unique();

      $NewModel[] = User::find($users)->whereBetween('created_at', array($SixMonth,$SixEndMonth))->count();

      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(5)->format('m')-1];

      $NewModel[] = User::find($users)->whereBetween('created_at', array($FiveMonth,$FiveEndMonth))->count();

      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(4)->format('m')-1];

      $NewModel[] = User::find($users)->whereBetween('created_at', array($FourMonth,$FourEndMonth))->count();

      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(3)->format('m')-1];

      $NewModel[] = User::find($users)->whereBetween('created_at', array($ThreeMonth,$ThreeEndMonth))->count();

      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(2)->format('m')-1];

      $NewModel[] = User::find($users)->whereBetween('created_at', array($TwoMonth,$TwoEndMonth))->count();

      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth()->format('m')-1];

      $NewModel[] = User::find($users)->whereBetween('created_at', array($start,$today))->count();

      $array_mes[] = $meses[Carbon::now()->format('m')-1];

      $data = ['data'=>$NewModel, 'data1'=>$array_mes];
      return $this->showAll($data);

    }

    public function eventDetails(Request $request, Company $company)// Pudiera mostrar la cantidad de eventos por tipo del mes en curso
    {

      $knownDate = Carbon::now();

      $today = Carbon::now()->toDateString(); 
      $start = Carbon::now()->startOfMonth()->toDateString(); 

      $TwoMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString(); 
      $TwoEndMonth = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString(); 

      $ThreeMonth = Carbon::now()->startOfMonth()->subMonth(2)->toDateString(); 
      $ThreeEndMonth = Carbon::now()->startOfMonth()->subMonth(2)->endOfMonth()->toDateString(); 

      $FourMonth = Carbon::now()->startOfMonth()->subMonth(3)->toDateString(); 
      $FourEndMonth = Carbon::now()->startOfMonth()->subMonth(3)->endOfMonth()->toDateString(); 

      $FiveMonth = Carbon::now()->startOfMonth()->subMonth(4)->toDateString(); 
      $FiveEndMonth = Carbon::now()->startOfMonth()->subMonth(4)->endOfMonth()->toDateString(); 

      $SixMonth = Carbon::now()->startOfMonth()->subMonth(5)->toDateString(); 
      $SixEndMonth = Carbon::now()->startOfMonth()->subMonth(5)->endOfMonth()->toDateString(); 

      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

      $Notificaction[] = Event::whereBetween('created_at', array($SixMonth,$SixEndMonth))->where('company_id','=',$company->id)->count();
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(5)->format('m')-1];

      $Notificaction[] = Event::whereBetween('created_at', array($FiveMonth,$FiveEndMonth))->where('company_id','=',$company->id)->count();
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(4)->format('m')-1];

      $Notificaction[] = Event::whereBetween('created_at', array($FourMonth,$FourEndMonth))->where('company_id','=',$company->id)->count();
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(3)->format('m')-1];

      $Notificaction[] = Event::whereBetween('created_at', array($ThreeMonth,$ThreeEndMonth))->where('company_id','=',$company->id)->count();
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(2)->format('m')-1];

      $Notificaction[] = Event::whereBetween('created_at', array($TwoMonth,$TwoEndMonth))->where('company_id','=',$company->id)->count();
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth()->format('m')-1];

      $Notificaction[] = Event::whereBetween('created_at', array($start,$today))->where('company_id','=',$company->id)->count();
      $array_mes[] = $meses[Carbon::now()->format('m')-1];

      $data = ['data'=>$Notificaction, 'data1'=>$array_mes];
      return $this->showAll($data);

    }

    public function statusProductionDashboard(Request $request, Company $company)
    {

      $productionmaster= ProductionMaster::all()->last();

      $array_resul[] = $productionmaster->dolar_total_week;
      $array_resul[] = $productionmaster->dolar_total_assigned;

      $data = ['data'=>$array_resul];
      return $this->showAll($data);

    }

    public function productionBiannual(Request $request, Company $company)// pudiera hacerlo por la produccion total de los ultimos 6 meses 
    {

      $knownDate = Carbon::now();

      $today = Carbon::now()->toDateString(); 
      $start = Carbon::now()->startOfMonth()->toDateString(); 

      $TwoMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString(); 
      $TwoEndMonth = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString(); 

      $ThreeMonth = Carbon::now()->startOfMonth()->subMonth(2)->toDateString(); 
      $ThreeEndMonth = Carbon::now()->startOfMonth()->subMonth(2)->endOfMonth()->toDateString(); 

      $FourMonth = Carbon::now()->startOfMonth()->subMonth(3)->toDateString(); 
      $FourEndMonth = Carbon::now()->startOfMonth()->subMonth(3)->endOfMonth()->toDateString(); 

      $FiveMonth = Carbon::now()->startOfMonth()->subMonth(4)->toDateString(); 
      $FiveEndMonth = Carbon::now()->startOfMonth()->subMonth(4)->endOfMonth()->toDateString(); 

      $SixMonth = Carbon::now()->startOfMonth()->subMonth(5)->toDateString(); 
      $SixEndMonth = Carbon::now()->startOfMonth()->subMonth(5)->endOfMonth()->toDateString(); 

      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      

      $productionmaster[]= ProductionMaster::whereBetween('created_at', array($SixMonth,$SixEndMonth))->where('company_id','=',$company->id)->sum('dolar_total_week');
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(5)->format('m')-1];

      $productionmaster[]= ProductionMaster::whereBetween('created_at', array($FiveMonth,$FiveEndMonth))->where('company_id','=',$company->id)->sum('dolar_total_week');
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(4)->format('m')-1];

      $productionmaster[]= ProductionMaster::whereBetween('created_at', array($FourMonth,$FourEndMonth))->where('company_id','=',$company->id)->sum('dolar_total_week');
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(3)->format('m')-1];

      $productionmaster[]= ProductionMaster::whereBetween('created_at', array($ThreeMonth,$ThreeEndMonth))->where('company_id','=',$company->id)->sum('dolar_total_week');
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(2)->format('m')-1];

      $productionmaster[]= ProductionMaster::whereBetween('created_at', array($TwoMonth,$TwoEndMonth))->where('company_id','=',$company->id)->sum('dolar_total_week');
      $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth()->format('m')-1];

      $productionmaster[]= ProductionMaster::whereBetween('created_at', array($start,$today))->where('company_id','=',$company->id)->sum('dolar_total_week');
      $array_mes[] = $meses[Carbon::now()->format('m')-1];

      $data = ['data'=>$productionmaster, 'data1'=>$array_mes];
      return $this->showAll($data);

    }


    public function productionMonth(Request $request, Company $company)// pudiera hacerlo por la produccion que hico el mes pasado con la de este
    {

      $knownDate = Carbon::now();

      $today = Carbon::now()->toDateString(); 
      $start = Carbon::now()->startOfMonth()->toDateString(); 

      $TwoMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString(); 
      $TwoEndMonth = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString(); 

      $productionmaster[] = ProductionMaster::whereBetween('created_at', array($start,$today))->where('company_id','=',$company->id)->sum('dolar_total_week');

      $productionmaster[] = ProductionMaster::whereBetween('created_at', array($TwoMonth,$TwoEndMonth))->where('company_id','=',$company->id)->sum('dolar_total_week');

      $productionActual = ProductionMaster::whereBetween('created_at', array($start,$today))->where('company_id','=',$company->id)->pluck('dolar_total_week')->unique();

      $productionAnterior = ProductionMaster::whereBetween('created_at', array($TwoMonth,$TwoEndMonth))->where('company_id','=',$company->id)->pluck('dolar_total_week')->unique();


      $data = ['data'=>$productionActual, 'data1'=>$productionAnterior, 'data2'=>$productionmaster];
      return $this->showAll($data);

    }


    public function salesBiannual(Request $request, Company $company)// pudiera hacerlo por la ventas de las modelos
    {

      $knownDate = Carbon::now();

      $today = Carbon::now()->toDateString(); 
      $start = Carbon::now()->startOfMonth()->toDateString(); 

      $TwoMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString(); 
      $TwoEndMonth = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString(); 

      $ThreeMonth = Carbon::now()->startOfMonth()->subMonth(2)->toDateString(); 
      $ThreeEndMonth = Carbon::now()->startOfMonth()->subMonth(2)->endOfMonth()->toDateString(); 

      $FourMonth = Carbon::now()->startOfMonth()->subMonth(3)->toDateString(); 
      $FourEndMonth = Carbon::now()->startOfMonth()->subMonth(3)->endOfMonth()->toDateString(); 

      $FiveMonth = Carbon::now()->startOfMonth()->subMonth(4)->toDateString(); 
      $FiveEndMonth = Carbon::now()->startOfMonth()->subMonth(4)->endOfMonth()->toDateString(); 

      $SixMonth = Carbon::now()->startOfMonth()->subMonth(5)->toDateString(); 
      $SixEndMonth = Carbon::now()->startOfMonth()->subMonth(5)->endOfMonth()->toDateString(); 

      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      

      $typemovementinventory[] = $company->shops()
      ->whereHas('inventory.typemovementinventory')
     ->with('inventory.typemovementinventory')
     ->orderBy('id','DESC')
     ->get()
     ->pluck('inventory')
     ->pluck('typemovementinventory')
     ->collapse()
     ->where('movement_type_id','=',3)
     ->whereBetween('created_at', array($SixMonth,$SixEndMonth))
     ->sum('totalOut');

     $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(5)->format('m')-1];

     $typemovementinventory[] = $company->shops()
     ->whereHas('inventory.typemovementinventory')
    ->with('inventory.typemovementinventory')
    ->orderBy('id','DESC')
    ->get()
    ->pluck('inventory')
    ->pluck('typemovementinventory')
    ->collapse()
    ->where('movement_type_id','=',3)
    ->whereBetween('created_at', array($FiveMonth,$FiveEndMonth))
    ->sum('totalOut');

    $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(4)->format('m')-1];


    $typemovementinventory[] = $company->shops()
    ->whereHas('inventory.typemovementinventory')
   ->with('inventory.typemovementinventory')
   ->orderBy('id','DESC')
   ->get()
   ->pluck('inventory')
   ->pluck('typemovementinventory')
   ->collapse()
   ->where('movement_type_id','=',3)
   ->whereBetween('created_at', array($FourMonth,$FourEndMonth))
   ->sum('totalOut');

   $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(3)->format('m')-1];


    $typemovementinventory[] = $company->shops()
    ->whereHas('inventory.typemovementinventory')
   ->with('inventory.typemovementinventory')
   ->orderBy('id','DESC')
   ->get()
   ->pluck('inventory')
   ->pluck('typemovementinventory')
   ->collapse()
   ->where('movement_type_id','=',3)
   ->whereBetween('created_at', array($ThreeMonth,$ThreeEndMonth))
   ->sum('totalOut');

   $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth(2)->format('m')-1];


   $typemovementinventory[] = $company->shops()
   ->whereHas('inventory.typemovementinventory')
  ->with('inventory.typemovementinventory')
  ->orderBy('id','DESC')
  ->get()
  ->pluck('inventory')
  ->pluck('typemovementinventory')
  ->collapse()
  ->where('movement_type_id','=',3)
  ->whereBetween('created_at', array($TwoMonth,$TwoEndMonth))
  ->sum('totalOut');

  $array_mes[] = $meses[Carbon::now()->startOfMonth()->subMonth()->format('m')-1];

  $typemovementinventory[] = $company->shops()
  ->whereHas('inventory.typemovementinventory')
 ->with('inventory.typemovementinventory')
 ->orderBy('id','DESC')
 ->get()
 ->pluck('inventory')
 ->pluck('typemovementinventory')
 ->collapse()
 ->where('movement_type_id','=',3)
 ->whereBetween('created_at', array($start,$today))
 ->sum('totalOut');

 $array_mes[] = $meses[Carbon::now()->format('m')-1];


      $data = ['data'=>$typemovementinventory, 'data1'=>$array_mes];
      return $this->showAll($data);

//totalInventory
      // series: [{
      //   name: 'Sales',
      //   data: [100, 1, 100, 1, 100, 1]
      // }],

    }






    //*************************************************************** */

    
}
