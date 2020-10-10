<?php
//Pobranie danych logowania do bazy z pliku db.php
require_once("db.php");

//Utworzenie połączenia do bazy dancyh
$db = new mysqli($server, $user, $password, $db_name);

if($db->connect_errno)
    die("Błąd połączenia z bazą danych");


/* 
    Pobranie listy miast z bazy
*/
function selectCities() {
    //Użycie zdefiniowanego wcześniej połączenia z bazą
    global $db;

    $query = 'SELECT CityID, CityName FROM cities ORDER BY CityName ASC';
    $cities = [];

    try {
        if($result = $db->query($query)) {
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $cities[] = array('CityID' => $row['CityID'], 'CityName' => $row['CityName']);
                }
                return $cities;
            }
        } else throw new Exception;
    } catch ( Exception $e) {
        return 0;
    }
}


/*
    Obliczanie ceny na podstawie tablicy wspołrzednych wygenerowanej przy użyciu funkcji getCoordinates
*/
function calculatePrice($coordinates, $pricePerKM)
{
    //Sprawdzenie poprawności danych wejściowych
    if(!is_array($coordinates) || count($coordinates) != 2) return 0;

    $x1 = $coordinates[0]['x'];
    $x2 = $coordinates[1]['x'];
    $y1 = $coordinates[0]['y'];
    $y2 = $coordinates[1]['y'];
    

    $distance = ( ($x2 - $x1) ** 2 + ( cos( $x1 * pi() / 180 ) * ( $y2 - $y1 )) ** 2 ) ** 0.5 * 40075.704 / 360;
    $price = round($distance * $pricePerKM,2);
    return $price;
}

/*
    Pobranie współrzednych dwóch wybranych miast z bazy
*/
function getCoordinates($startingPointID, $endingPointID)
{
    //Użycie wcześniej zdefiniowanego połączenia z bazą
    global $db;

    $query = "SELECT latitude, longitude FROM cities WHERE CityID = '$startingPointID' OR CityID = '$endingPointID'";
    $coordinates = [];

    try {
        if($result = $db->query($query))
        {
            if($result->num_rows == 2)
            {
                while($row = $result->fetch_assoc())
                    $coordinates[] = array('x' => $row['longitude'], 'y' => $row['latitude']);
                return $coordinates;
            }
        } else throw new Exception;
    } catch (Exception $e)
    {
        return 0;
    }
}

?>