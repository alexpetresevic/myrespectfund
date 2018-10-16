<?php

namespace App;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

    protected static $sluggable = [
        'from' => ['title'],
        'to'   => 'slug',
    ];

    protected $fillable = ['title', 'body', 'published'];
    protected $with = ['author', 'categories', 'tags'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function image()
    {
        return $this->morphOne(File::class, 'file');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
