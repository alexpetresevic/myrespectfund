<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toolkit extends Model
{
    protected $fillable = ['title', 'body'];

    public function file()
    {
        return $this->morphOne(File::class, 'file');
    }
}
