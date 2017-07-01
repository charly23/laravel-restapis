<?php 
namespace App\library;

use Illuminate\APIs as APIsServices;
use Illuminate\Support\Facades\APIs as APIsFacades;

class submit extends APIsFacades
{
    
    public static function actions ( $value=null ) 
    {
        $data = null;
        if( !empty( $value) ) :
            $data = static::maps_api( $value );
            // $data = static::instagram_api( '',$maps_array);
        else :
            echo '<pre>empty input</pre>';
        endif;

        return $data;
    }

    public static function maps_api ( $str=null ) 
    {   
        $i=0;

        $maps_url = 'https://' .
            'maps.googleapis.com/' .
            'maps/api/geocode/json' .
            '?address=' . urlencode($str);

        $maps_json = file_get_contents($maps_url);
        $maps_array = json_decode($maps_json,true);

        if(isset( $maps_array )) :
            echo '<pre>';
            var_dump($maps_array); 
            echo '</pre>';
        endif;

    }

    public static function instagram_api ( $id=null, $maps_array=null ) 
    {
        /**
         * Time to make our Instagram api request. We'll build the url using the
         * coordinate values returned by the google maps api
         */

        $client_id = $id;

        $lat = $maps_array['results'][$i]['geometry']['location']['lat'];
        $lng = $maps_array['results'][$i]['geometry']['location']['lng'];

        $url = 'https://' .
            'api.instagram.com/v1/media/search' .
            '?lat=' . $lat .
            '&lng=' . $lng .
            '&client_id=' . $id; // replace "CLIENT-ID"

        $json = file_get_contents($url);
        $array = json_decode($json, true);

        return $array;
    }

    public static function facebook_api ( $id=null, $maps_array=null ) 
    {
        // facebook-api
        // https://graph.facebook.com/v1.0/me/friends?access_token={$token}
    }

    public static function youtube_api ( $keys=null ) 
    {
        // youtube-api
        // https://www.googleapis.com/youtube/v3/videos
        // https://www.googleapis.com/youtube/v3/videos?id=&part=contentDetails&key={YOUR_API_KEY}
        // AIzaSyAvIqMNlAHCnAqMnX7O25J7XH1pKuUdJFc
    }

    // END
}
