<?php include( 'templates/hero.php' ); ?>

<div class="ui main container">
    <h2 class="ui center aligned header m-bt-40">Twoje rezerwacje</h2>
    <div class="ui one column center aligned grid">
        <?php 
            if( $tickets = getBooked() )
            {
                $tooltip = "Anuluj rezerwację";
                foreach ( $tickets as $ticket )
                {
                    $link = 'cancel.php?id=' . $ticket['id'];
                    $names = array( $ticket['from'], $ticket['where'] );
                    $distance = $ticket['distance'];
                    $time = $ticket['time'];
                    $price = $ticket['price'];
                    
                    include( 'templates/ticket.php' );
                }
            } else echo '<p>Jeszcze nie masz, żadnych rezerwacji. Dokonaj ich przez formularz powyżej, a pojawią się tutaj!</p>';
            ?>
    </div>
</div>