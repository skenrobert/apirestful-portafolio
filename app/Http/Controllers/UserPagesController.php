<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    // User List Page
    public function user_list(){
      $breadcrumbs = [
          ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Lista de Usuarios"]
      ];
      return view('/pages/app-user-list', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    // User View Page
    public function user_view(){
      $breadcrumbs = [
          ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Ver Usuario"]
      ];
      return view('/pages/app-user-view', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    // User Edit Page
    public function user_edit(){
      $breadcrumbs = [
          ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Editar Usuario"]
      ];
      return view('/pages/app-user-edit', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    public function user_new(){
      $breadcrumbs = [
          ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Editar Usuario"]
      ];
      return view('/pages/app-user-new', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

}
