<?php

namespace App\Http\Controllers;

use App\Models\AuditShift;
use Illuminate\Http\Request;

class AuditShiftController extends ApiController
{
 
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');
    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de "]
        // ];

        // $auditshifts = AuditShift::orderBy('id','DESC')->get();
        
        // $auditshifts->each(function($auditshifts){//1 a 1

        //     $auditshifts->event;
        //     $auditshifts->production_details_connec;

        // });


        // $data = ['data'=>$auditshifts, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = 'auditshift_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\auditshift';
            $file->move($path, $name);
  
          }

          $auditshift = AuditShift::create($request->all());

          $image = new Image();
          $image->name = $name;
          $image->save();

          $image->auditshift()->attach($auditshift->id);

          $data = ['data'=>$auditshift];
          return $this->showOne($data);
    }

    public function show(AuditShift $auditshift)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Auditoria de Room"]
        ];

        $auditshift->event;
        $auditshift->production_details_connec;
        $auditshift->monitorreceives;
        $auditshift->monitordelivery;

        $data = ['data'=>$auditshift, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, AuditShift $auditshift)
    {

        $auditshift->fill($request->all())->save();
        $data = ['data'=>$auditshift];
        return $this->showOne($data);
    }

    public function destroy(AuditShift $auditshift)
    {
        $auditshift->delete($auditshift);
        return $this->showOne($auditshift);
    }

    public function updateImage(Request $request, AuditShift $auditshift)//Request $request
    {

        $image = Image::find($request->image_id);

        if ($request->file('image')) {

            // foreach ($auditshift->images as $image) {
            //     $image->auditshift()->detach($auditshift->id);
            // }

            $image_path = public_path().'/images/img_app/auditshift/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            $file = $request->file('image');
            $name = 'auditshift'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\auditshift';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->auditshift()->sync($auditshift->id);

          }

        $auditshift->images;
        
        $data = ['data'=>$auditshift];
        return $this->showOne($data);
    }
}
