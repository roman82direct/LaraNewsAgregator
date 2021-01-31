<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategories;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function index(){
        $news = News::query()
            ->orderBy('updated_at', 'desc')
            ->paginate(2);
        return view('admin/news', ['news' => $news]);
    }

    public function createNews(){
        return view("admin/adminaddNews", [
            'model' => new News(),
            'id'=>'',
            'categories' => $this->getCategoriesList()
        ]);
    }

    public function saveNews(Request $request)
    {
        $this->validate($request, News::createRules());
        $id = $request->post('id');
        $model = $id ? News::find($id) : new News();
        $model->fill([
            "title" => $request->post('title'),
            "category_id" => NewsCategories::whereTitle($request->post('category'))->value('id'),
            "text" => $request->post('text'),
            "source_id" => Source::whereTitle($request->post('source'))->value('id')
        ])->save();
        return redirect()->route("admin::updateNews", ['id' => $model->id])
            ->with('success', "Данные сохранены");
    }

    public function updateNews($id)
    {
        return view("admin/adminaddNews", [
                'model' => News::find($id),
                'categories' => $this->getCategoriesList()
            ]
        );
    }

    public function deleteNews($id){
        News::destroy([$id]);
        return redirect()->route("admin::news")
            ->with('success', "Данные удалены");
    }

    public function createCategory(){
        return view("admin/adminaddCategory", [
            'model' => new NewsCategories(),
            'id'=>'',
            'categories' => $this->getCategoriesList()
        ]);
    }

    public function saveCategory(Request $request){
        $id = $request->post('id');
        $model = $id ? NewsCategories::find($id) : new NewsCategories();
        $model->fill([
            "title" => $request->post('title'),
            "description" => $request->post('discr')
        ])->save();
        return redirect()->route("admin::updateCategory", ['id' => $model->id])
            ->with('success', "Новая категория новостей сохранена");
    }

    public function updateCategory($id)
    {
        return view("admin/adminAddCategory", [
                'model' => NewsCategories::find($id)
            ]);
    }

    protected function getCategoriesList()
    {
        return NewsCategories::query()
            ->select(['id', 'title'])
            ->get()
            ->pluck('title', 'id');
    }
}
