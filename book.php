<?php
    require_once( 'functions.php' );
    
    if( !isset( $_GET['d'] ) && !isset( $_GET['t'] ) || !isset( $_GET['p'] ) || !isset( $_GET['f'] ) || !isset( $_GET['w'] ) )
        header( 'Location: index.php' );

    $from = $_GET['f'];
    $where = $_GET['w'];
    $distance = $_GET['d'];
    $time = $_GET['t'];
    $price = $_GET['p'];

    if( !is_numeric($from) || !is_numeric($where) || !is_numeric($distance) || !is_numeric($price) )
        header( 'Location: index.php' );

    $time = htmlspecialchars( $_GET["t"], ENT_QUOTES );

    $query = "INSERT INTO tickets VALUES (NULL, '$from', '$where', $distance, '$time', $price)";

    if( $db->query($query) )
    {
        $_SESSION['success'] = "Twój bilet został zarezerwowany, możesz go zobaczyć poniżej";
        header( 'Location: index.php' );
    }
?>