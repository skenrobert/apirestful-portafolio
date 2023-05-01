<?php

namespace App\Http\Controllers;

use App\Models\CompanyType;
use Illuminate\Http\Request;

class CompanyTypeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Tipos de Compañeas"]
        ];
     
        $companytype= CompanyType::orderBy('id','DESC')->get();

         // $companytype->each(function($companytype){
        //     $companytype->companies;
        //   });

        $data = ['data'=>$companytype, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);

    }
 
    public function store(Request $request)
    {
        // $companytype = CompanyType::create($request->all());
        // $data = ['data'=>$companytype];
        //  return $this->showOne($data, 201);
    }

    public function show(CompanyType $companytype)
    {
        // $companytype->companies;
        $data = ['data'=>$companytype];
        return $this->showOne($data);
    }

    public function update(Request $request, CompanyType $companytype)
    {
        $companytype->fill($request->all())->save();
        return $this->showOne($companytype);
    }

    public function destroy(CompanyType $companyType)
    {
        // $companyType->delete($companyType);
        // return $this->showOne($companyType);
    }
}
