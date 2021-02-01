<?php

namespace App\Services;

use App\Http\Controllers\Admin\ParseController;
use Illuminate\Redis\Connectors\PhpRedisConnector;
use Illuminate\Support\Facades\Redis;
use mysql_xdevapi\Exception;
use Orchestra\Parser\Xml\Facade as XmlParser;

class NewsParser {

    public function parse($source){
        try {
            $xml = XmlParser::load($source);
            $data = $xml->parse([
                'channel_title' => ['uses' => 'channel.title'],
                'channel_description' => ['uses' => 'channel.description'],
                'items' => ['uses' => 'channel.item[title,description,pubDate,category]'],
            ]);
        } catch (\Exception $e) {
            dd($source);
        }
            return $data;
    }
}
