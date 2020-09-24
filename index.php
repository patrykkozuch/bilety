<?php
//require_once('functions.php');

if(!isset($_POST['startingPoint']) || !isset($_POST['endingPoint']))
{
    include('form.php');
} else {
    $pricePerKM = 25;
    $startingPoint = explode(' ',$_POST['startingPoint']);
    $endingPoint = explode(' ',$_POST['endingPoint']);

    $x1 = $startingPoint[0]; $y1 = $startingPoint[1];
    $x2 = $endingPoint[0]; $y2 = $endingPoint[1];

    $distance = ( ($x2 - $x1) ** 2 + ( cos( $x1 * pi() / 180 ) * ( $y2 - $y1 )) ** 2 ) ** 0.5 * 40075.704 / 360;
    $price = $distance * $pricePerKM;

    include('price.php');
}


?>