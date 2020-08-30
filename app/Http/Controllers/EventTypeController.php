<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends ApiController
{
    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth:api');
        // parent::__construct();
        // $this->middleware('transform.input:'. UserTransformer::class)->only(['store', 'update']);
    }
  
    public function index()
    {

        $eventTypes = EventType::orderBy('id','DESC')->get();          
        $data = ['data'=>$eventTypes];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $eventType = EventType::create($request->all());
        return $this->showOne($eventType, 201);
    }

    public function show(EventType $eventType)
    {        
        $data = ['data'=>$eventType];
        return $this->showOne($data);
    }

    public function update(Request $request, EventType $eventType)
    {
        $eventType->fill($request->all())->save();
        return $this->showOne($eventType);
    }

    public function destroy(EventType $eventType)
    {
        // $eventType = EventType::findOrfail($id);
        $eventType->delete($eventType);
        return $this->showOne($eventType);
    }


}
