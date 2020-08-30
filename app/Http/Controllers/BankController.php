<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends ApiController
{
   
    public function index()
    {
       
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de banco"]
        ];

        $banks = Bank::orderBy('id','DESC')->get();

        $data = ['data'=>$banks, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $bank = Bank::create($request->all());
        return $this->showOne($bank, 201);
        
    }

    public function show(Bank $bank)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver banco"]
        ];

        $data = ['data'=>$bank, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Bank $bank)
    {
        $bank->fill($request->all())->save();
        return $this->showOne($bank);
    }

    public function destroy(Bank $bank)
    {
        $bank->delete($bank);
        return $this->showOne($bank);
    }

    // Return banks View
 
    public function bank_list(Bank $bank)
    {
        $breadcrumbs = [
            ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Todos los banks"]
        ];

        return view('/pages/app-bank-list', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
