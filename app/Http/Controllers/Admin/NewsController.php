<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news = News::query()
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
        return view('admin', ['news' => $news]);
    }
}
