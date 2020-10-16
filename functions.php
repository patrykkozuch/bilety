<?php
session_start();

//  Pobranie danych logowania do bazy z pliku db.php
require_once("db.php");

//  Utworzenie połączenia do bazy dancyh
$db = new mysqli($server, $user, $password, $db_name);

if( $db->connect_errno )
    die("Błąd połączenia z bazą danych");


/* 
    Pobranie listy miast z bazy
*/
function selectCities() {
    //  Użycie zdefiniowanego wcześniej połączenia z bazą
    global $db;
    
    $query = 'SELECT CityID, CityName FROM cities ORDER BY CityName ASC';
    $cities = [];
    
    try {
        if ( $result = $db->query($query) ) {
            if ( $result->num_rows > 0 )
            {
                while( $row = $result->fetch_assoc() )
                {
                    $cities[] = array('CityID' => $row['CityID'], 'CityName' => $row['CityName']);
                }
                return $cities;
            }
        } else throw new Exception;
    } catch ( Exception $e ) {
        return 0;
    }
}

/*
    Funkcja generująca listę opcji dla selecta w formularzu na podstawie danych wygenerowanych przez funkcję selectCities()
*/
function showCities($cities, $selected = '') {
    foreach ( $cities as $city ) {
        echo '<option value="' . $city['CityID'] . '"' . (($selected == $city['CityID']) ? ' selected ' : '') . '>' . $city['CityName'] . '</option>';
    }
}

/*
    Funkcja pobierająca z bazy nazwy miast
*/
function getCitiesNames( $startingPointID, $endingPointID ) {
    //  Użycie wcześniej zdefiniowanego połączenia z bazą
    global $db;

    $query = "SELECT CityName FROM cities WHERE CityID = '$startingPointID' OR CityID = '$endingPointID'";
    $names = [];

    try {
        if( $result = $db->query($query) )
        {
            if( $result->num_rows == 2 )
            {
                while( $row = $result->fetch_assoc() )
                {
                    $names[] = $row['CityName'];
                }

                return $names;
            } else throw new Exception;
        } else throw new Exception;
    } catch ( Exception $e ) {
        return 0;
    }
}

/*
    Pobranie współrzednych dwóch wybranych miast z bazy
*/
function getCoordinates( $startingPointID, $endingPointID )
{
    //  Użycie wcześniej zdefiniowanego połączenia z bazą
    global $db;

    $query = "SELECT latitude, longitude FROM cities WHERE CityID = '$startingPointID' OR CityID = '$endingPointID'";
    $coordinates = [];

    try {
        if( $result = $db->query($query) )
        {
            if( $result->num_rows == 2 )
            {
                while( $row = $result->fetch_assoc() )
                    $coordinates[] = array('x' => $row['longitude'], 'y' => $row['latitude']);
                return $coordinates;
            }
        } else throw new Exception;
    } catch ( Exception $e )
    {
        return 0;
    }
}

/*
    Obliczanie odległości na podstawie tablicy wspołrzednych wygenerowanej przy użyciu funkcji getCoordinates
*/
function calculateDistance( $coordinates )
{
    //  Sprawdzenie poprawności danych wejściowych
    if ( !is_array($coordinates) || count($coordinates) != 2 ) return 0;

    $x1 = $coordinates[0]['x'];
    $x2 = $coordinates[1]['x'];
    $y1 = $coordinates[0]['y'];
    $y2 = $coordinates[1]['y'];
    

    $distance = ( ($x2 - $x1) ** 2 + ( cos( $x1 * pi() / 180 ) * ( $y2 - $y1 )) ** 2 ) ** 0.5 * 40075.704 / 360;
    return round($distance,2);
}


function getBooked() {

    //  Użycie wcześniej zdefiniowanego połączenia z bazą
    global $db;

    //  Pobranie dancyh z bazy
    //  queryFrom pobiera wszystkie informacje odnośnie biletu oraz nazwę miasta wylotu
    //  queryWhere pobiera nazwę miasta przylotu
    //  końcowa query łączy obie tabele razem
    $queryFrom = "SELECT B.ticketID, B.distance, B.time, B.price, cityName as cityFrom FROM cities as A, tickets as B WHERE B.cityFrom = A.CityID";
    $queryWhere = "SELECT cityName as cityWhere, B.ticketID FROM cities as A, tickets as B WHERE B.cityWhere = A.CityID";
    $query = "SELECT C.*, cityWhere FROM ($queryFrom) AS C LEFT JOIN ($queryWhere) AS D ON C.ticketID = D.ticketID";

    $tickets = [];
    
    try {
        if( $result = $db->query($query) )
        {
            if( $result->num_rows > 0 )
            {
                while( $row = $result->fetch_assoc() )
                {
                    $tickets[] = array(
                        'id' => $row['ticketID'], 
                        'from' => $row['cityFrom'], 
                        'where' => $row['cityWhere'], 
                        'distance' => $row['distance'], 
                        'time' => $row['time'], 
                        'price' => $row['price']
                    );
                }
                return $tickets;
            }
        }
    } catch ( Exception $e ) {
        return 0;
    }
}
?>