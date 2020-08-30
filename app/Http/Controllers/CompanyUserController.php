<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyUserController extends ApiController
{

    public function index(Company $company)
    {

        $users = $company->user()
        // ->whereHas('user')
        ->with('person')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('employee')
        ->unique()
        ->values();

        $users->each(function($users){//1 a 1

                    foreach ($users->roles as $role) {// m a n
                        $role->pivot->created_at;
                    }
        
                    $users->company->companytype;
        
                });
        $data = ['data'=>$users];
        return $this->showAll($data);

    }


}
