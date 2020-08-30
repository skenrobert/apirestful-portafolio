<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends ApiController
{
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Record"]
        // ];

        // // $records = Record::orderBy('id','DESC');   
        // // $records = Record::orderBy('id','ASC')->pluck('number', 'location', 'id');
        // $records= Record::orderBy('id','DESC')->get();
          
        // $data = ['data'=>$records, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }

    public function store(Request $request)
    {
        $record = Record::create($request->all());
        return $this->showOne($record, 201);
    }

    public function show(Record $record)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Record"]
        ];

        $data = ['data'=>$record, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Record $record)
    {
        $record->fill($request->all())->save();
        return $this->showOne($record);
    }

    public function destroy(Record $record)
    {
        $record->delete($record);
        return $this->showOne($record);
    }
}
