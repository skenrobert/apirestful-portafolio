<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de banco"]
        // ];

        // $audits = Audits::orderBy('id','DESC')->get();

        // $data = ['data'=>$audits, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $audit = Audit::create($request->all());
        return $this->showOne($audit, 201);
        
    }

    public function show(Audits $audit)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Auditoria"]
        ];

        $data = ['data'=>$audit, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Audits $audit)
    {
        $audit->fill($request->all())->save();
        return $this->showOne($audit);
    }

    public function destroy(Audits $audit)
    {
        $audit->delete($audit);
        return $this->showOne($audit);
    }
}
