<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends ApiController
{
   
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Tipos de Eventos"]
        // ];

        // $task = Task::all();
          
        // $data = ['data'=>$task, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

  
    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return $this->showOne($task, 201);

    }

   
    public function show(Task $task)
    {
        $data = ['data'=>$task];
        return $this->showOne($data);
    }

   
    public function update(Request $request, Task $task)
    {
        $task->fill($request->all())->save();
        return $this->showOne($task);
    }

   
    public function destroy(Task $task)
    {
        $task->delete($task);
        return $this->showOne($task);
    }
}
