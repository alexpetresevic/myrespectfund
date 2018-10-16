<?php

namespace App;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
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
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function funeralHome()
    {
        return $this->belongsTo(FuneralHome::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
    
    public function updates()
    {
        return $this->hasMany(CampagnUpdate::class);
    }
    
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
    
    public function allApprovedDonations()
    {
        return $this->donations()->where('approved', 1)->where('type', Donation::DONATION_TYPE_FUND);
    }
    
    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
    
    public function allTips()
    {
        return $this->donations()->where('approved', 1)->where('type', Donation::DONATION_TYPE_TIP);
    }

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }
}
