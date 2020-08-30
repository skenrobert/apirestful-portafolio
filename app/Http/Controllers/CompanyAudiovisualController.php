<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyAudiovisualController extends ApiController
{
    public function index(Company $company)
    {
        $audiovisuals = $company->audiovisuals()
        ->orderBy('id','DESC')
        ->get()
        ->unique()
        ->values();


        // $accounts->each(function($accounts){//1 a m
        //     $accounts->provider->person;
        //     $accounts->site;
        //  });

        $data = ['data'=>$audiovisuals];
        return $this->showAll($data);
    }
}
