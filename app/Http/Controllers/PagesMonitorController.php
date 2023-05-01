<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\EventCreated;

class PagesMonitorController extends Controller
{
    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth');
        $this->middleware('roleshinobi:monitor');
    }


    // Dashboard Monitor - GPS/APP
    public function dashboard_monitor(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/dashboard-monitor', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    // Method for view of notifications
    public function notifications()
    {
        return view('/pages/app-notifications');
    }

    // Return Models View
    public function model_list()
    {
        return view('/pages/app-model-list');
    }

    // Method for view of user events
    public function myevents()
    {
        return view('/pages/app-my-events');
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


    //   // 
    // public function listenBroadcast()
    // {
    //     return view('/pages/listenBroadcast');
    // }

    // public function event()
    // {
    //     event(new EventCreated(\Auth::user()->id, \Auth::user()->totalEvents(\Auth::user()->id)));
    // }

}
