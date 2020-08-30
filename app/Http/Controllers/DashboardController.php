<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard - GPS/APP
    public function dashboard(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/dashboard', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    // Dashboard Model - GPS/APP
    public function dashboard_model(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/dashboard-model', [
            'pageConfigs' => $pageConfigs
        ]);
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
}

