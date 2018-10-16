<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->morphOne(File::class, 'file');
    }
}
