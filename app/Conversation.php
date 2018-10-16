<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public static function getByParticipants($userId, $parentId)
    {
        return Conversation::where('user_id', $userId)->where('partner_id', $parentId)->first();
    }
    
    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }
}
