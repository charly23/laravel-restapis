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

    /**
    * Time to make our Instagram api request. We'll build the url using the
    * coordinate values returned by the google maps api
    */

    public static function instagram_api ( $id=null, $maps_array=null ) 
    {
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

    // facebook-api
    // https://graph.facebook.com/v1.0/me/friends?access_token={$token}

    public static function facebook_api ( $id=null, $maps_array=null ) 
    {
        // call
    }

    // youtube-api
    // https://www.googleapis.com/youtube/v3/videos
    // https://www.googleapis.com/youtube/v3/videos?id=&part=contentDetails&key={YOUR_API_KEY}
    // AIzaSyAvIqMNlAHCnAqMnX7O25J7XH1pKuUdJFc

    public static function youtube_api ( $keys=null ) 
    {
        $i=0;
        $api_key = $key;
        $api_base = 'https://www.googleapis.com/youtube/v3/videos';
        $thumbnail_base = 'https://i.ytimg.com/vi/';

        $params = array(
            'part' => 'contentDetails',
            'id' => $vid,
            'key' => $api_key,
        );

        $api_url = $api_base . '?' . http_build_query($params);
        $result = json_decode(@file_get_contents($api_url), true);

        if(empty($result['items'][$i]['contentDetails']))
            return null;
        $vinfo = $result['items'][$i]['contentDetails'];

        $interval = new DateInterval($vinfo['duration']);
        $vinfo['duration_sec'] = $interval->h * 3600 + $interval->i * 60 + $interval->s;

        $vinfo['thumbnail']['default']       = $thumbnail_base . $vid . '/default.jpg';
        $vinfo['thumbnail']['mqDefault']     = $thumbnail_base . $vid . '/mqdefault.jpg';
        $vinfo['thumbnail']['hqDefault']     = $thumbnail_base . $vid . '/hqdefault.jpg';

        $vinfo['thumbnail']['sdDefault']     = $thumbnail_base . $vid . '/sddefault.jpg';
        $vinfo['thumbnail']['maxresDefault'] = $thumbnail_base . $vid . '/maxresdefault.jpg';

        return $vinfo;
    }

    /**
     * Register any events for your application.
     *
     * @return void
     */
    
    public function boot()
    {
        parent::boot();

        //
    }

    // END
}
