<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    const DONATION_TYPE_TIP = 0;
    const DONATION_TYPE_FUND = 1;
    
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
