<?php

namespace App\Http\Controllers;

use App\Traits\Base;
use Storage;
use File;
use Illuminate\Support\Arr;

class DistanceController extends Controller
{
    use Base;
    public static $affFile = 'affiliates.txt';
    public static $dublinLat = 53.3340285;
    public static $dublinLon = -6.2535495;

    public function index(){
        try{
            // check if file exists
            $file_exists = Storage::disk('local')->exists(static::$affFile);

            if($file_exists) {
                // open file
                $content = fopen(Storage::path(static::$affFile),'r');
                $array = array();
                $i=0;
                // go through file contents line by line
                while(!feof($content)){
                    $line = fgets($content);
                    $line = str_replace("\n", "", $line);
                    $obj = json_decode($line);

                    // calculate distance from dublin office
                    $distance = $this->getDistanceBetweenPoints(static::$dublinLat, static::$dublinLon, $obj->latitude, $obj->longitude);

                    // Insert into the new array affiliates that are close or equal to 100km to the dublin office
                    if ($distance <= 100) {
                        $obj->distance = $distance;
                        $array = Arr::add($array, $i, $obj);
                        $i++;
                    }
                }
                fclose($content);

                // sort array by affiliate_id
                $array = $this->getSortedArray($array);

                return view('distance.index', ['file_exists' => $file_exists, 'attendees' => $array]);
            }
            else {
                return view('distance.index', ['file_exists' => $file_exists]);
            }
        }catch (Exception $e){
            // Log here
            Log::error($e);
            return 'Sorry! Something went wrong! Please contact the administrator.';
        }

    }
}
