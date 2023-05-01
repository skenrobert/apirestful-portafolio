<?php

namespace App\Http\Middleware;

use App\Models\Room;
use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class RedirectIfAuthenticated
{

    public function handle($request, Closure $next, $guard = null)
    {
        

        if (Auth::guard($guard)->check()) {
            // return redirect('/');
            $action = app('request')->route()->getAction();
            $controller = class_basename($action['controller']);
            $controller = snake_case($controller);
            list($controller, $action) = explode('_', $controller);
            // dd($controller);
            list($name,$action) = explode('@', $action);
    
            switch ($action) {
                case 'index':
                    $action = 'Index';
                    break;
                case 'show':
                    $action = 'Ver';
                    break;
                case 'store':
                    $action = 'Crear';
                    break;
                case 'update':
                    $action = 'Update';
                    break;
                case 'destroy':
                    $action = 'Eliminar';
                    break;
                default:
                $action = $action;
                break;
    
            }
    
            //  dd(\Auth::user());
    
    
        //   //  if($request->has('login_id') and $request->has('action_id') ){
        //         $user = User::find($request->login_id);
    
        //         $description = "el usuario Nº ". $user->id . " de nombre " . $user->person->name . " realizo esta acción en el ". $action ." de id ".$request->action_id;
    
        //         $context = [
        //              'user_id' => \Auth::user()->id,
        //              //$request->user()
        //             //auth()->guard('api')->user()
        //           //  auth('api')->user(),
        //             'operation' => $action,
        //             'from' => $controller,
        //             'description' => $description,
        //             'os' => php_uname($_SERVER['REMOTE_ADDR']),
        //             'visitor' => $request->ip(),
        //             'device' => $this->returnMacAddress()
        //             ];
    
        //             $log = new Logger($controller);
        //             $log->pushHandler(new StreamHandler(public_path().'/storage/monolog/binnacle.log', Logger::DEBUG));
        //             $log->Alert("Nuevo Registro de la Bitacora con las siguiente especificaciones.: ",  $context);
    
        //         }elseif($request->has('login_id')){
    
                    // $user = User::find($request->login_id);
    
                    $description = "el usuario Nº ". $request->user()->id . " de nombre " . $request->user()->email . " realizo esta acción en el ". 'test';
        
                    $context = [
                        // 'user_id' => \Auth::user()->id,
                        'operation' => 'test',
                        'from' => 'test',
                        'description' => $description,
                        'os' => php_uname($_SERVER['REMOTE_ADDR']),
                        'visitor' => $request->ip(),
                        'device' => $this->returnMacAddress()
                        ];
        
                        $log = new Logger($controller);
                        $log->pushHandler(new StreamHandler(public_path().'/storage/monolog/binnacle.log', Logger::DEBUG));
                        $log->Alert("Nuevo Registro de la Bitacora con las siguiente especificaciones.: ",  $context);
    
                // }
        }

        return $next($request);
    }

    function returnMacAddress() {
        $location = `which arp`;
       $arpTable = `arp -a`;
       $arpSplitted = explode("\\n",$arpTable);
       $remoteIp = getenv('REMOTE_ADDR');
       foreach ($arpSplitted as $value) {
          $valueSplitted = explode(" ",$value);
          foreach ($valueSplitted as $spLine) {
           if (preg_match("/$remoteIp/",$spLine)) {
                $ipFound = true;
          }
        if (isset($ipFound)) {
           reset($valueSplitted);
           foreach ($valueSplitted as $spLine) {
                 if (preg_match("/[0-9a-f][0-9a-f][:-]".
                     "[0-9a-f][0-9a-f][:-]".
                     "[0-9a-f][0-9a-f][:-]".
                    "[0-9a-f][0-9a-f][:-]".
                    "[0-9a-f][0-9a-f][:-]".
                  "[0-9a-f][0-9a-f]/i",$spLine)) {
                     return $spLine;
                  }
              }
         }
        $ipFound = false;
       }
       }
      return false;
      }
}
