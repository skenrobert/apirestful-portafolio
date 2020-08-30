<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends ApiController
{
   
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de tipos de trabajos"]
        ];
        
        $jobtypes = JobType::orderBy('id','DESC')->get();

        $data = ['data'=>$jobtypes, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        // $jobtype = JobType::create($request->all());
        // return $this->showOne($jobtype, 201);
    }

    public function show(JobType $jobtype)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver tipo de trabajo"]
        ];

        $jobtype->jobfunctions;

        $data = ['data'=>$jobtype, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, JobType $jobtype)
    {
        $jobtype->fill($request->all())->save();
        return $this->showOne($jobtype);
    }

    public function destroy(JobType $jobtype)
    {
        // $jobtype->delete($jobtype);
        // return $this->showOne($jobtype);
    }
}
