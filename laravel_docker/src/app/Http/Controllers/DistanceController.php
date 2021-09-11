<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Illuminate\Support\Arr;


class DistanceController extends Controller
{
    public static $affFile = 'affiliates.txt';
    public static $dublinLat = 53.3340285;
    public static $dublinLon = -6.2535495;

    public function srtaf($obj) {
        usort($numbers, function ($x, $y) {
            if ($x === $y) {
                return 0;
            }
            return $x < $y ? -1 : 1;
        });
    }
    function cmp($a, $b) {
        return strcmp($a["affiliate_id"], $b["affiliate_id"]);
    }

    public function getDistanceBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2) {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515 * 1.609344;

        return (round($distance,2));
    }

    public function index(){

        $exists = Storage::disk('local')->exists(static::$affFile);

        if($exists) {

            $content = fopen(Storage::path(static::$affFile),'r');
            $array = array();
            $i=0;
            while(!feof($content)){
                $line = fgets($content);
                $line = str_replace("\n", "", $line);
                $obj = json_decode($line);
                $personLat = $obj->latitude;
                $personLon = $obj->longitude;
                $distance = static::getDistanceBetweenPoints(static::$dublinLat, static::$dublinLon, $personLat, $personLon);

                // Insert into the new array affiliates that are close or equal to 100km to the dublin office
                if ($distance <= 100) {
                    $obj->distance = $distance;
                    $array = Arr::add($array, $i, $obj);
                    $i++;
                }
            }
            fclose($content);
            usort($array,function($a,$b){
                $c = $a->affiliate_id - $b->affiliate_id;
                // $c .= strcmp($a->affiliate_id,$b->affiliate_id);
                return $c;
            });
            dd($array);

            return view('distance.index', ['file_exists' => $exists]);
        }
        else {
            return view('distance.index', ['file_exists' => $exists]);
        }


    }
}
