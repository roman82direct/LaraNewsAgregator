<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParseController extends Controller
{
    public function index(){
        $xml = XmlParser::load('https://3dnews.ru/news/rss/');
        $data = $xml->parse([
            'channel_title' => ['uses' => 'channel.title'],
            'channel_description' => ['uses' => 'channel.description'],
            'items' => ['uses' => 'channel.item[title,description,pubDate,category]'],
        ]);
        dump($data);
//        foreach ($data['items'] as $item){
//            News::insert(['category_id' => 8, 'title' => $item['title'], 'text' => $item['description']]);
//        }

        return redirect()->back();
    }
}
