<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Image;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\NotificationUser;//este es el notification de usuario
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;

use App\Http\Requests\UserRequest;// php artisan make:request (validaciones)
use App\Transformers\ProductTransformer;


//para shinobi
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserController extends ApiController{

    use Notifiable;
    // use Notification;

    // public function __construct()//TODO: se deshabilita para probar el json
    // {
    //     $this->middleware('auth');
    //     // parent::__construct();
    //     // $this->middleware('transform.input:'. UserTransformer::class)->only(['store', 'update']);

    // }

//TODO: Quitarle el nombre de usuario

    // public function index()
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Lista de Usuarios"]
    //     ];
     
    //     $users= User::orderBy('id','DESC')->get();
    
    //     $users->each(function($users){//1 a 1

    //         foreach ($users->roles as $role) {// m a n
    //             $role->pivot->created_at;
    //         }

    //         $users->person;
    //         $users->company->companytype;

    //     });

    //     $data = ['data'=>$users, 'breadcrumbs'=> $breadcrumbs];
    // //  return response()->json([$users], 200);

    //     return $this->showAll($data);    

    // }

    public function show(User $user)
    {
        $breadcrumbs = [
            ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Ver Usuario"]
        ];

        // // $user = User::findOrFail(2);
        // // $notification = Notification::send($user, new NotificationUser());
        // Notification::send($user, new NotificationUser(1));

        // // $user->notify(new NotificationUser);
        // $user->notify(new NotificationUser());

         // $log = new Log();
    //     // $log->logs($request, "registro", "area", $request->description, $request->ip() , \Auth::user()->id, php_uname($_SERVER['REMOTE_ADDR'] ));
    //     // $notification = NotificationUser::send($user, new NotificationUser($notifiable));

        foreach ($user->roles as $role) {// TODO: Funciona manda el roll o roles
            $role->pivot->created_at;
        }

        // dd($user->loadproduction(1,1));
        // dd($user->totalevents(1));
        // $user->revokeRole(2);
        // $user->syncRoles([2,3,5]);
        // $user->revokeAllRoles();
        // $user->assignRole(1);
        // $user->isRole($user->slug);// alternativa de $user->roles
        // $user->getRoles();// alternativa de $user->roles
        // $user->roles;// tercera opcion

        // return response()->json([$user], 200);

        $user->person;
        $user->company->companytype;
        $user->images;


        $data = ['data'=>$user, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }



    public function store(UserRequest $request)//TODO: listar personas sin usuario metodo a la vista antes D
    {
        // $user = User::create($request->all());
        // return response()->json([$user], 200);
        // dd($request);
        $user = new User($request->all());// formatea los datos de la variable $request con all()
        // $user->person_id = 2;

        $user->password = bcrypt($request->password);// encripta la clave
        // $user->notify(new NotificationUser());

        if($request->has('company_id')){
            $user->company_id = $request->company_id;
        }
        
        $user->save();
        $user->roles()->sync($request->role_id);//sincroniza el roll
        $user->roles;
        $user->person;

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = 'user'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\user';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->user()->attach($user->id);
          }


        //   $data = ['data'=>$user];
        //   return $this->showOne($data);

        return $this->showOne($user, 201);
        // return response()->json([$user], 200);

    }

    public function storeRole(Request $request, $id)//dejar la funcion del modelo es mas optimo
    {

        $user = User::find($id);
        $user->roles()->sync($request->role_id);
        $user->person;
        $user->roles;
        // $user->notify(new NotificationUser());
        return $this->showOne($user, 201);
    }

    public function update(UserRequest $request, User $user)
    {

        
        if($user->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }
 
        // $user->fill($request->all())->save();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);// encripta la clave

        if($request->has('company_id')){
            $user->company_id = $request->company_id;
        }

        $user->save();

        $user->roles()->sync($request->role_id);

        $user->roles;
        $user->person;

        $data = ['data'=>$user];
        return $this->showOne($data);
    }

    public function destroy(User $user)
    {
        $user->delete($user);
        return $this->showOne($user);

    }

    public function updateImage(Request $request, User $user)//Request $request
    {

        $image = Image::find($request->image_id);

        if ($request->file('image')) {

            $image_path = public_path().'/images/img_app/user/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            // foreach ($user->images as $image) {
            //     $image->user()->detach($user->id);
            // }

            $file = $request->file('image');
            $name = 'user'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\user';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->user()->sync($user->id);

          }

        $user->images;
        
        $data = ['data'=>$user];
        return $this->showOne($data);
    }



    // User List Page
    public function user_list(){
        $breadcrumbs = [
            ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Lista de Usuarios"]
        ];
        return view('/pages/app-user-list', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }
  
      // User Profile Page
    public function user_profile(){
        $breadcrumbs = [
            ['name'=>"Perfil"]
        ];
        return view('/pages/app-profile', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // Account Settings
    public function user_settings(){
      $breadcrumbs = [
          ['link'=>"profile",'name'=>"Perfil"], ['name'=>"Configuración"]
      ];
      return view('/pages/app-settings', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    
    public function totalEvents($user_id) {

        $events = Event::orderBy('id','DESC')->whereIn('event_type_id',[1,2,3,4])->where('user_id','=',$user_id)->get();
        return $events;
    }


    //  public function update(Request $request, User $user){
        
        //     $user->fill($request->all());
        //     $user->notify(new NotificationUser());
        //     $user->save();
        //     $user->roles()->sync($request->type);
    
    
        //     //Flash::warning('El usuario '. $user->type.' ha sido modificado de forma exitosa!');
        //     return redirect()->route('users.index');
        // }

    /************************************************************************ */


    // public function index(){
    //     $users = User::orderBy('id','DESC')->paginate(50);
       
    //     // $users->each(function($users){
    //     //     $users->roles;
    //     //   }); 
              

    //      return View('admin.users.index')->with('users', $users);
    // }

    // public function create(){// No se usa en las api
    //     $roles = Role::orderBy('id','ASC')->pluck('name', 'id');
    //     return view('admin.users.new')->with(['roles' => $roles]);  
    // }

    // public function show($id){
    //       $user = User::findOrFail($id);
    //       return view('admin.users.profile', ['user' => $user]);
    // }

    // public function edit($id){//No se usa en las api

    //     $user = User::find($id);
    //     $role = Role::orderBy('id','ASC')->pluck('name', 'id');
       
    //     $user->notify(new NotificationUser());//$operation, $from

    //     // $log = new Log();
    //     // $log->logs($request, "registro", "area", $request->description, $request->ip() , \Auth::user()->id, php_uname($_SERVER['REMOTE_ADDR'] ));
    //     // $notification = NotificationUser::send($user, new NotificationUser($notifiable));
    //     return view('admin.users.edit', ['user' => $user, 'role' => $role]);

    // }

    // public function update(Request $request, User $user){
        
    //     $user->fill($request->all());
    //     $user->notify(new NotificationUser());
    //     $user->save();
    //     $user->roles()->sync($request->type);


    //     //Flash::warning('El usuario '. $user->type.' ha sido modificado de forma exitosa!');
    //     return redirect()->route('users.index');
    // }

    // public function store(Request $request){
    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->type = $request->type;
    //     $user->status = $request->status;
    //     $user->password = bcrypt($request->password);

    //     $user->save();
    //     $user->roles()->sync($request->type);
        
        

    //     //Flash::success("Se ha guardado ".$user->name." de forma exitosa!");
    //     return redirect()->route('users.index')->with('key', 'You have done successfully');
    // }

    // public function destroy($id){
    //     $user = User::findorfail($id);
    //     $user->delete();
    //     //Flash::error('El usuario'. $user->name.'ha sido eliminado exitosamente!');
    //     return redirect()->route('users.index');
    // }


    // // public function rolesAsg($id){
    // //     // $user->fill($request->all());
    // //     // $user->notify(new NotificationUser());
    // //     // $user->save();
    // //     // $user->roles()->sync($request->type);

    // //     $user = User::find($id);
    // //     $permissions = Permission::orderBy('id','ASC')->pluck('name', 'id');

    // //         // dd($permissions[1]);
           

    // //     //Flash::warning('El usuario '. $user->type.' ha sido modificado de forma exitosa!');
    // //     return view('admin.users.rolesAsg', ['user' => $user, 'permissions' => $permissions]);

    // // }

    
    
   
  
}
