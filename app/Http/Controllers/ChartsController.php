<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartsController extends Controller
{

        //
    public function apexEarnModels(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexEarnModels', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }
        
    //
    public function apexEarnStudies(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexEarnStudies', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    public function apexProductionModels(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexProductionModels', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    public function apexSubstudies(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexSubstudies', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    public function apexStudies(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexStudies', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    public function apexComissionStudies(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexComissionStudies', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    public function apexComissionModel(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexComissionModel', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    public function apexComissionMonitor(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexComissionMonitor', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    public function apexEvent(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexEvent', [
            'breadcrumbs' => $breadcrumbs
        ]);
      }


    public function apexMonitor(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
      ];
      return view('/pages/chart-apexMonitor', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    
    public function apexTRM(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apexTRM', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

    public function apex(){
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
        ];
        return view('/pages/chart-apex', [
            'breadcrumbs' => $breadcrumbs
        ]);
        }

        public function apex2(){
            $breadcrumbs = [
                ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Apex"]
            ];
            return view('/pages/chart-apex2', [
                'breadcrumbs' => $breadcrumbs
            ]);
            }

    // Chartjs Charts
    public function chartjs(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Chartjs"]
      ];
      return view('/pages/chart-chartjs', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    // Echarts Charts
    public function echarts(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Charts & Maps"], ['name'=>"Echarts"]
      ];
      return view('/pages/chart-echarts', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    // Google Maps
    public function maps_google(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Maps"], ['name'=>"Google Maps"]
      ];
      return view('/pages/maps-google', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }
}
