<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth:api');
      //  $this->middleware('MonologMiddleware');

    }
    

    public function index()
    {
        // // $polls = Poll::orderBy('id','DESC');   
        // // $polls = Poll::orderBy('id','ASC')->pluck('number', 'location', 'id');
        // $polls= Poll::orderBy('id','DESC')->get();
          
        // $data = ['data'=>$polls];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $poll = Poll::create($request->all());
        return $this->showOne($poll, 201);
    }

    public function show(Poll $poll)
    {
        $data = ['data'=>$poll];
        return $this->showOne($data);
    }

    public function update(Request $request, Poll $poll)
    {
        $poll->fill($request->all())->save();
        return $this->showOne($poll);
    }

    public function destroy(Poll $poll)
    {
        $poll->delete($poll);
        return $this->showOne($poll);
    }
}
