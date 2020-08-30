<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotificationUser;//este es el notification de usuario

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Carbon\Carbon;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRolesAndPermissions, SoftDeletes;
    use Sluggable;

    public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
        return [
            'slug' => [
                'source' => 'email'
            ]
        ];
    }


    protected $dates = ['deleted_at'];

    protected $fillable = [
        'email', 'password', 'status','notification_preference','person_id','company_id','slug'
    ];
   
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', 'status' => 'boolean',
    ];
    /*****************  Accesores  *****************/
    
    public function getNameAttribute($valor)//transforma el valor antes de mandarlo a una vista no afecta la base de datos
    {
        // return ucfirst($valor);
        return ucwords($valor);

    }

    /*****************  Mutadores  *****************/

    public function setNameAttribute($valor)//Mutador para que los nombres se guarden en minusculas en la base de datos
    {
        $this->attributes['name'] = strtolower($valor);

    }


    public function setEmailAttribute($valor)//Mutador para que los nombres se guarden en minusculas en la base de datos
    {
        $this->attributes['Email'] = strtolower($valor);

    }



    /*****************  Relationships  *****************/
    
    public function person(){
        return $this->belongsTo('App\Models\Person');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function monitorshift(){
        return $this->hasMany('App\Models\MonitorShift');
    }

    public function providerplaninng(){
        return $this->hasMany('App\Models\ProviderPlaninng');
    }

    public function productiondetailsconnec()//1 a m
    {
        return $this->hasMany('App\Models\ProductionDetailsConnec');
    }


    public function events()//1 a m
    {
        return $this->hasMany('App\Models\Event');
    }

    public function receiptpayment()//1 a m
    {
        return $this->hasMany('App\Models\ReceiptPayment');
    }
      /*****************  Relationships  shinobi *****************/
    
      public function roles()//m a m
      {
        //   return $this->belongsToMany('Caffeinated\Shinobi\Models\Role')->withTimestamps();
          return $this->belongsToMany('Caffeinated\Shinobi\Models\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
      }
  
      public function permissions()//m a m
      {
          return $this->belongsToMany('Caffeinated\Shinobi\Models\Permissions')->withTimestamps();
      }

      // *****************************************************************

        public function audistsshift()//1 a m
        {
            return $this->hasMany('App\Models\AuditShift');
        }

      /*****************  Revisar abajo funciones  shinobi *****************/

      
    // public function Roles() {

    //     if (!is_null($this->roles)) {
    //         return $this->roles->pluck('slug')->all();
    //     }

    // }


    // public function monitor() {

    //     if (!is_null($this->roles)) {
    //                 return $this->roles->pluck('slug')->all();
    //      }


    // }


    public function isRole($slug) {

        $slug = strtolower($slug);

        foreach($this->roles as $role){
            if($role->slug == $slug){
                return true;
            }

        }

        return false;

    }


    public function assignRole($roleId = null) {

        $roles = $this->roles;

        if(!$roles->contains($roleId)){
            return $this->roles()->attach($roleId);

        }

        return false;

    }


    public function revokeRole($roleId = '') {
        return $this->roles()->detach($roleId);
    }

    public function syncRoles(array $roleIds) {
        return $this->roles()->sync($roleIds);
    }

    public function revokeAllRoles() {
        return $this->roles()->detach();
    }


    public function getPermissions() {

        $permissions = [[],[]];

        foreach ($this->roles as $role){

            $permissions[] = $role->getPermissions();
        }

        return call_user_func_array('array_merge', $permissions);
    
    
    }

    public function can($permissions, $arguments = []) {

        $can = false;

        foreach($this->roles as $role){
            if($role->special === 'no-access'){
                return false;
            }

        }

        return true;

    }


    
    public function loadproduction($company_id, $user_id) {

        $knownDate = Carbon::now();
        $knownDate = new Carbon('next monday');

        // $knownDate->modify('this week -7 days')->format('Y-m-d'), $knownDate->endOfWeek()->format('Y-m-d')
        $shifthasplanning1 = ShiftHasPlanning::orderBy('id','DESC')->where('company_id','=',$company_id)->where('beginning_week','=',$knownDate->modify('this week -7 days')->format('Y-m-d'))->get();
        
        return $shifthasplanning1[0]->id;

        // if($shifthasplanning1)//TODO revisar consulta porque se realiza en la tabla locker
        // {
        //     return false;

        // }else{

        //     $company = Company::findOrFail($company_id);

        //     $shifthasplanning = $company->shifthasplanning()
        //     ->whereHas('monitorshift')
        //     ->with('monitorshift.shift')
        //     ->with('monitorshift.task')
        //     ->with('monitorshift.monitor.person')
        //     ->with('monitorshift.planningprovider.model.person')
        //     ->with('monitorshift.planningprovider.room')
        //     ->orderBy('id','DESC')
        //     ->get()
        //     ->where('id', '=',$shifthasplanning1[0]->id)
        //     ->pluck('monitorshift')
        //     ->collapse()
        //     ->where('monitor_id', '=',$user_id)
        //     ->unique()
        //     ->values();
    
        //     // dd($shifthasplanning);

        //     //       dd($shifthasplanning[0]->id);
        //     //       dd($shifthasplanning[0]->observation);

        //      return $shifthasplanning[0]->shift_has_planning_id;

        // }

    }



      /*****************  Revisar arriba funciones  shinobi *****************/
      /*****************  solicitud de cuenta *****************/

      public function accountrequest() //1 a m
      {
          return $this->hasMany('App\Models\AccountRequest');
      }

      public function boutique()//m a n
      {
          return $this->belongsToMany('App\Models\Boutique');
      }

      public function billtopay()//m a n
      {
          return $this->belongsToMany('App\Models\BillToPay');//pero una cuenta de pago puede tener varios abonos que le pertenecen a un usuario
      }

      public function pay()//m a n
      {
          return $this->hasOne('App\Models\BillToPay');//Una cuenta de pago solo tiene un Usuario
      }
  
      public function accounts(){// 1 a M

        return $this->hasMany('App\Models\Account');
    
      }

      public function inventory()//1 a 1
      {
          return $this->hasOne('App\Models\Inventory');
      }

      public function images()
      {
           return $this->belongsToMany('App\Models\Image')->withTimestamps();
      }
}
