<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends ApiController
{
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Training"]
        // ];

        // // $trainings = Training::orderBy('id','DESC');   
        // // $trainings = Training::orderBy('id','ASC')->pluck('number', 'location', 'id');
        // $trainings= Training::orderBy('id','DESC')->get();
          
        // $data = ['data'=>$trainings, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }

    public function store(Request $request)
    {
        $training = Training::create($request->all());
        return $this->showOne($training, 201);
    }

    public function show(Training $training)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Training"]
        ];

        $data = ['data'=>$training, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Training $training)
    {
        $training->fill($request->all())->save();
        return $this->showOne($training);
    }

    public function destroy(Training $training)
    {
        $training->delete($training);
        return $this->showOne($training);
    }
}
