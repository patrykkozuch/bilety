<?php
/*
Aplikacja prezentująca pobieranie i dodawanie danych do bazy, pierwszy projekt PHP.
Firma lotnicza - wyszukiwanie połączeń, rezerwacja biletów.
*/

//Import funkcji z pliku functions.php
require_once( 'functions.php' );

//Sprawdzenie czy zostały przesłane dane z formularza (jeśli nie, to zapisz do obu zmiennych NULL)
$startingPoint = $_POST['startingPoint'] ?? NULL;
$endingPoint = $_POST['endingPoint'] ?? NULL;

//Jeżeli którekolwiek z miast nie zostało wybranie lub zostały wybrane te same miasta
if( ( !$startingPoint || !$endingPoint ) || ( $endingPoint == $startingPoint && $endingPoint != NULL ) )
{
    //Jeżeli zostały wybrane te same miasta
    if( $endingPoint == $startingPoint && $endingPoint != NULL ) $error = "Wybierz dwa różne miasta";
    
    if( isset($error) ) echo $error;

    //Załadowanie formularza
    include('form.php');
} else {

    //Pobranie współrzędnych z bazy
    $coordinates = getCoordinates($_POST['startingPoint'],$_POST['endingPoint']);

    //Wyświetlenie ceny
    echo calculatePrice($coordinates, 0.4);
    //include('price.php');
}


?>