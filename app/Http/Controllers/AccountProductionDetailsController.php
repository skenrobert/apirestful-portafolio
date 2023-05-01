<?php

namespace App\Http\Controllers;

use App\Models\AccountProductionDetails;
use App\Models\ProductionDetailsConnec;
use App\Models\ProductionDetailsShift;
use App\Models\ProductionDetailsDay;
use App\Models\ProductionMaster;
use Illuminate\Http\Request;

class AccountProductionDetailsController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');
    }
    
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Detalles de producion por cuenta"]
        ];

        $accountproductiondetails = AccountProductionDetails::orderBy('id','DESC')->get();

        $data = ['data'=>$accountproductiondetails, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $accountproductiondetail = AccountProductionDetails::create($request->all());

                $accountproductiondetail->dolar = $accountproductiondetail->tkn * $accountproductiondetail->accounts->sites->token_value;
                $accountproductiondetail->save();

        $productiondetailsconnec = ProductionDetailsConnec::findOrFail($request->production_details_connec_id);
        // dd($request->dolar);
        // dd($request->dolar + $productiondetailsconnec->tkn_total_provider);
        $productiondetailsconnec->dolar_total_provider = $accountproductiondetail->dolar + $productiondetailsconnec->dolar_total_provider;
        $productiondetailsconnec->tkn_total_provider = $request->tkn + $productiondetailsconnec->tkn_total_provider;
        $productiondetailsconnec->save();

        // dd($productiondetailsconnec->production_details_shift_id);

        $productiondetailsshift = ProductionDetailsShift::findOrFail($productiondetailsconnec->production_details_shift_id);
        $productiondetailsshift->dolar_total_monitor_shift = $productiondetailsshift->dolar_total_monitor_shift + $productiondetailsconnec->dolar_total_provider;
        $productiondetailsshift->tkn_total_monitor = $productiondetailsshift->tkn_total_monitor + $productiondetailsconnec->tkn_total_provider;
        $productiondetailsshift->save();

        $productiondetailsday = ProductionDetailsDay::findOrFail($productiondetailsshift->production_details_day_id);
        $productiondetailsday->dolar_total_day = $productiondetailsday->dolar_total_day + $productiondetailsshift->dolar_total_monitor_shift;
        $productiondetailsday->tkn_total_day = $productiondetailsday->tkn_total_day + $productiondetailsshift->tkn_total_monitor;
        $productiondetailsday->save();

        $productionmaster = ProductionMaster::findOrFail($productiondetailsshift->production_details_day_id);
        $productionmaster->tkn_total_week = $productionmaster->tkn_total_week + $productiondetailsday->tkn_total_day;
        $productionmaster->dolar_total_week = $productionmaster->dolar_total_week + $productiondetailsday->dolar_total_day;
        $productionmaster->save();

        $data = ['data'=>$accountproductiondetail];//, 'productionmaster'=> $productionmaster

        return $this->showOne($data, 201);
        
    }

    public function show(AccountProductionDetails $accountproductiondetail)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Detalles de producion por cuenta"]
        ];

        $accountproductiondetail->production_details_connec;
        $accountproductiondetail->account;

        $data = ['data'=>$accountproductiondetail, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, AccountProductionDetails $accountproductiondetail)
    {
        $accountproductiondetail->fill($request->all())->save();

        $productiondetailsconnec = ProductionDetailsConnec::findOrFail($accountproductiondetail->production_details_connec_id);
        // dd($request->dolar);
        // dd($request->dolar + $productiondetailsconnec->tkn_total_provider);
        $productiondetailsconnec->dolar_total_provider = $request->dolar + $productiondetailsconnec->dolar_total_provider;
        $productiondetailsconnec->tkn_total_provider = $request->tkn + $productiondetailsconnec->tkn_total_provider;
        $productiondetailsconnec->save();

        // dd($productiondetailsconnec->production_details_shift_id);

        $productiondetailsshift = ProductionDetailsShift::findOrFail($productiondetailsconnec->production_details_shift_id);
        $productiondetailsshift->dolar_total_monitor_shift = $productiondetailsshift->dolar_total_monitor_shift + $productiondetailsconnec->dolar_total_provider;
        $productiondetailsshift->tkn_total_monitor = $productiondetailsshift->tkn_total_monitor + $productiondetailsconnec->tkn_total_provider;
        $productiondetailsshift->save();

        $productiondetailsday = ProductionDetailsDay::findOrFail($productiondetailsshift->production_details_day_id);
        $productiondetailsday->dolar_total_day = $productiondetailsday->dolar_total_day + $productiondetailsshift->dolar_total_monitor_shift;
        $productiondetailsday->tkn_total_day = $productiondetailsday->tkn_total_day + $productiondetailsshift->tkn_total_monitor;
        $productiondetailsday->save();

        $productionmaster = ProductionMaster::findOrFail($productiondetailsshift->production_details_day_id);
        $productionmaster->tkn_total_week = $productionmaster->tkn_total_week + $productiondetailsday->tkn_total_day;
        $productionmaster->dolar_total_week = $productionmaster->dolar_total_week + $productiondetailsday->dolar_total_day;
        $productionmaster->save();



        return $this->showOne($accountproductiondetail);
    }

    public function destroy(AccountProductionDetails $accountproductiondetail)
    {
        $accountproductiondetail->delete($accountproductiondetail);
        return $this->showOne($accountproductiondetail);
    }

  
}
