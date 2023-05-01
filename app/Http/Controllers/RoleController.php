<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;


class RoleController extends ApiController{
    
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }

    public function index()
    {
        $roles = Role::all();     
        $data = ['data'=>$roles];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        // $role = Role::create($request->all());
        // return $this->showOne($role, 201);
    }

    public function show(Role $role)
    {
        $role = Role::findOrFail($id);
        $data = ['data'=>$role];
        return $this->showOne($data);
    }

    public function update(Request $request, Role $role)
    {
        $role->fill($request->all())->save();
        return $this->showOne($role);
    }

    public function destroy(Role $role)
    {
        // $role->delete($role);
        // return $this->showOne($role);
    }

    // public function rolesAsg($id){
    //         // $user->fill($request->all());
    //         // $user->notify(new NotificationUser());
    //         // $user->save();
    //         // $user->roles()->sync($request->type);
    
    //         $role = Role::find($id);
    //         $permissions = Permission::orderBy('id','ASC')->pluck('name', 'id');
    
    //             // dd($permissions[1]);
               
    
    //         //Flash::warning('El usuario '. $user->type.' ha sido modificado de forma exitosa!');
    //         return view('admin.roles.rolesAsg', ['role' => $role, 'permissions' => $permissions]);
    
    //     }

    // public function create(){
    //     return view('admin.roles.new');  
    // }

    // public function show($id)
    // {
    //       $role = Role::findOrFail($id);
    //       return view('admin.roles.profile', ['role' => $role]);
    // }

    // public function edit($id)
    // {
    //     $role = Role::find($id);
    //     return view('admin.roles.edit')->with('role', $role);
    // }

    // public function update(Request $request, $id) 
    // {
    //    $role = Role::find($id);
    //    $role->fill($request->all());
    //    $role->save();
    //    //Flash::success("Se ha actualizado ".$role->name." de forma exitosa!");
    //    return redirect()->route('roles.index');
    // }

    // public function store(Request $request)
    // {
    //     $role = new Role($request->all());// formatea los datos de la variable $request con all()
    //      //dd($user);
    //     $role->save();
    //     // //Flash::success("Se ha guardado ".$roles->name." de forma exitosa!");
    //     return redirect()->route('roles.index')->with('key', 'You have done successfully');
    // }

    // public function destroy($id)
    // {
    //     $role = Role::findorfail($id);
    //     $role->delete();
    //     //Flash::error('El usuario'. $role->name.'ha sido eliminado exitosamente!');
    //     return redirect()->route('roles.index');
    // }

    // public function rolesAsg($id){
    //     // $user->fill($request->all());
    //     // $user->notify(new NotificationUser());
    //     // $user->save();
    //     // $user->roles()->sync($request->type);

    //     $role = Role::find($id);
    //     $permissions = Permission::orderBy('id','ASC')->pluck('name', 'id');

    //         // dd($permissions[1]);
           

    //     //Flash::warning('El usuario '. $user->type.' ha sido modificado de forma exitosa!');
    //     return view('admin.roles.rolesAsg', ['role' => $role, 'permissions' => $permissions]);

    // }

  
}
