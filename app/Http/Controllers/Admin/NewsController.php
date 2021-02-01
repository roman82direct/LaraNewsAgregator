<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategories;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;

class NewsController extends Controller
{
    public function index(){
//        foreach (NewsCategories::all() as $item){
//            dump($item->title, News::where('category_id', $item->id)->count());
//        }
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
//        dd($request->file('file')->getFileInfo());

        $this->validate($request, News::createRules());
        $id = $request->post('id');
        $model = $id ? News::find($id) : new News();

//        $path = storage_path('uploads')."".$_FILES['file']['name'];
//        dd($path);
//        if(move_uploaded_file($_FILES['file']['tmp_name'],$path)){
//
//        }

        $model->fill([
            "title" => $request->post('title'),
            "category_id" => NewsCategories::whereTitle($request->post('category'))->value('id'),
            "text" => $request->post('text'),
            "source_id" => Source::whereTitle($request->post('source'))->value('id'),
//            "img_source" => storage_path('app/uploads/').$_FILES['file']['name'],
            "build" => "by_admin"
        ])->save();
            if (is_file($request->file('file'))){
                $request->file('file')->store('uploads');
                $message = 'Данные сохранены';
            } else
                $message = 'Данные сохранены. Файл не выбран!';

        return redirect()->route("admin::updateNews", ['id' => $model->id])
            ->with('success', $message);
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

    public function deleteAllNews(){
        News::select()->delete();
        NewsCategories::select()->delete();
        return redirect()->back()
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
//        dd($request->has('check')); //проверка чекбокса на checked
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
