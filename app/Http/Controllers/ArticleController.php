<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de banco"]
        // ];

        // $articles = Article::orderBy('id','DESC')->get();

        // $data = ['data'=>$articles, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return $this->showOne($article, 201);
        
    }

    public function show(Article $article)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver banco"]
        ];

        $data = ['data'=>$article, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Article $article)
    {
        $article->fill($request->all())->save();
        return $this->showOne($article);
    }

    public function destroy(Article $article)
    {
        $article->delete($article);
        return $this->showOne($article);
    }
}
