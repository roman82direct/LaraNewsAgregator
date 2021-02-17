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
use Mockery\Exception;

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
        \Storage::disk('parser_logs')->append('parser.log', date("H:i:s "). $this->source);
        $message = 'success';
        try {
            $news = $parser->parse($this->source);
            } catch (\Exception $exception){
            $message = "error: " .$exception->getMessage();
        } finally {
            \Storage::disk('parser_logs')->append('parser.log', $message);
        }
        $existCat = NewsCategories::whereTitle($news['channel_title'])->value('id');
        $category = !is_null($existCat) ? NewsCategories::find($existCat) : new NewsCategories();
        $category->fill([
            "title" => $news['channel_title'],
            "description" => $news['channel_description']
        ])->save();

        foreach ($news['items'] as $item){
            $newsId =News::whereTitle($item['title'])->value('id');
            if (is_null($newsId)){
                News::insert([
                    'category_id' => $category->id,
                    'title' => $item['title'],
                    'text' => $item['description'],
                    'build' => 'loaded',
                    'img_source' => 'https://place-hold.it/100',
                    'created_at' => date("Y-m-d H:i:s"),
                    'source_id' => 1
                ]);
            }
        }
    }

}
