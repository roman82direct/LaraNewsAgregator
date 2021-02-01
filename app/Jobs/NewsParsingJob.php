<?php

namespace App\Jobs;

use App\Models\News;
use App\Models\NewsCategories;
use App\Services\NewsParser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsParsingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NewsParser $parser)
    {
        $news = $parser->parse($this->source);

        $exist = NewsCategories::whereTitle($news['channel_title'])->value('id');
        $category = !is_null($exist) ? NewsCategories::find($exist) : new NewsCategories();
        $category->fill([
            "title" => $news['channel_title'],
            "description" => $news['channel_description']
        ])->save();
        foreach ($news['items'] as $item){
            $newsId =News::whereTitle($item['title'])->value('id');
//            dd($newsId);
            if (is_null($newsId)){
                News::insert(['category_id' => $category->id,
                    'title' => $item['title'],
                    'text' => $item['description'],
                    'source_id' => 1]);
            }
        }
    }
}
