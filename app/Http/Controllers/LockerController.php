<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;

class LockerController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    

    public function index()
    {
        // // $lockers = Locker::orderBy('id','DESC');   
        // // $lockers = Locker::orderBy('id','ASC')->pluck('number', 'location', 'id');
        // $lockers= Locker::orderBy('id','DESC')->get();
          
        // $data = ['data'=>$lockers];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $locker = Locker::create($request->all());
        return $this->showOne($locker, 201);
    }

    public function show(Locker $locker)
    {
        $data = ['data'=>$locker];
        return $this->showOne($data);
    }

    public function update(Request $request, Locker $locker)
    {
        $locker->fill($request->all())->save();
        return $this->showOne($locker);
    }

    public function destroy(Locker $locker)
    {
        $locker->delete($locker);
        return $this->showOne($locker);
    }

}
