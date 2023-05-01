<?php

namespace App\Http\Controllers;

use App\Models\AccountRequest;
use App\Models\Image;
use App\Models\Account;

use Illuminate\Http\Request;

class AccountRequestController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');
    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de solicitud de cuentas"]
        // ];
     
        // $accountrequests = AccountRequest::orderBy('id','DESC')->get();

        // $data = ['data'=>$accountrequests, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
          
    }

    public function store(Request $request)
    {
        // dd($request->user_create_id);
        $sites = array(1,2,3);
        // dd(json_encode($sites));

        $accountrequest = AccountRequest::create($request->all());
        $accountrequest->sites = json_encode($sites);
        $accountrequest->save();
        $k = 4;

        if($request->couples == 1){
            $k = 8;
        }

        for ($i = 1; $i <= $k; $i++) {

                if ($request->file('image'.$i)) {
                    $file = $request->file('image'.$i);
                    $name = 'accountrequest_'.$i.time() . '.' . $file->getClientOriginalExtension();
                    $path = public_path() . '\images\img_app\accountrequest';// la orientacion de los la son segun el sistema operativo donde este el sistema
                    $file->move($path, $name);

                    $image = new Image();
                    $image->name = $name;
                    $image->save();
                    $image->accountrequest()->attach($accountrequest->id);//se debe cambiar el metodo respectivamente con el modelo image y su respectivo metodo
        
                }

        }

            if (!empty($sites)) {

                for($j = 0; $j < count($sites); $j++){

                    $account = new Account();
                    $account->nickname = $request->nickname;
                    $account->site_id = $sites[$j];
                    $account->account_request_id = $accountrequest->id;
                    $account->user_id = $request->user_id;
                    $account->company_id = $request->company_id;
                    $account->save();

                }
        }

        $data = ['data'=>$accountrequest, 'image'=> $image];
        return $this->showOne($data, 201);

    }

    public function show(AccountRequest $accountrequest)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Solicitud de Cuentas"]
        ];

        $accountrequest->company;
        $accountrequest->account;
        $accountrequest->user_request;
        $accountrequest->accountrequest;
        $accountrequest->images;

        $data = ['data'=>$accountrequest, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, AccountRequest $accountrequest) // falta el id de la foto
    {
        // deba permitir editar las imagenes con una nueva por imagen a remplazar
        $sites = array(1,2,3);//debe generar una nueva notificacion
        $accountrequest->fill($request->all());
        $accountrequest->sites = json_encode($sites);// debe borrarse todo las solicitudes con el id accountrequest y volverlas a crear
        $accountrequest->save();

        // $accountrequest->images()->sync($request->image_id);//se debe cambiar el metodo respectivamente con el modelo image y su respectivo metodo
        //TODO: ciclo repiticivo si sirce la funcion
        return $this->showOne($accountrequest);
    }

    public function destroy(AccountRequest $accountrequest)
    {
        $accountrequest->delete($accountrequest);
        return $this->showOne($accountrequest);
    }
}
