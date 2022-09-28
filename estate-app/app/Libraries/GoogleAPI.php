<?php
namespace App\Libraries;

use Illuminate\Support\Facades\Http;

class GoogleAPI
{
    /**
     * @param string $destinations
     * 
     * @return array
     */
    public static function distanceMatrixApi(string $destinations): array
    {
        return Http::get(env('GOOGLE_DISTANCE_MATRIX_API_URL'), [
            'destinations' => $destinations, 
            'origins' => env('REALTOR_ZIP_CODE'),
            'units' => 'imperial',
            'key' => env('GOOGLE_DISTANCE_MATRIX_API_KEY')
        ])->collect()['rows'][0]['elements'][0];
    }
}