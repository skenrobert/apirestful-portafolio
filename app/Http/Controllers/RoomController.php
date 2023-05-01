<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\RoomsMail;
use Illuminate\Support\Facades\Mail;

class RoomController extends ApiController
{

    public function __construct()//TODO: se deshabilita para probar el json
    {
        // $this->middleware('auth.basic',['only'=>['show']]);
        $this->middleware('auth');
        // $this->middleware('MonologMiddleware:'.\Auth::user());
        // parent::__construct();
        // $this->middleware('transform.input:'. UserTransformer::class)->only(['store', 'update']);
    }
   
    public function index()
    {
        // $rooms= Room::orderBy('id','DESC')->get();
        // $data = ['data'=>$rooms];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
          $room = Room::create($request->all());

          $this->log($request->ip() , "Room", "Ver", "el usuario Nº". $request->user()->id . " de email " . $request->user()->id . " realizo esta acción en el ". "room" ." de id ".$room->id , php_uname($_SERVER['REMOTE_ADDR']) );
       
          $data = ['data'=>$room];
          return $this->showOne($data);
    }

    public function show( Room $room)
    {
      
         $this->log($request->ip() , "Room", "Ver", "el usuario Nº". $request->user()->id . " de email " . $request->user()->id . " realizo esta acción en el ". "room" ." de id ".$room->id , php_uname($_SERVER['REMOTE_ADDR']) );
  
        $data = ['data'=>$room];
        return $this->showOne($data);
    }

    public function update(Request $request, Room $room)
    {

        // if($request->has('login_id')){
        //     $user = User::find($request->login_id);
        //      $this->log($request->ip() , "Room", "Actualizar", "el usuario Nº ". $user->id . " de nombre " . $user->person->name . " realizo esta acción en el ". "room" ." de id ".$room->id , php_uname($_SERVER['REMOTE_ADDR']) );
        // }

          $room->fill($request->all())->save();

         $this->log($request->ip() , "Room", "Ver", "el usuario Nº". $request->user()->id . " de email " . $request->user()->id . " realizo esta acción en el ". "room" ." de id ".$room->id , php_uname($_SERVER['REMOTE_ADDR']) );

          $data = ['data'=>$room];
          return $this->showOne($data);
    }

    public function destroy(Room $room)
    {
        // if($request->has('login_id')){
        //     $user = User::find($request->login_id);
        //      $this->log($request->ip() , "Room", "Eliminar", "el usuario Nº ". $user->id . " de nombre " . $user->person->name . " realizo esta acción en el ". "room" ." de id ".$room->id , php_uname($_SERVER['REMOTE_ADDR']) );
        // }

        $room->delete($room);

        $this->log($request->ip() , "Room", "Ver", "el usuario Nº". $request->user()->id . " de email " . $request->user()->id . " realizo esta acción en el ". "room" ." de id ".$room->id , php_uname($_SERVER['REMOTE_ADDR']) );
        return $this->showOne($room);
    }

    
}
