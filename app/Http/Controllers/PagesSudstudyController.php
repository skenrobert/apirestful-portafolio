<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;


class PagesSudstudyController extends Controller
{
    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth');
        $this->middleware('roleshinobi:sub-study');

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


    // Calender App
    public function calenderApp(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/app-calender', [
            'pageConfigs' => $pageConfigs
        ]);
        }


    // Method for view of models
    public function provider_list()
    {
        return view('/pages/app-provider-list');
    }

    // Return Employee View
    public function employee_list(Employee $employee)
    {
        $breadcrumbs = [
            ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Todas los Empleados"]
        ];

        return view('/pages/app-employee-list', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Return Room Index    
    public function room_list()
    {
        return view('/pages/app-room-list');
    }

    // Return Lockers Index
    public function locker_list()
    {
        return view('/pages/app-locker-list');
    }

    // Return Sites Index
    public function site_list()
    {
        return view('/pages/app-site-list');
    }

    // Return Planning View
    public function planning_list()
    {
        return view('/pages/app-planning-list');
    }

    // Return Account View
    public function account_list()
    {
        return view('/pages/app-account-list');
    }

    // // Return Account View
    // public function account_request_list()
    // {
    //     return view('/pages/app-account-request');
    // }

    // Return Event View
    public function event_list()
    {
        return view('/pages/app-event-list');
    }

    // Return Event Type View
    public function event_type_list()
    {
        return view('/pages/app-event-type-list');
    }

    // Method for view of users
    public function user_list(){
        
        return view('/pages/app-user-list');
    }

    // Return Contacts View
    public function contact_list()
    {
        return view('/pages/app-contact-list');
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





    // // Return Boutique View
    // public function boutique_list()
    // {
    //     return view('/pages/app-boutique-list');
    // }

    // // Return Categories View
    // public function category_list()
    // {
    //     return view('/pages/app-category-list');
    // }

    // // Return Models View
    // public function model_list()
    // {
    //     return view('/pages/app-model-list');
    // }


        
    // // Method for view of notifications
    // public function notifications()
    // {
    //     return view('/pages/app-notifications');
    // }
    

    // // Method for view of user events
    // public function myevents()
    // {
    //     return view('/pages/app-my-events');
    // }
    
    
}
