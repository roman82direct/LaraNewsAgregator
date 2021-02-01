<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\News
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property int|null $source_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $text
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $img_source
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImgSource($value)
 */
class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_id',
        'title',
        'text',
        'source_id',
        'img_source',
        'created_at',
        'updated_at'
    ];

    public static function createRules()
    {
        return [
            'title' => 'required|min:5|max:255',
            'category' => 'required',
            'text' => 'required'
        ];
    }

    public function deleteAllNews()
    {

    }
}
