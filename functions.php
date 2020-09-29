<?php
require_once("db.php");
$db = new mysqli($host, $user, $password, $db_name);
if($db->connect_errno)
    die("Błąd połączenia z bazą danych");

function selectCities() {
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

function calculatePrice($coordinates, $pricePerKM)
{
    if(!is_array($coordinates) || count($coordinates) != 2) return 0;

    $x1 = $coordinates[0]['x'];
    $x2 = $coordinates[1]['x'];
    $y1 = $coordinates[0]['y'];
    $y2 = $coordinates[1]['y'];
    

    $distance = ( ($x2 - $x1) ** 2 + ( cos( $x1 * pi() / 180 ) * ( $y2 - $y1 )) ** 2 ) ** 0.5 * 40075.704 / 360;
    $price = round($distance * $pricePerKM,2);
    return $price;
}

function getCoordinates($startingPointID, $endingPointID)
{
    global $db;

    $query = "SELECT latitude, longitude FROM cities WHERE CityID = '$startingPointID' OR CityID = '$endingPointID'";
    $coordinates = [];

    try {
        if($result = $db->query($query))
        {
            if($result->num_rows == 2)
            {
                while($row = $result->fetch_assoc())
                    $coordinates[] = array('y' => $row['latitude'], 'x' => $row['longitude']);
                return $coordinates;
            }
        } else throw new Exception;
    } catch (Exception $e)
    {
        return 0;
    }
}

?>