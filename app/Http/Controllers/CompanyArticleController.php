<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyArticleController extends ApiController
{
    public function index(Company $company)
    {
        $article = $company->articles()
        ->orderBy('id','DESC')
        ->get()
        ->unique()
        ->values();


        // $accounts->each(function($accounts){//1 a m
        //     $accounts->provider->person;
        //     $accounts->site;
        //  });

        $data = ['data'=>$article];
        return $this->showAll($data);
    }
}
