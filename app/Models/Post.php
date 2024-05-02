<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'body', 'image', 'posted_by'];
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'title_slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
