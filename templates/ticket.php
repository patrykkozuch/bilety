<div class="column ticket move-up" data-tooltip="<?php echo $tooltip; ?>" data-position="top center">
    <a href="<?php echo $link; ?>">
        <div class="ui stackable grid ticket__labels">
            <div class="seven wide middle aligned center aligned column">
                <span class="ticket__label"><?php echo $names[0] . ' - ' . $names[1]; ?></span>
            </div>
            <div class="seven wide middle aligned center aligned column">
                <div class="ui three column stackable grid">
                    <div class="six wide computer twelve wide tablet column">
                        <span class="ticket__label"><?php echo $distance . 'km'; ?></span>
                    </div>
                    <div class="five wide computer twelve wide tablet column">
                        <span class="ticket__label"><?php echo $time . 'h'; ?></span>
                    </div>
                    <div class="five wide computer twelve wide tablet column">
                        <span class="ticket__label"><?php echo $price . "zł"; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>