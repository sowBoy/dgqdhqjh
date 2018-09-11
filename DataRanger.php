<?php

/**
 * This class is the place of data processing of the API
 *
 * @author sowboy
 */
class DataRanger {
    
    const TRAIN = "train";
    const FLIGHT = "flight";
    const BUS = "bus";

    /**
     * The sorting algorithm
     *
     * @param array $data
     *
     * @return Station
     */
    public function sortData($data)
    {
        
    }
    
    public function returnTheDepartureAndArrival($data) {
        $allDepartures = [];
        $allArrivals = [];
        
        $theDeparture = null;
        $theArrival = null;
        
        foreach ($data as $da){
            array_push($allDepartures, $da["departure"]);
            array_push($allArrivals, $da["arrival"]);
        }
        
        foreach ($allDepartures as $key => $depart){
            if(count(array_keys($allDepartures, $allDepartures[$key])) == 1 && !in_array($allDepartures[$key], $allArrivals)){
                $theDeparture = $depart;
            }
        }
        
        foreach ($allArrivals as $key => $arrival){
            if(count(array_keys($allArrivals, $allArrivals[$key])) == 1 && !in_array($allArrivals[$key], $allDepartures)){
                $theArrival = $arrival;
            }
        }
        return ["departure" => $theDeparture, "arrival" => $theArrival];
    }


    public function returnConsecutiveBoarding($data) {
        foreach ($data as $key=> $da){
            if($data[$key]["departure"] == $data[$key+1]["arrival"]){
                
            }
        }
        
    }
    public function returnHowManyCard($data) {
        $counterTrain = 0;
        $counterFlight = 0;
        $counterBus = 0;
        foreach ($data as $da){
            if(array_key_exists("transportationCategory", $da) && $da["transportationCategory"] == self::TRAIN){
                $counterTrain++;
            }elseif (array_key_exists("transportationCategory", $da) && $da["transportationCategory"] == self::FLIGHT) {
                $counterFlight++;
            }elseif (array_key_exists("transportationCategory", $da) && $da["transportationCategory"] == self::BUS) {
                $counterBus++;
            }
        }
        return ["train" => $counterTrain, "flight" => $counterFlight, "bus" => $counterBus];
    }
}
