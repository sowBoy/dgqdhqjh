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
    public function sortData($data) {
        
    }

    public function returnTheOriginAndTheEndOfTravel($data) {
        $allDepartures = $this->returDepartures($data);
        $allArrivals = $this->returnArrivals($data);
        $travelOriginCard = null;
        $travelEndCard = null;
        
        //The origin of travel is not in the arrivals stations array
        foreach ($allDepartures as $key => $depart) {
            if (count(array_keys($allDepartures, $allDepartures[$key])) == 1 && !in_array($allDepartures[$key], $allArrivals)) {
                $travelOriginCard = $key;
            }
        }
       
        //The end of the travel is not in the departures staions array
        foreach ($allArrivals as $key => $arrival) {
            if (count(array_keys($allArrivals, $allArrivals[$key])) == 1 && !in_array($allArrivals[$key], $allDepartures)) {
                $travelEndCard = $key;
            }
        }
        return ["travelOriginCard" => $travelOriginCard, "travelEndCard" => $travelEndCard];
    }

    public function returnArrivals($data) {
        foreach ($data as $key => $da) {
            $allArrivals[$key] = $da["arrival"];
        }
        return $allArrivals;
    }

    public function returDepartures($data) {
        foreach ($data as $key => $da) {
            $allDepartures[$key] = $da["departure"];
        }
        return $allDepartures;
    }
    
    public function checkAboutStationAndReturnUtils($name, array $dataArray) {
        foreach ($dataArray as $key => $da){
            if(FALSE != strpos($name, $dataArray[$key])){
                $util = $key;
            }else{
                $util = null;
            }
        }
        return $util;
    }
    
    public function returnTheNextCard($card, $data) {
        foreach ($data as $key => $da){
            if($card == $key){
                $nextCard = $key;
            } else {
               $nextCard = null;    
            }
        }
        return $nextCard;
    }
    
    public function returnTheRight(array $cardData) {
        $message = null;
        $begin = " ";
        $midle = " ";
        $end = " "
        if($cardData["transportationCategory"] == self::TRAIN)
    }

}
