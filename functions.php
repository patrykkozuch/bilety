<?php
require_once("db.php");
$db = new mysqli($host, $user, $password, $db_name);
if($db->connect_errno)
    die("Błąd połączenia z bazą danych");

function selectCities($db) {
    $query = 'SELECT CityID, CityName FROM cities;';
    try {
        if($result = $db->query($query)) {
            return $result->fetch_all(); 
        } else throw new Exception;
    } catch ( Exception $e) {
        return 0;
    }
}
$miasta  = selectCities($db);
foreach ($miasta as $i => $miasto)
    var_dump($miasto);
?>