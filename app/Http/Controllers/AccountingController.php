<?php

namespace App\Http\Controllers;

use App\Models\Accounting;
use Illuminate\Http\Request;

class AccountingController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');
    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Accounting"]
        // ];

        // // $accountings = Accounting::orderBy('id','DESC');   
        // // $accountings = Accounting::orderBy('id','ASC')->pluck('number', 'location', 'id');
        // $accountings= Accounting::orderBy('id','DESC')->get();
          
        // $data = ['data'=>$accountings, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }

    public function store(Request $request)
    {
        // $accounting = Accounting::create($request->all());
        // return $this->showOne($accounting, 201);
    }

    public function show(Accounting $accounting)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Contabilidad"]
        ];

        $data = ['data'=>$accounting, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Accounting $accounting)
    {
        $accounting->fill($request->all())->save();
        return $this->showOne($accounting);
    }

    public function destroy(Accounting $accounting)
    {
        // $accounting->delete($accounting);
        // return $this->showOne($accounting);
    }
}
