<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $fillable = ['name', 'url', 'url_new_window'];

    public function image()
    {
        return $this->morphOne(File::class, 'file');
    }

}
