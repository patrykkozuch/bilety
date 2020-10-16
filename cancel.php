<?php
    require_once( 'functions.php' );

    if( !isset( $_GET['id'] ) )
        header( 'Location: index.php' );

    $id = $_GET['id'];

    if( !is_numeric($id) )
        header( 'Location: index.php' );

    $query = "DELETE FROM tickets WHERE ticketID = $id";

    if( $db->query($query) )
    {
        $_SESSION['success'] = "Twój bilet został anulowany.";
        header('Location: index.php');
    }
?>