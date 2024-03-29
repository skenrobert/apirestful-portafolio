<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
   
    public function index()
    {
        $sites= Site::orderBy('id','DESC')->get();
        $data = ['data'=>$sites];
        return $this->showAll($data);
    }
 
    public function store(Request $request)
    {
        $site = Site::create($request->all());
        return $this->showOne($site, 201);
    }

    public function show(Site $site)
    {
        $data = ['data'=>$site];
        return $this->showOne($data);
    }

    public function update(Request $request, Site $site)
    {
        $site->fill($request->all())->save();
        return $this->showOne($site);
    }

    public function destroy(Site $site)
    {
        $site->delete($site);
        return $this->showOne($site);
    }


}
