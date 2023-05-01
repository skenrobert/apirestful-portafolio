<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesSoporteController extends Controller
{
    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth');
        $this->middleware('roleshinobi:soporte');

    }

    // Return Account View
    public function account_list()
    {
        return view('/pages/app-account-list');
    }
    // Return Account View
    public function account_request_list()
    {
        return view('/pages/app-account-request');
    }
    // Return Boutique View
    public function boutique_list()
    {
        return view('/pages/app-boutique-list');
    }

    // Return Categories View
    public function category_list()
    {
        return view('/pages/app-category-list');
    }

    // Return Contacts View
    public function contact_list()
    {
        return view('/pages/app-contact-list');
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

    // Return Models View
    public function model_list()
    {
        return view('/pages/app-model-list');
    }

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

        
    // Method for view of notifications
    public function notifications()
    {
        return view('/pages/app-notifications');
    }
    

    // Method for view of user events
    public function myevents()
    {
        return view('/pages/app-my-events');
    }
    
    // Method for view of users
    public function user_list(){
        
        return view('/pages/app-user-list');
    }

    // Method for view of models
    public function provider_list()
    {
        return view('/pages/app-provider-list');
    }
}
