<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Person;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyEmployeeController extends ApiController
{
   
    public function index(Company $company)
    {
        //mejorar no me muestra la tabla empleado
        // $employees = Company::with('people.employee')->orderBy('id','DESC')->get();
        // $employees = $company->people;
        $employees = $company->people()
        // ->whereHas('employee')
        ->with('employee')
        ->with('user')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('employee')
        ->unique()
        ->values();

        $data = ['data'=>$employees];
        return $this->showAll($data);

    }

    
    public function update(Request $request, Company $company, Employee $employee)
    {
        


        $company->people()->syncWithoutDetaching([$employee->person_id]);

        $employee->person->user->company_id = $company->company_id;

        return $this->showAll($employee->person->companies);
        // return $this->showAll($company->people);

        
    }

    public function destroy(Company $company, Employee $employee)
    {
        //se elimina la relación en la tabla pivote

        //TODO: debe eliminar de la tabla empleado el registro
        if(!$company->people()->find($employee->person_id))
        {
            return $this->errorResponse("El Empleado especificado no trabaja en esa empresa",404);
        }
        // TODO : el delete creo que es necesario porque si la persona se le quita la empresa deberia quitarse de la tabla empleado
        $company->people()->detach($employee->person_id);
        $employee->delete($employee);// si el ide de persona aperece una vez en la tabla pivot
        // return $this->showAll($company->people);
        return $this->showAll($employee->person->companies);

    }
}
