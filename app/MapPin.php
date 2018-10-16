<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MapPin extends Model
{
    public function funeralHome()
    {
        return $this->belongsTo(FuneralHome::class);
    }
    
    /**
     * @param FuneralHome $funeralHome
     *
     * @return bool|void
     */
    public static function saveMapPin(FuneralHome $funeralHome, $stateAndZip)
    {
        $mapPin = new MapPin();
        
        $zipCode = ($funeralHome->zip_code === 'N/A') ? '' : $funeralHome->zip_code;
        $gAddress = ($funeralHome->address === 'N/A') ? '' : $funeralHome->address;
        
        if ($zipCode !== '' && $gAddress !== '') {
            
            if (strpos($gAddress, '#')) {
                $gAddress = urlencode($gAddress);
            }
            
            $address = str_replace(' ', '+', $gAddress . ', ' . $stateAndZip);
            
            try{
                $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&key=' . config('app.google_map_api'));
                $output = json_decode($geocode);
            }catch (\Exception $e){
                Log::info('url ' . 'https://maps.google.com/maps/api/geocode/json?address=' . $address . '&key=' . config('app.google_map_api'));
                Log::info('File get content error ' . $e->getMessage());
            }
            
            try{
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
                
                $mapPin->entity_id = $funeralHome->id;
                $mapPin->entity = FuneralHome::class;
                $mapPin->longitude = $longitude;
                $mapPin->latitude = $latitude;
                
                $mapPin->save();
            }catch (\Exception $e){
                Log::info('url ' . 'https://maps.google.com/maps/api/geocode/json?address=' . $address . '&key=' . config('app.google_map_api'));
                Log::info('Address ' . $address);
                if (isset($geocode)) {
                    Log::info('Geocode ' . $geocode);
                }
                Log::info('Funeral home id ' . $funeralHome->id);
                if (isset($output)) {
                    foreach ($output->results as $key => $result) {
                        Log::info('Geometry ' . $key . ' ' . $result);
                    }
                }
                Log::info('Error message ' . $e->getMessage());
                
            }
            
        }
    }
    
    /**
     * @param FuneralHome $funeralHome
     * @param             $longitude
     * @param             $latitude
     */
    public static function updateMapPin(FuneralHome $funeralHome, $longitude, $latitude)
    {
        if ( ! is_null($funeralHome->location)) {
            try{
                $mapPin = MapPin::where('entity_id', $funeralHome->id)->first();
                
                $mapPin->longitude = $longitude;
                $mapPin->latitude = $latitude;
                
                $mapPin->update();
            }catch (\Exception $e){
                Log::error($e->getMessage());
            }
        }else {
            self::saveMapPin($funeralHome);
        }
    }
}
