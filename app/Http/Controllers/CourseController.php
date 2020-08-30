<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends ApiController
{
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Course"]
        ];

        // $courses = Course::orderBy('id','DESC');   
        // $courses = Course::orderBy('id','ASC')->pluck('number', 'location', 'id');
        $courses= Course::orderBy('id','DESC')->get();
          
        $data = ['data'=>$courses, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);

    }

    public function store(Request $request)
    {
        $course = Course::create($request->all());
        return $this->showOne($course, 201);
    }

    public function show(Course $course)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Course"]
        ];

        $data = ['data'=>$course, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Course $course)
    {
        $course->fill($request->all())->save();
        return $this->showOne($course);
    }

    public function destroy(Course $course)
    {
        $course->delete($course);
        return $this->showOne($course);
    }
}
