<?php
require_once('functions.php');
$startingPoint = $_POST['startingPoint'] ?? NULL;
$endingPoint = $_POST['endingPoint'] ?? NULL;

if((!$startingPoint || !$endingPoint) || ($endingPoint == $startingPoint) && $endingPoint != NULL)
{
    if($endingPoint == $startingPoint && $endingPoint != NULL) $error = "Wybierz dwa różne miasta";
    
    if(isset($error)) echo $error;
    include('form.php');
} else {
    $coordinates = getCoordinates($_POST['startingPoint'],$_POST['endingPoint']);
    echo calculatePrice($coordinates, 0.4);
    //include('price.php');
}


?>