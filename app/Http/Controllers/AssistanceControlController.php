<?php

namespace App\Http\Controllers;

use App\Models\AssistanceControl;
use Illuminate\Http\Request;

class AssistanceControlController extends ApiController
{
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de banco"]
        // ];

        // $assistancecontrols = AssistanceControls::orderBy('id','DESC')->get();

        // $data = ['data'=>$assistancecontrols, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        // $assistancecontrol = AssistanceControl::create($request->all());
        // return $this->showOne($assistancecontrol, 201);
        
    }

    public function show(AssistanceControls $assistancecontrol)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver AssistanceControloria"]
        ];

        $data = ['data'=>$assistancecontrol, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, AssistanceControls $assistancecontrol)
    {
        $assistancecontrol->fill($request->all())->save();
        return $this->showOne($assistancecontrol);
    }

    public function destroy(AssistanceControls $assistancecontrol)
    {
        // $assistancecontrol->delete($assistancecontrol);
        // return $this->showOne($assistancecontrol);
    }
}
