<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;


class PermissionController extends ApiController{
    
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }


    public function index()
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Permisos"]
        ];

        $permissions = Permission::all();
        
          
        $data = ['data'=>$permissions, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
        
    }

    public function store(Request $request)
    {
        $permission = Permission::create($request->all());
        return $this->showOne($permission, 201);

    }

    public function show(Permission $permission)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Permiso"]
        ];

        $data = ['data'=>$permission, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);

    }

    public function update(Request $request, Permission $permission)
    {
        $permission->fill($request->all())->save();
        return $this->showOne($permission);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete($permission);
        return $this->showOne($permission);
    }

    // public function index(){
    //     $permissions = Permission::orderBy('id','DESC')->paginate(20);
    //     return view('admin.permissions.index', ['permissions' => $permissions]); 
    // }

    // public function create(){
    //     return view('admin.permissions.new');  
    // }

    // public function show($id)
    // {
    //       $permission = Permission::findOrFail($id);
    //       return view('admin.permissions.profile', ['permission' => $permission]);
    // }

    // public function edit($id)
    // {
    //     $permission = Permission::find($id);
    //     return view('admin.permissions.edit')->with('permission', $permission);
    // }

    // public function update(Request $request, $id) 
    // {
        
    //    $permission = Permission::find($id);
    //    $permission->fill($request->all());
    //    $permission->save();
    //    //Flash::success("Se ha actualizado ".$permission->name." de forma exitosa!");

    //    return redirect()->route('permissions.index');

    // }

    // public function store(Request $request)
    // {
    //     $permission = new Permission($request->all());// formatea los datos de la variable $request con all()
    //      //dd($user);
    //     $permission->save();
    //     // //Flash::success("Se ha guardado ".$permissions->name." de forma exitosa!");
    //     return redirect()->route('permissions.index')->with('key', 'You have done successfully');
    // }

    // public function destroy($id)
    // {
    //     $permission = Permission::findorfail($id);
    //     $permission->delete();
    //     //Flash::error('El usuario'. $permission->name.'ha sido eliminado exitosamente!');
    //     return redirect()->route('permissions.index');
    // }


  
}
