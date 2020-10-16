<?php include( 'templates/hero.php' ); ?>
<div class="ui main container">
    <h2 class="ui center aligned header m-bt-40">Wybierz jedną z ofert:</h2>
    <div class="ui one column grid">
        <?php 
        $names = getCitiesNames($startingPoint, $endingPoint);
        $tooltip = "Zarezerwuj ten bilet!";
        for( $i = 0; $i < 5; $i++ )
        {
            $time = date('H:i', mktime(0, round($distance/mt_rand(6, 11), 2)));
            $price = round( $distance * mt_rand() / mt_getrandmax(), 2);
            $link = 'book.php?d=' . $distance . '&t=' . $time . '&p=' . $price . '&f='. $startingPoint . '&w=' . $endingPoint;
            include( 'templates/ticket.php' ); 
        }
        ?>
    </div>
</div>
