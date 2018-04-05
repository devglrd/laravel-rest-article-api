<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use \App\Http\Resources\Article as ArticleResource;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id', 'DESC')->get();
        //dd($articles);
        return ArticleResource::collection($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //$article->id = $request->input('article_id');
        if (empty(request()->all())){
            return response()->json([
                'Message' => "Wrong Request",
                'Details' => [
                    "error" => "You must specify a new title and a new body in a JSON format"
                ]
            ]);
        }
        if (!request()->has('title')){
            return response()->json([
               'Message' => "Wrong Request",
               'Details' => [
                   "error" => "You must specify a title"
               ]
            ]);
        }else if (!request()->has('body')){
            return response()->json([
                'Message' => "Wrong Request",
                'Details' => [
                    "error" => "You must specify a body"
                ]
            ]);
        }
        $article = new Article();
        $article->title = $request->title;
        $article->body = $request->body;
    
        $article->save();
        return response()->json([
           'Message' => 'Success',
           'Article' => $article
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::where('id', $id)->first();
        //dd($article);
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (empty(request()->all())){
            return response()->json([
                'Message' => "Wrong Request",
                'Details' => [
                    "error" => "You must specify a new title and a new body in a JSON format"
                ]
            ]);
        }
        if (!request()->has('title')){
            return response()->json([
                'Message' => "Wrong Request",
                'Details' => [
                    "error" => "You must specify a new title"
                ]
            ]);
        }else if (!request()->has('body')){
            return response()->json([
                'Message' => "Wrong Request",
                'Details' => [
                    "error" => "You must specify a new body"
                ]
            ]);
        }
        $article = Article::where('id', $id)->first();
        
        $article->title = $request->title;
        $article->body = $request->body;
    
        $article->save();
        
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::where('id', $id)->first();
        
        if ($article->delete()){
            return new ArticleResource($article);
        }
    }
}
