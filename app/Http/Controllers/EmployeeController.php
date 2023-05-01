<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Empleados"]
        // ];
     
        // $employees = Employee::orderBy('id','DESC')->get();

        // $employees->each(function($employees){
        //     $employees->employeetype;
        //     $employees->person->user;// 1 a 1
        //     $employees->person->company;
        //   });

        // // $employees = Employee::with('person.company.companytype')->orderBy('id','DESC')->get();
        // // $employees = Employee::with('person.company.companytype')->orderBy('id','DESC')->get();


        // //(property_exists($employee, 'Profile') && property_exists($employee->Profile, 'employee_code') && $employee->Profile->employee_code != '') ? $employee->Profile->employee_code : 'Not assigned'  
        
        // $data = ['data'=>$employees, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
          
    }

    public function store(Request $request)
    {
        $employee = Employee::create($request->all());
        // $employee->id_type = $request->id_type; CREO que lo hace directo employee 1 a 1

        return $this->showOne($employee, 201);
    }

    public function show(Employee $employee)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Empleado"]
        ];

        $employee->person->user;// 1 a 1
        $employee->person->company;// 1 a 1
        $employee->employeetype;

        $data = ['data'=>$employee, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->fill($request->all())->save();
        return $this->showOne($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete($employee);
        return $this->showOne($employee);
    }

    // // Return Employee View
 
    // public function employee_list(Employee $employee)
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Todas los Empleados"]
    //     ];

    //     return view('/pages/app-employee-list', [
    //         'breadcrumbs' => $breadcrumbs
    //     ]);
    // }


    //******************************************************************************************* */


    public function employeeGetAllAccounts()
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Empleados que han creado cuentas"]
        ];
     
       $employees = Employee::has('accounts')->get();//1 a n

        $employees->each(function($employees){
            $employees->person;
            $employees->accounts;

          });

        $data = ['data'=>$employees, 'breadcrumbs'=> $breadcrumbs];

        return $this->showAll($data);
    }

    public function employeeShowAccount($id)
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Detalle de la cuenta de un empleado"]
        ];
     
       $employee = Employee::has('accounts')->findOrFail($id);

            $employee->person;
            $employee->accounts;

        $data = ['data'=>$employee, 'breadcrumbs'=> $breadcrumbs];

        return $this->showAll($data);
    }


    // public function onlymonitor(Request $request, $id)
    // {

    //     $employee = Employee::find($id);

    //     $employees = $company->people()
    //     // ->whereHas('employee')
    //     ->with('employee')
    //     ->get()
    //     // ->pluck('employee')
    //     ->unique()
    //     ->values();


    //     $data = ['data'=>$employee];
    //     return $this->showAll($data);

    // }

    // public function storeType(Request $request, $id)//Funcion solo para agregar role al usuario
    // {

    //     $employee = Employee::find($id);

    //     $employee->id_type = $request->id_type;

    //     // $user->notify(new NotificationUser());

    //     return response()->json([$employee], 200);


    //     // return $this->showOne($user, 201);
    // }

    //**************************************************************metodos de relaciones********/
  
    // public function employeeGetAllType()
    // {

    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Empleados con su tipo"]
    //     ];
     
    //     $employees = Employee::all();

    //      $employees->each(function($employees){
    //         $employees->employeetype;//1 a 1
    //        });
         
    //     return response()->json(['data'=>$employees, 'breadcrumbs'=> $breadcrumbs], 200);
          

    // }


    
    
 

}
