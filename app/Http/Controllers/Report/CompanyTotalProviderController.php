<?php
namespace App\Http\Controllers\Report;

use App\Http\Controllers\ApiController;
use App\Models\Company;
use App\Models\AccountProductionDetails;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyTotalProviderController extends ApiController
{
    public function index(Company $company)
    {
//TODO si se hace por aqui se debe borrar provider id de connect
        $fechain = '2020-04-07 00:00:00';
        $fechater = '2020-04-09 00:00:00';

        $connectotalprovider = $company->people()
        ->whereHas('provider')
        ->with('provider.accounts.account_production_details.production_details_connec')
        ->orderBy('id','DESC')
        ->get()


        ->pluck('provider')
        ->pluck('accounts')
        ->collapse()

        ->pluck('account_production_details')
        ->collapse()

        // ->where(DB::raw("DATE(created_at) = '".date('Y-m-d')."'"))
         ->whereBetween('created_at', array($fechain,$fechater))


        // ->sum('accounts.account_production_details.dolar');

        ->unique()
        ->values();

        // $connectotalprovider = $company->accounts()
        // // ->whereHas('Provider')
        // // ->with('account_production_details.account.provider')
        // ->with('account_production_details.production_details_connec')
        // ->orderBy('id','DESC')

        // ->get()
        // // ->pluck('account_production_details')
        // // ->collapse('account_production_details')//->dump()
        // // ->where('account_production_details.account_id', '=', 'account_production_details.account_id')
        // // ->groupBy('account_id')
        // // ->sum('dolar');
        
        // ->unique()
        // ->values();



        // $connectotalprovider = $company->accounts()
        // // ->whereHas('Provider')
        // ->with('account_production_details.account.provider')
        // ->orderBy('id','DESC')

        // ->get()
        // ->pluck('account_production_details')
        // ->collapse('account_production_details')//->dump()
        // // ->where('account_production_details.account_id', '=', 'account_production_details.account_id')
        // // ->groupBy('account_id')
        // // ->sum('dolar');
        
        // ->unique()
        // ->values();

        // // $accountproductiondetails = DB::table('account_production_details')
        // // ->select(DB::raw('count(*) as user_count, dolar'))
        // // ->where('account_id', '=', 'account_id')
        // // ->groupBy('account_id')
        // // ->get();

        // $accountproductiondetails=DB::table('account_production_details')
        // ->join('accounts', 'account_production_details.account_id', '=', 'accounts.id')
        // // ->where('despachos.id_cliente', '=', $id)
        // //  ->whereBetween('despachos.fecha', array($fechain,$fechater))
        // ->select('account_production_details.account_id',DB::raw('sum(account_production_details.tkn) as total_tkn'),DB::raw('sum(account_production_details.dolar) as total_dolar'))//->dump()
        // ->groupBy('account_production_details.account_id')//->dump()
        // ->get();

   
        // $accountproductiondetails = AccountProductionDetails::sum('dolar');


        // $data = ['data'=>$accountproductiondetails];
        $data = ['data'=>$connectotalprovider];
        return $this->showAll($data);
    }

}
// Ganancia de Modelos, de Mayor a menor. 


// $accountproductiondetails=DB::table('account_production_details')
// ->join('accounts', 'account_production_details.account_id', '=', 'accounts.id')
// // ->where('despachos.id_cliente', '=', $id)
// //  ->whereBetween('despachos.fecha', array($fechain,$fechater))
// ->select('account_production_details.account_id',DB::raw('sum(account_production_details.tkn) as total_tkn'),DB::raw('sum(account_production_details.dolar) as total_dolar'))//->dd()
// ->groupBy('account_production_details.account_id')
// ->get();


// $connectotalprovider = $company->accounts()
// // ->whereHas('Provider')
// ->with('account_production_details')
// ->orderBy('id','DESC')

// ->get()
// ->pluck('account_production_details')
// ->collapse('')
// ->sum('dolar');





// ->whereHas('roles')
        // ->with('roles')
        // ->get()
        // ->pluck('roles')
        // ->collapse()
        // ->where('name','=',$request->name)
        // ->pluck('pivot')
        // ->pluck('user_id')
        // ->unique()
        // ->values()
        // ->toArray();


        // $query->withCount([
        //     'activity AS paid_sum' => function ($query) {
        //                 $query->select(DB::raw("SUM(amount_total) as paidsum"))->where('status', 'paid');
        //             }
        //         ]);


//         SELECT id_product, SUM(quantity) FROM 
//   (
//   SELECT ID_PRODUCT_1 as id_product, QUANTITY_PRODUCT_1 as quantity FROM MITABLA;
//     UNION ALL
//   SELECT ID_PRODUCT_2 as id_product, QUANTITY_PRODUCT_2 as quantity FROM MITABLA;
//     UNION ALL
//   SELECT ID_PRODUCT_3 as id_product, QUANTITY_PRODUCT_3 as quantity FROM MITABLA;
//     UNION ALL
//   SELECT ID_PRODUCT_4 as id_product, QUANTITY_PRODUCT_4 as quantity FROM MITABLA;
//     UNION ALL
//   SELECT ID_PRODUCT_5 as id_product, QUANTITY_PRODUCT_5 as quantity FROM MITABLA;

//   ) supertabla
// GROUP BY id_product

// return DB::table('orders')->where('finalized', 1)->exists();

// return DB::table('orders')->where('finalized', 1)->doesntExist();