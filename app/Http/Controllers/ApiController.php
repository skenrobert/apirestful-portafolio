<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ApiController extends Controller
{
    
    use ApiResponser;

    public function __construct()//TODO: se deshabilita para probar el json
    {
        // // $this->middleware('auth');
        // parent::__construct();
        // $this->middleware('transform.input:'. UserTransformer::class)->only(['store', 'update']);

    }

}
