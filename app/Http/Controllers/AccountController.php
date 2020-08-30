<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Site;
use App\Models\Employee;
use Illuminate\Http\Request;

class AccountController extends ApiController
{
    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth');
        // parent::__construct();
        // $this->middleware('transform.input:'. UserTransformer::class)->only(['store', 'update']);
    }
    
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Cuentas"]
        // ];
        
        // $accounts= Account::orderBy('id','DESC')->get();

        // // $accounts = Account::has('site')->has('provider')->get();
       
        //   $accounts->each(function($accounts){//1 a m
        //     $accounts->provider->person;
        //     $accounts->site;
        //  });

        // $data = ['data'=>$accounts, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $account = Account::create($request->all());
        return $this->showOne($account, 201);
    }

   
    public function show(Account $account) 
    {
        $account->site;
        $account->company;
        $account->provider->person;
        //$account->employee->person;
        $data = ['data'=>$account];
        return $this->showOne($data);
    }


    public function update(Request $request, Account $account)
    {
        $account->fill($request->all())->save();
        return $this->showOne($account);
    }

    public function destroy(Account $account)
    {
        $account->delete($account);
        return $this->showOne($account);
    }


}
