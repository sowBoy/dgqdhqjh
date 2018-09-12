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
    const AIRPORT = "Airport";
    const FINAL_DESTINATION = "You have arrived at your final destination."; 

    /**
     * The sorting algorithm
     *
     * @param array $data
     *
     * @return Station
     */
    public function sortData($data) {
        $sortedList = [];
        $originAndEnd = $this->returnTheOriginAndTheEndOfTravel($data);
        $travelOriginCard = $originAndEnd["travelOriginCard"];
        array_push($sortedList, $this->returnTheRightMessage($data[$travelOriginCard]));
        $midleMessages = $this->midleMessages($this->returnAllStation($data), $this->returnDepartures($data), $this->returnArrivals($data), $data);
        if(!empty($midleMessages)){
            foreach ($midleMessages as $message){
                array_push($sortedList, $message);
            }
        }
        array_push($sortedList, self::FINAL_DESTINATION);
        return $sortedList;
    }

    public function returnTheOriginAndTheEndOfTravel($data) {
        $allDepartures = $this->returnDepartures($data);
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

    public function returnDepartures($data) {
        foreach ($data as $key => $da) {
            $allDepartures[$key] = $da["departure"];
        }
        return $allDepartures;
    }
    
    public function returnAllStation($data) {
        $all = [];
        foreach ($data as $da){
            if(!in_array($da["departure"], $all)){
                array_push($all, $da["departure"]);
            }
            if(!in_array($da["arrival"], $all)){
                array_push($all, $da["arrival"]);
            }
        }
        return $all;
    }
    
    public function midleMessages(array $allStations, array $departures, array $arrivals, array $data) {
        $midleMessage = [];
        foreach ($allStations as $station){
            if(in_array($station, $departures) && in_array($station, $arrivals)){
                $key = array_search($station, $departures);
                array_push($midleMessage, $this->returnTheRightMessage($data[$key]));
            }
        }
        return $midleMessage;
    }

    public function returnTheRightMessage(array $cardData) {
        $message = " ";

        if ($cardData["transportationCategory"] == self::TRAIN) {
            $message = "Take train " . $cardData["transportationNumber"] ." from " . $cardData["departure"] . " to " . $cardData["arrival"];
            if(array_key_exists("seatNumber", $cardData) && !empty($cardData["seatNumber"])){
                $message .= ". Sit in seat " . $cardData["seatNumber"] . ".";
            } else {
                $message .= ". No seat assignment";
            }
            
        } elseif ($cardData["transportationCategory"] == self::BUS) {
            $message = "Take the ". $cardData["transportationNumber"] . " from " . $cardData["departure"] . " to " . $cardData["arrival"];
            
            if(array_key_exists("seatNumber", $cardData) && !empty($cardData["seatNumber"])){
                $message .= ". Sit in seat" . $cardData["seatNumber"] . ".";
            } else {
                $message .= ". No seat assignment.";
            }
        }elseif ($cardData["transportationCategory"] == self::FLIGHT) {
            $message = "From " .$cardData["departure"] . ", take flight " . $cardData["transportationNumber"] . " to " . $cardData["arrival"] . ". Gate " . $cardData["gate"] . ", seat " .$cardData["seatNumber"] .".";
            if(array_key_exists("counter", $cardData) && !empty($cardData["counter"])){
                $message .= " Baggage drop at ticket counter " . $cardData["counter"];
            } else {
                $message .= " Baggage will we automatically transferred from your last leg.";
            }
        }
        return $message;
    }

}
