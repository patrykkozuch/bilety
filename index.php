<?php
/*
Aplikacja prezentująca pobieranie i dodawanie danych do bazy, pierwszy projekt PHP.
Firma lotnicza - wyszukiwanie połączeń, rezerwacja biletów.
*/

//Import funkcji z pliku functions.php
require( 'functions.php' );
require( 'header.php' );

//Sprawdzenie czy zostały przesłane dane z formularza (jeśli nie, to zapisz do obu zmiennych NULL)
$startingPoint = $_POST['startingPoint'] ?? NULL;
$endingPoint = $_POST['endingPoint'] ?? NULL;

if ( !is_numeric($startingPoint) || !is_numeric($endingPoint) )
{
    $startingPoint = NULL;
    $endingPoint = NULL;
}

if ( $endingPoint == $startingPoint && $endingPoint != NULL )
    $error = "Wybierz dwa różne miasta";

//Jeżeli którekolwiek z miast nie zostało wybranie lub zostały wybrane te same miasta
if( !$startingPoint || !$endingPoint || isset($error) )
{

    //Załadowanie formularza
    include( 'search.php' );
} else {

    //Pobranie współrzędnych z bazy
    $coordinates = getCoordinates($startingPoint, $endingPoint);

    $distance = calculateDistance($coordinates);

    //Wyświetlenie ceny
    include( 'offer.php' );
}

require( 'footer.php' );

?>