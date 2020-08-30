<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends ApiController
{
  
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Clientes"]
        ];
        $clients = Client::all();

        $clients->each(function($clients){
            $clients->person;
            // $clients->state;
          });

        $data = ['data'=>$providers, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $client = Client::create($request->all());
        return $this->showOne($client, 201);
    }


    public function show(Client $client)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Cliente"]
        ];

        $client->person;

        $data = ['data'=>$client, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

  
    public function update(Request $request, Client $client)
    {
        $client->fill($request->all())->save();
        return $this->showOne($client);
    }

    public function destroy(Client $client)
    {
        $client->delete($client);
        return $this->showOne($client);
    }
}
