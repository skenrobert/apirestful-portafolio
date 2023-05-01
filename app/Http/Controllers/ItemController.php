<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Image;
use Illuminate\Http\Request;

class ItemController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
       //listar por el imventario
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Articulos"]
        ];

        $items= Item::orderBy('id','DESC')->get();

        $data = ['data'=>$items, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $item = Item::create($request->all());

        if($request->has('company_id')){
            $item->company_id = $request->company_id;
        }
        
        $item->save();
        $item->taxes()->syncwithoutdetaching($request->tax_id);
        $item->taxes;

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = 'item'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\item';
            $file->move($path, $name);
  
          }

          $image = new Image();
          $image->name = $name;
          $image->save();

          $image->room()->attach($item->id);

        $data = ['data'=>$item, 'image'=> $image];
        return $this->showOne($data);

    }

    public function show(Item $item)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Articulo"]
        ];

        $item->images;
        $item->taxes;

        $data = ['data'=>$item, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Item $item)
    {

        if($item->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }


       $item->fill($request->all())->save();

        $item->taxes()->syncwithoutdetaching($request->tax_id);

        $data = ['data'=>$item];
        return $this->showOne($item);
    }

    public function destroy(Item $item)
    {
        // $item->delete($item);
        // return $this->showOne($item);


        // if(!$company->item()->find($request->tax_id))
        // {
        //     return $this->errorResponse("El Articulo especificado no esta Asociado a esa empresa",404);
        // }

        // $item->taxes()->detach($request->tax_id);
        // $item->taxes;
        // return $this->showAll($item);
    }

    public function updateImage(Request $request, Item $item)//Request $request
    {

        $image = Image::find($request->image_id);

        if ($request->file('image')) {

            $image_path = public_path().'/images/img_app/item/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            // foreach ($item->images as $image) {
            //     $image->item()->detach($item->id);
    
            // }

            $file = $request->file('image');
            $name = 'item'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\item';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->item()->sync($item->id);

          }

        $item->images;
        
        $data = ['data'=>$item];
        return $this->showOne($data);
    }
}
