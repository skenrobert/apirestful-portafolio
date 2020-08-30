<?php

namespace App\Http\Controllers;

use App\Models\JobFunction;
use Illuminate\Http\Request;

class JobFunctionController extends ApiController
{
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Funciones de Cargo"]
        ];
        
        $jobfunctions = JobFunction::orderBy('id','DESC')->get();

        $data = ['data'=>$jobfunctions, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $jobfunction = JobFunction::create($request->all());
        return $this->showOne($jobfunction, 201);
    }

    public function show(JobFunction $jobfunction)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Funcion de Cargo"]
        ];

        $data = ['data'=>$jobfunction, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, JobFunction $jobfunction)
    {
        $jobfunction->fill($request->all())->save();
        return $this->showOne($jobfunction);
    }

    public function destroy(JobFunction $jobfunction)
    {
        $jobfunction->delete($jobfunction);
        return $this->showOne($jobfunction);
    }
}
