<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }

    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();

        $data = ['data'=>$categories];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        $data = ['data'=>$category];
        return $this->showOne($data, 201);
        
    }

    public function show(Category $category)
    {
        $data = ['data'=>$category];
        return $this->showOne($data);
    }

    public function update(Request $request, Category $category)
    {
        $category->fill($request->all())->save();
        return $this->showOne($category);
    }

    public function destroy(Category $category)
    {
        $category->delete($category);
        return $this->showOne($category);
    }
}
