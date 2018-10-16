<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FuneralHome extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function image()
    {
        return $this->morphOne(File::class, 'file');
    }
    
    public function location()
    {
        return $this->hasOne(MapPin::class, 'entity_id');
    }
    
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
    
    /**
     * @param      $row
     * @param User $user
     *
     * @return FuneralHome
     * @throws \Exception
     */
    public static function saveFuneralHome($row, User $user = null)
    {
        try{
            $funeralHome = new FuneralHome();
            $funeralHome->name = is_null($row['fh_business_name']) ? 'N/A' : $row['fh_business_name'];
            $funeralHome->contact_name = isset($row['contact_name']) ? $row['contact_name'] : 'N/A';
            $funeralHome->communities_served = 'N/A';
            $funeralHome->email = is_null($row['email']) ? 'N/A' : $row['email'];
            $funeralHome->phone_number = is_null($row['fh_phone_number']) ? 'N/A' : $row['fh_phone_number'];
            $funeralHome->address = is_null($row['address']) ? 'N/A' : $row['address'];
            $funeralHome->zip_code = is_null($row['zip_code']) ? 'N/A' : $row['zip_code'];
            $funeralHome->user_id = is_null($user) ? null : $user->id;
            
            $funeralHome->save();
            
        }catch (\Exception $e){
            Log::error($e->getMessage());
            throw new \Exception('Error while creating funeral home');
        }
        
        return $funeralHome;
    }
}
