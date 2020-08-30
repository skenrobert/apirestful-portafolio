<?php

namespace App\Http\Controllers;

use App\Models\AudistsShift;
use Illuminate\Http\Request;

class AudistsShiftController extends ApiController
{
 
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de "]
        // ];

        // $audistsshifts = AudistsShift::orderBy('id','DESC')->get();
        
        // $audistsshifts->each(function($audistsshifts){//1 a 1

        //     $audistsshifts->event;
        //     $audistsshifts->production_details_connec;

        // });


        // $data = ['data'=>$audistsshifts, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $audistsshift = AudistsShift::create($request->all());
        return $this->showOne($audistsshift, 201);
    }

    public function show(AudistsShift $audistsshift)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Auditoria de Room"]
        ];

        $audistsshift->event;
        $audistsshift->production_details_connec;
        $audistsshift->monitorreceives;
        $audistsshift->monitordelivery;

        $data = ['data'=>$audistsshift, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, AudistsShift $audistsshift)
    {
        $audistsshift->fill($request->all())->save();
        return $this->showOne($audistsshift);
    }

    public function destroy(AudistsShift $audistsshift)
    {
        $audistsshift->delete($audistsshift);
        return $this->showOne($audistsshift);
    }
}
