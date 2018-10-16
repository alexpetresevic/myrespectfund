<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
    
    public static function getRoleId($roleCode)
    {
        return Role::where('code', $roleCode)->select('id')->first()->id;
    }
}
