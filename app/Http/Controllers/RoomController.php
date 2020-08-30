<?php

namespace App\Http\Controllers;

use App\Models\Room;
// use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\RoomsMail;
use Illuminate\Support\Facades\Mail;

class RoomController extends ApiController
{

      
    public function __construct()//TODO: se deshabilita para probar el json
    {
        // $this->middleware('auth:api');
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

        // if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $name = 'room_'.time() . '.' . $file->getClientOriginalExtension();
        //     $path = public_path() . '\images\img_app\room';
        //     $file->move($path, $name);
  
        //   }

          $room = Room::create($request->all());

        //   $image = new Image();
        //   $image->name = $name;
        //   $image->save();

        //   $image->room()->attach($room->id);
       
          $data = ['data'=>$room];
          return $this->showOne($data);
    }

    public function show(Room $room)
    {
        // $room->images;

        $data = ['data'=>$room];
        return $this->showOne($data);
    }

    public function update(Request $request, Room $room)
    {

        // if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $name = 'room_'.time() . '.' . $file->getClientOriginalExtension();
        //     $path = public_path() . '\images\img_app\room';
        //     $file->move($path, $name);
  
        //     $image = new Image();
        //     $image->name = $name;
        //     $image->save();
  
        //   //   $image->room()->attach($room->id);
        //   //   $image->room()->syncWithoutDetaching($room->id);
        //   //   $image->room()->detach($room->id);
        //     $image->room()->sync($room->id);
            
        //   }

        // foreach ($room->images as $image) {
        //     $image->room()->detach($room->id);

        // }


          $room->fill($request->all())->save();


          $data = ['data'=>$room];
          return $this->showOne($data);
    }

    public function destroy(Room $room)
    {
        $room->delete($room);
        return $this->showOne($room);
    }

    
}
