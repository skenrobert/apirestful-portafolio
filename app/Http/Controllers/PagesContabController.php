<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesContabController extends Controller
{
    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth');
        $this->middleware('roleshinobi:contab');

    }


    // Dashboard - GPS/APP
    public function dashboard(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/dashboard', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    public function notifications()
    {
        return view('/pages/app-notifications');
    }

    // Method for view of models
    public function provider_list()
    {
        return view('/pages/app-provider-list');
    }

    // User Profile Page
    public function user_profile(){
        $breadcrumbs = [
            ['name'=>"Perfil"]
        ];
        return view('/pages/app-profile', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    // Account Settings
    public function user_settings(){
        $breadcrumbs = [
            ['link'=>"profile",'name'=>"Perfil"], ['name'=>"Configuración"]
        ];
        return view('/pages/app-settings', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

}
