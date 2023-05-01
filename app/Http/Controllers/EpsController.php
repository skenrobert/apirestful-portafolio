<?php

namespace App\Http\Controllers;

use App\Models\Eps;
use Illuminate\Http\Request;

class EpsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
       
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de EPS"]
        ];

        $epss = Eps::orderBy('id','DESC')->get();

        $data = ['data'=>$epss, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $epss = Eps::create($request->all());
        return $this->showOne($epss, 201);
        
    }

    public function show(Eps $epss)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Eps"]
        ];
        // dd($eps);

        $data = ['data'=>$epss, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Eps $epss)
    {
        $epss->fill($request->all())->save();
        return $this->showOne($epss);
    }

    public function destroy(Eps $epss)
    {
        $epss->delete($epss);
        return $this->showOne($epss);
    }

    // Return epss View
 
    public function eps_list(Eps $epss)
    {
        $breadcrumbs = [
            ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Todas las EPS"]
        ];

        return view('/pages/app-eps-list', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
