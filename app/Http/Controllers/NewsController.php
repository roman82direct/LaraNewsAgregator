<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategories;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::query()
            ->orderBy('updated_at', 'desc')
            ->paginate(4);
        return view('news', ['news' => $news, 'categories' => NewsCategories::all(), 'id' => 0]);
    }

    public function showCategories(){
        $categories = NewsCategories::query()
        ->get();
//        dd($categories);
        return view('newsCategories', ['categories'=>$categories]);
    }

    public function showNewsByCategory($id){
        $news = News::whereCategoryId($id)
            ->orderBy('updated_at', 'desc')
            ->paginate(4);
        return view('newsByCategory', ['news' => $news, 'id' =>$id]);
    }

    public function showNews($id){
        $newsItem = News::find($id);
        return view('newsItem', ['newsItem'=>$newsItem, 'id'=>$newsItem->category_id]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }

}
