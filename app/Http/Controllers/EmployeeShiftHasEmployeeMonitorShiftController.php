<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Person;
use App\Models\Task;
use App\Models\MonitorShift;
use App\Models\Shift;
use App\Models\ShiftHasEmployee;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class EmployeeShiftHasEmployeeMonitorShiftController extends ApiController
{
   
    public function store(Request $request, Employee $employee, ShiftHasEmployee $shifthasemployee)
    {
        // dd($request->task_id);

            return DB::transaction(function() use ($request, $employee, $shifthasemployee){

                $monitorshift = MonitorShift::create([
                    'observation' => $request->observation,
                    'task_id' => $request->task_id,
                    'shifthasemployees_id' => $shifthasemployee->id,
                    'employee_id' => $employee->id,
                ]);

                return $this->showOne($monitorshift, 201);
            });

    }

    public function update(Request $request, Employee $employee, ShiftHasEmployee $shifthasemployee, MonitorShift $monitorshift)
    {
        return DB::transaction(function() use ($request, $employee, $shifthasemployee, $monitorshift){

            if($monitorshift->isDirty()){
                return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
                 'code' => 422], 422);
            }

            $monitorshift->fill($request->all());

            $monitorshift->shifthasemployees_id = $shifthasemployee->id;
            $monitorshift->employee_id = $employee->id;
            $monitorshift->save();

            return $this->showOne($monitorshift);
        });
    }

}
