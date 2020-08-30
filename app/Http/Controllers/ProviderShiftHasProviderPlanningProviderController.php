<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Person;
use App\Models\Room;
use App\Models\PlanningProvider;
use App\Models\Shift;
use App\Models\ShiftHasProvider;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProviderShiftHasProviderPlanningProviderController extends ApiController
{
   
    public function store(Request $request, Provider $provider, ShiftHasProvider $shifthasprovider)
    {
        return DB::transaction(function() use ($request, $provider, $shifthasprovider){

            $planningprovider = PlanningProvider::create([
                'observation' => $request->observation,
                'room_id' => $request->room_id,
                'shifthasprovider_id' => $shifthasprovider->id,
                'provider_id' => $provider->id,
            ]);

            return $this->showOne($planningprovider, 201);
        });
    }

    public function update(Request $request, Provider $provider, ShiftHasProvider $shifthasprovider, PlanningProvider $planningprovider)
    {
            return DB::transaction(function() use ($request, $provider, $shifthasprovider, $planningprovider ){


            if($planningprovider->isDirty()){
                return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
                 'code' => 422], 422);
            }

            $planningprovider->fill($request->all());

            $planningprovider->shifthasprovider_id = $shifthasprovider->id;
            $planningprovider->provider_id = $provider->id;
            $planningprovider->save();

            return $this->showOne($planningprovider);
        });
    }

}
