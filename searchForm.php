<div class="search-form">

    <?php if( isset($error) ) : ?>
    <div class="ui warning message">
        <div class="header">Wystąpił błąd!</div>
        <p><?php echo $error ?></p>
    </div>
    <?php endif; ?>

    <?php if( isset($_SESSION['success']) ) : ?>
    <div class="ui success message">
        <div class="header">Udało się!</div>
        <p><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    </div>
    <?php endif; ?>

    <form class="ui form" method="POST" action="index.php">
        <div class="equal width fields">
            
            <!-- Pobranie listy miast z bazy -->
            <?php if( $cities = selectCities() ) : ?>
            <div class="ui labeled input field">
                <label class="ui label">Z:</label>
                <select name="startingPoint">
                    <?php showCities($cities, ($_POST['startingPoint'] ?? $_POST['startingPoint']) ); ?>
                </select>
            </div>
                
            <div class="ui labeled input field">
                <label class="ui label">Do:</label>
                <select name="endingPoint">
                    <?php showCities($cities, ($_POST['endingPoint'] ?? $_POST['endingPoint']) ); ?>             
                </select>
            </div>

        </div>
        <?php endif; ?>
        <input class="ui button primary" type="submit" value="Znajdź połączenie"/> 
    </form>

</div>