<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        // return response()->json(['error'=> $message, 'code'=> $code], $code);
        return response()->json( ['error'=>['status'=> 'error','message'=> $message, 'code'=> $code]], $code);

    }

    // protected function showAll(Collection $collection, $code = 200)
    protected function showAll($collection, $code = 200)
    {
        // return $this->successResponse(['data'=> $collection], $code);
        return $this->successResponse($collection, $code);
    }

    // protected function showOne(Model $instance, $code = 200)
    protected function showOne($instance, $code = 200)
    {
        return $this->successResponse($instance, $code);
    }

    protected function log($ip, $from, $operation, $description, $os)
    {

        $context = [
                'operation' => $operation,
                'from' => $from,
                'description' => $description,
                'os' => $os,
                'visitor' => $ip,
                'device' => $this->returnMacAddress()
                ];

                $log = new Logger($from);
                $log->pushHandler(new StreamHandler(public_path().'/storage/monolog/binnacle.log', Logger::DEBUG));
                $log->Alert("Nuevo Registro de la Bitacora con las siguiente especificaciones.: ",  $context);
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