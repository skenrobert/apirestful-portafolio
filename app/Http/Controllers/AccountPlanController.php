<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountPlan;

class AccountPlanController extends ApiController
{

    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth:api');
        // parent::__construct();
        // $this->middleware('transform.input:'. UserTransformer::class)->only(['store', 'update']);
    }

    public function index()
    {
        $accountplans= AccountPlan::orderBy('id','DESC')->get();          
        $data = ['data'=>$accountplans];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $accountplan = AccountPlan::create($request->all());
        return $this->showOne($accountplan, 201);
    }

    public function show(AccountPlan $accountplan)
    {
        $data = ['data'=>$accountplan];
        return $this->showOne($data);
    }

    public function update(Request $request, AccountPlan $accountplan)
    {
        $accountplan->fill($request->all())->save();
        return $this->showOne($accountplan);
    }

    public function destroy(AccountPlan $accountplan)
    {
        $accountplan->delete($accountplan);
        return $this->showOne($accountplan);
    }
}
