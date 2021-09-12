<?php

namespace App\Traits;

trait Base {

    function getSortedArray( $a ) {
        usort( $a, array( $this, 'affIDSort' ) );
        return $a;
    }

    private function nameSort( $a, $b )
    {
        return strcmp( $a, $b );
    }

    private function affIDSort( $a, $b )
    {
        return $a->affiliate_id - $b->affiliate_id;
    }

    public function sortObject($array, $key)
    {
        usort($array, function ($a, $b) use ($array, $key){
            $c = $a->$key - $b->$key;
            // $c .= strcmp($a->affiliate_id,$b->affiliate_id);
            return $c;
        });
    }

    public function srtaf($obj)
    {
        usort($numbers, function ($x, $y) {
            if ($x === $y) {
                return 0;
            }
            return $x < $y ? -1 : 1;
        });
    }

    public function getDistanceBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515 * 1.609344;

        return (round($distance, 2));
    }
}
