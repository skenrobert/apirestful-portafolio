<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends ApiController
{
    public function index()
    {
       
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de banco"]
        ];

        $tags = Tag::orderBy('id','DESC')->get();

        $data = ['data'=>$tags, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $tag = Tag::create($request->all());
        return $this->showOne($tag, 201);
        
    }

    public function show(Tag $tag)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver banco"]
        ];

        $data = ['data'=>$tag, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->fill($request->all())->save();
        return $this->showOne($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete($tag);
        return $this->showOne($tag);
    }
}
