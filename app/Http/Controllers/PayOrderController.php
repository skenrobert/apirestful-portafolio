<?php
namespace App\Http\Controllers;

use App\Models\PayOrder;
use Illuminate\Http\Request;

class PayOrderController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    // public function index()
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de PayOrder"]
    //     ];

    //     // $payorder = PayOrder::orderBy('id','DESC');   
    //     // $payorder = PayOrder::orderBy('id','ASC')->pluck('number', 'location', 'id');
    //     $payorder= PayOrder::orderBy('id','DESC')->get();
          
    //     $data = ['data'=>$payorder, 'breadcrumbs'=> $breadcrumbs];
    //     return $this->showAll($data);

    // }

    public function store(Request $request)
    {
        $payorder = PayOrder::create($request->all());
        return $this->showOne($payorder, 201);
    }

    public function show(PayOrder $payorder)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Cuentas por Pagar"]
        ];

        $data = ['data'=>$payorder, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, PayOrder $payorder)
    {
        $payorder->fill($request->all())->save();
        return $this->showOne($payorder);
    }

    public function destroy(PayOrder $payorder)
    {
        $payorder->delete($payorder);
        return $this->showOne($payorder);
    }
}
