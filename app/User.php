<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'email',
        'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function profile()
    {
        return $this->belongsTo(UserProfile::class);
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function image()
    {
        return $this->morphOne(File::class, 'file');
    }
    
    public function funeralHomes()
    {
        return $this->hasMany(FuneralHome::class);
    }
    
    public function funeralHome()
    {
        return $this->hasOne(FuneralHome::class);
    }
    
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
    
    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }
    
    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'partner_id');
    }
    
    public function userConversation()
    {
        return $this->hasOne(Conversation::class, 'user_id');
    }
    
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
    
    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
    
    public function wepayAccount()
    {
        return $this->hasOne(WepayAccount::class);
    }
    
    /**
     * Check if user has certain campaign
     *
     * @param int $id
     *
     * @return bool
     */
    public function hasCampaign($id)
    {
        foreach ($this->campaigns as $campaign) {
            if ($campaign->id == $id) {
                return true;
            }
        }
        
        return false;
    }
    
    public function getCampaign($id)
    {
        $campaign = Campaign::find($id);
        if ($this->id === $campaign->user->id) {
            return $campaign;
        }
        
        return null;
    }
    
    public function isAdmin()
    {
        return $this->role->code === 'admin';
    }
    
    public function is($role)
    {
        return $this->role->code === $role;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
