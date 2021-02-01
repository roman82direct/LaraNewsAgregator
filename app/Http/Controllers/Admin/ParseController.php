<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsingJob;
use App\Models\News;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParseController extends Controller
{
    public $sourcesYandex = [
        'https://news.yandex.ru/auto.rss',
        'https://news.yandex.ru/auto_racing.rss',
        'https://news.yandex.ru/gadgets.rss',
        'https://news.yandex.ru/index.rss',
//        'https://news.yandex.ru/martial_arts.rss',
//        'https://news.yandex.ru/communal.rss',
//        'https://news.yandex.ru/health.rss',
//        'https://news.yandex.ru/games.rss',
//        'https://news.yandex.ru/internet.rss',
//        'https://news.yandex.ru/cyber_sport.rss',
//        'https://news.yandex.ru/movies.rss',
//        'https://news.yandex.ru/cosmos.rss',
//        'https://news.yandex.ru/culture.rss',
//        'https://news.yandex.ru/championsleague.rss',
//        'https://news.yandex.ru/music.rss',
//        'https://news.yandex.ru/nhl.rss',
    ];

    public function loadYandexNews(){
        foreach ($this->sourcesYandex as $source){
            NewsParsingJob::dispatch($source);
        }
        return redirect()->back()->with('success', "Новости загружены");
    }
}
