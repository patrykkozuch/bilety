<?php
require_once("db.php");
$db = new mysqli($host, $user, $password, $db_name);
if($db->connect_errno)
    die("Błąd połączenia z bazą danych");
function selectCities() {
    
}

?>