<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthenticationController extends Controller
{
    // Login
    public function login(){
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];

        return view('/pages/login', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    // Forgot Password
    public function forgot_password(){
      $pageConfigs = [
          'bodyClass' => "bg-full-screen-image",
          'blankPage' => true
      ];

      return view('/pages/auth-forgot-password', [
          'pageConfigs' => $pageConfigs
      ]);
    }

    // Reset Password
    public function reset_password(){
      $pageConfigs = [
          'bodyClass' => "bg-full-screen-image",
          'blankPage' => true
      ];

      return view('/pages/auth-reset-password', [
          'pageConfigs' => $pageConfigs
      ]);
    }

    // Lock Screen
    public function lock_screen(){
      $pageConfigs = [
          'bodyClass' => "bg-full-screen-image",
          'blankPage' => true
      ];

      return view('/pages/auth-lock-screen', [
          'pageConfigs' => $pageConfigs
      ]);
    }


    public function login_validate(Request $request){    

      // Validate email, password and status = true
      if (Auth::attempt([ 'email' => $request->email, 'password' => $request->password, 'status' => 1 ])) {
        
        // $user = Auth::user(); 
        // $success['token'] =  $user->createToken('gps_app')-> accessToken; 
        
        if (Auth::check()){
          // If the user is logged return response with success..
            return response()->json([
              'action' => 'Iniciar Sesión', 
              'response' => 'Sesión Iniciada Correctamente!',
              'session' => $request->session()->all()
            ], 200);                      
        }

      } else {
        // Return response json with errors
        return response()->json(['errors' => ['login' => 'Los datos son incorrectos']], 422);
      }

    }

    
}
