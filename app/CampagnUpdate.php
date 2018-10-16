<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampagnUpdate extends Model
{
    protected $fillable = ['campaign_id', 'body', 'date', 'time'];
    
    public function image()
    {
        return $this->morphOne(File::class, 'file');
    }
    
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
