<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Account;
use App\Models\Image;
use App\Models\User;

use Illuminate\Http\Request;


class ProviderController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {

        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Provedores"]
        // ];
     
        // $providers= Provider::orderBy('id','DESC')->get();

        // $providers->each(function($providers){
        //     $providers->person;
        //     $providers->images;

        //   });
        
        // $data = ['data'=>$providers, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }


    public function store(Request $request)
    {
        //  dd($request->file('image'));
        if ($request->file('image')) {
            $file = $request->file('image');
            $name = 'provider_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\provider';// la orientacion de los la son segun el sistema operativo donde este el sistema
            $file->move($path, $name);
  
          }

          $provider = Provider::create($request->all());

          $image = new Image();
          $image->name = $name;
          // TODO: no puedo usar associate porque exite tablas de muchos a muchos por ende los pibotes tendran los id asociativos cambia las vistas tambien
          //$image->providers()->associate($provider);//clave foranea id de la organization para poder guardar la imagen
          $image->save();

          $image->provider()->attach($provider->id);//se debe cambiar el metodo respectivamente con el modelo image y su respectivo metodo

          $data = ['data'=>$provider, 'image'=> $image];


         return $this->showOne($data, 201);
        //  return response()->json($data, 200);


    }

    public function show(Provider $provider)
    {
        $provider->person;
        $provider->images;

        $data = ['data'=>$provider];

        return $this->showOne($data);


    }

    public function update(Request $request, Provider $provider)
    {

        $provider->fill($request->all())->save();

        $data = ['data'=>$provider];
        return $this->showOne($data);
    }


    public function destroy(Provider $provider)
    {
        $provider->delete($provider);
        return $this->showOne($provider);

    }

//**************************************************************relationship method********/
    public function providerGetAllEvent()
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Provedores con Eventos"]
        ];
    
        $providers = Provider::has('event')->get();//1 a n
        // $providers = Provider::all();


        $providers->each(function($providers){
            $providers->person;
            $providers->event;
        });
        

        $data = ['data'=>$providers, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
        

    }

    public function providerGetAllType()
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Provedores con Eventos"]
        ];
     
        $providers = Provider::orderBy('id','DESC')->get();

         $providers->each(function($providers){
            $providers->jobtype;//1 a 1
            $providers->person;//1 a 1
           });

           $data = ['data'=>$providers, 'breadcrumbs'=> $breadcrumbs];
            return $this->showAll($data);
    }


    public function providerGetAllAccounts()
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Provedores con Eventos"]
        ];
     
        $users = User::has('accounts')->get();//1 a n

        $users->each(function($users){
            $users->person;
            $users->accounts;
          });

        //$providers = Account::has('provider')->get();//1 a n TODO:esta consulta muestra la cuenta de las modelos 
        
        $data = ['data'=>$users, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);

    }


    public function providerShowAccount($id)
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Provedores con cuentas"]
        ];
     
       $user = User::findOrFail($id);//1 a n

        $accounts = $user->accounts()
        ->whereHas('site')
        ->orderBy('id','DESC')
        ->with('site')
        ->get()
        ->where('status','=',1)
        ->unique()
        ->values();

        $data = ['data'=>$accounts, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
          
    }

    public function updateImage(Request $request, Provider $provider)//Request $request
    {

        $image = Image::find($request->image_id);

        if ($request->file('image')) {

            // foreach ($provider->images as $image) {
            //     $image->provider()->detach($provider->id);
            // }

            $image_path = public_path().'/images/img_app/provider/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            $file = $request->file('image');
            $name = 'provider'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\provider';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->provider()->sync($provider->id);

          }

        $provider->images;
        
        $data = ['data'=>$provider];
        return $this->showOne($data);
    }

    // public function providerGetAllLocker()
    // {

    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Provedores con Eventos"]
    //     ];
     
    //    // $providers = Provider::has('locker')->get();//1 a n
    //     $providers = Provider::all();

    //     //  $providers->each(function($providers){
    //     //     $providers->locker;
    //     //    });


    //     // $providers->each(function($providers){
    //     //     $providers->person;
    //     //   });
        
          
    //     return response()->json(['data'=>$providers, 'breadcrumbs'=> $breadcrumbs], 200);
          

    // }


    


}
