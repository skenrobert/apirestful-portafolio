<?php

namespace App\Http\Controllers;

use App\Models\Audiovisual;
use App\Models\Image;
use App\Models\Event;
use Illuminate\Http\Request;

class AudiovisualController extends ApiController
{
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de banco"]
        // ];

        // $audiovisuals = Audiovisual::orderBy('id','DESC')->get();

        // $data = ['data'=>$audiovisuals, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)//recibir image1,...,image1 video1 
    {
        $audiovisual = Audiovisual::create($request->all());

        if ($request->file('image')) {

            $file_array = $request->file('image');
            $len = count($file_array);

            for ($i=0; $i < $len; $i++) { 


                  if ($file_array[$i]->getClientOriginalExtension() == 'mp4') {

                      $name = 'audiovisualVideo'.$i.'_'.time() . '.' . $file_array[$i]->getClientOriginalExtension();
                      $path = public_path() . '\images\img_app\audiovisual';
                      $file_array[$i]->move($path, $name);

                      $image = new Image();
                      $image->name = $name;
                      $image->save();
            
                      $image->audiovisual()->attach($audiovisual->id);

                  }else{

                      $name = 'audiovisual'.$i.'_'.time() . '.' . $file_array[$i]->getClientOriginalExtension();
                      $path = public_path() . '\images\img_app\audiovisual';
                      $file_array[$i]->move($path, $name);
            
                      $image = new Image();
                      $image->name = $name;
                      $image->save();
            
                      $image->audiovisual()->attach($audiovisual->id);
                }
            }

          }
          
        $audiovisual->images;

          $data = ['data'=>$audiovisual];

         return $this->showOne($data, 201);

        
    }

    public function show(Audiovisual $audiovisual)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver banco"]
        ];

        $data = ['data'=>$audiovisual, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Audiovisual $audiovisual)
    {
        $audiovisual->fill($request->all())->save();

        if($request->has('assistance') && $request->assistance == 0 ){
            $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
            $event->processed = 1;
            $event->audiovisual_id = $audiovisual->id;
            $event->observation = 'No Asistio a la Seccion de Fotos';
            $event->event_type_id = 3;
            $event->save();
        }

        $audiovisual->images;

        return $this->showOne($audiovisual);
    }

    public function destroy(Audiovisual $audiovisual)
    {
        $audiovisual->delete($audiovisual);
        return $this->showOne($audiovisual);
    }

    public function updateImage(Request $request, Audiovisual $audiovisual)
    {

        $image = Image::find($request->image_id);


        if ($request->file('image')) {

            $image_path = public_path().'/images/img_app/audiovisual/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            $file = $request->file('image');
            $name = 'audiovisual'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\audiovisual';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->audiovisual()->sync($audiovisual->id);

          }elseif($request->file('video')){
            
            $image_path = public_path().'/images/img_app/audiovisual/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            $file = $request->file('video');
            $name = 'audiovisualVideo_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\audiovisual';
            $file->move($path, $name);

            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->audiovisual()->attach($audiovisual->id);

          }

        $audiovisual->images;
        
        $data = ['data'=>$audiovisual];
        return $this->showOne($data);
    }
}
