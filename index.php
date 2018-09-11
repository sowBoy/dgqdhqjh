<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'DataRanger.php';
        $cardElements = [["transportationCategory" => "train", "transportationNumber" => "78A", "departure" => "Madrid", "arrival" => "Barcelona", "seatNumber" => "45B"],
            ["transportationCategory" => "flight", "transportationNumber" => "SK455", "departure" => "Gerona", "arrival" => "Stockholm", "seatNumber" => "3A", "gate" => "45B", "counter" => "344"],
            ["transportationCategory" => "flight", "transportationNumber" => "SK22", "departure" => "Stockholm", "arrival" => "New York JFK", "seatNumber" => "7B", "gate" => "22"],
            ["transportationCategory" => "bus", "transportationNumber" => "", "departure" => "Barcelona", "arrival" => "Gerona Airport", "seatNumber" => "45B"]
        ];
        $dataRange = new DataRanger();
        $arrivalAndDeparture = $dataRange->returnTheDepartureAndArrival($cardElements);
        print_r($arrivalAndDeparture);
        ?>
    </body>
</html>
