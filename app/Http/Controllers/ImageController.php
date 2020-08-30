<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista Imagenes de Provedores de servicios"]
        ];

        // $images = Image::orderBy('id','DESC')->get();
        $images = Image::has('providers')->orderBy('id','DESC')->get();
        //$images = Image::doesntHave('providers')->get();

        // $images->each(function($images){
        // $images->providers;
        // });
  
        $data = ['data'=>$images, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
  
    }

   
}
