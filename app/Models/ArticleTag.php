<?php

namespace App\Models;

use App\Article;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $article_id
 * @property integer $tag_id
 * @property Tag $tag
 * @property Article $article
 */
class ArticleTag extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['article_id', 'tag_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
