<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Boutique;
use Illuminate\Http\Request;

class BoutiqueController extends ApiController
{
    // public function index()
    // {
    //     // $breadcrumbs = [
    //     //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Boutique"]
    //     // ];

    //     // // $boutiques = Boutique::orderBy('id','DESC');   
    //     // // $boutiques = Boutique::orderBy('id','ASC')->pluck('number', 'location', 'id');
    //     // $boutiques= Boutique::orderBy('id','DESC')->get();
          
    //     // $data = ['data'=>$boutiques, 'breadcrumbs'=> $breadcrumbs];
    //     // return $this->showAll($data);

    // }

    public function store(Request $request)
    {

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = 'boutique_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\boutique';
            $file->move($path, $name);
  
          }

          $boutique = Boutique::create($request->all());
          $boutique->status = 1;

          $image = new Image();
          $image->name = $name;
          $image->save();

          $image->boutique()->attach($boutique->id);

          $data = ['data'=>$boutique, 'image'=> $image];

         return $this->showOne($data, 201);

    }

    public function show(Boutique $boutique)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Boutique"]
        ];

        $boutique->images;

        $data = ['data'=>$boutique, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Boutique $boutique)
    {

        $boutique->fill($request->all())->save();
        $boutique->images;
        
        $data = ['data'=>$boutique];
        return $this->showOne($data);
    }

    // public function destroy(Boutique $boutique)
    // {
    //     $boutique->delete($boutique);
    //     return $this->showOne($boutique);
    // }

    public function updateImage(Request $request, Boutique $boutique)//Request $request
    {

        $image = Image::find($request->image_id);

        if ($request->file('image')) {

            // foreach ($boutique->images as $image) {
            //     $image->boutique()->detach($boutique->id);
    
            // }

            $image_path = public_path().'/images/img_app/boutique/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            $file = $request->file('image');
            $name = 'boutique'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\boutique';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->boutique()->sync($boutique->id);

          }

        $boutique->images;
        
        $data = ['data'=>$boutique];
        return $this->showOne($data);
    }
}
