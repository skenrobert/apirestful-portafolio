<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends ApiController
{
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Subject"]
        ];

        // $subjects = Subject::orderBy('id','DESC');   
        // $subjects = Subject::orderBy('id','ASC')->pluck('number', 'location', 'id');
        $subjects= Subject::orderBy('id','DESC')->get();
          
        $data = ['data'=>$subjects, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);

    }

    public function store(Request $request)
    {
        $subject = Subject::create($request->all());
        return $this->showOne($subject, 201);
    }

    public function show(Subject $subject)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Subject"]
        ];

        $data = ['data'=>$subject, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->fill($request->all())->save();
        return $this->showOne($subject);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete($subject);
        return $this->showOne($subject);
    }
}
