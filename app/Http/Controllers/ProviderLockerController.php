<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Locker;
use Illuminate\Http\Request;

class ProviderLockerController extends ApiController
{
    
    public function index(Provider $provider)
    {
        $lockers = $provider->lockers;
        return $this->showAll($lockers);
    }

    public function update(Request $request, Provider $provider, Locker $locker)
    {
        //TODO: debe eliminar el registro de un locker asignado anteriormente

        $provider->lockers()->sync([$locker->id]);

        return $this->showAll($provider->lockers);
    }

    public function destroy(Provider $provider, Locker $locker)
    {
        if(!$provider->lockers()->find($locker->id))
        {
            // dd($locker->id);
            return $this->errorResponse("El Locker especificado no pertenece a ese Provedor",404);
        }

        $provider->lockers()->detach($locker->id);
        return $this->showAll($provider->lockers);
    }//destroy
}
