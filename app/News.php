<?php

namespace App;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Sluggable;

    protected static $sluggable = [
        'from' => ['title'],
        'to' => 'slug',
    ];

    public function image()
    {
        return $this->morphOne(File::class, 'file');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
