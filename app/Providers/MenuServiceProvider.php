<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // // Guest Menu
        // $GuestMenuJson = file_get_contents(base_path('resources/json/guest.json'));
        // $GuestMenuData = json_decode($GuestMenuJson);
        // // Model Menu 
        // $ModelMenuJson = file_get_contents(base_path('resources/json/model.json'));
        // $ModelMenuData = json_decode($ModelMenuJson);
        // // Monitor Menu 
        // $MonitorMenuJson = file_get_contents(base_path('resources/json/monitor.json'));
        // $MonitorMenuData = json_decode($MonitorMenuJson);
        // // Manager Menu 
        // $ManagerMenuJson = file_get_contents(base_path('resources/json/manager.json'));
        // $ManagerMenuData = json_decode($ManagerMenuJson);
        // // Admin Menu 
        // $AdminMenuJson = file_get_contents(base_path('resources/json/admin.json'));
        // $AdminMenuData = json_decode($AdminMenuJson);
        // // Account Menu 
        // $AccountMenuJson = file_get_contents(base_path('resources/json/account.json'));
        // $AccountMenuData = json_decode($AccountMenuJson);
        // // Contab Menu 
        // $ContabMenuJson = file_get_contents(base_path('resources/json/contab.json'));
        // $ContabMenuData = json_decode($ContabMenuJson);
        // // Audiovisual Menu 
        // $AudiovisualMenuJson = file_get_contents(base_path('resources/json/audiovisual.json'));
        // $AudiovisualMenuData = json_decode($AudiovisualMenuJson);
        // // SubStudy Menu
        // $SubStudyMenuJson = file_get_contents(base_path('resources/json/substudy.json'));
        // $SubStudyMenuData = json_decode($SubStudyMenuJson);
        // // Study Menu
        // $StudyMenuJson = file_get_contents(base_path('resources/json/study.json'));
        // $StudyMenuData = json_decode($StudyMenuJson);
       
        // // Share all menuData to all the views
        // \View::share('menuData',[
        //     $GuestMenuData, 
        //     $ModelMenuData, 
        //     $MonitorMenuData, 
        //     $ManagerMenuData, 
        //     $AdminMenuData, 
        //     $AccountMenuData, 
        //     $ContabMenuData, 
        //     $AudiovisualMenuData, 
        //     $SubStudyMenuData,
        //     $StudyMenuData
        // ]);
    }
}
