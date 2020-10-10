<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Połączenia</title>
</head>
<body>
    <form method="POST" action="index.php">

        <!-- Pobranie listy miast z bazy -->
        <?php if( $cities = selectCities() ) : ?>

        <select name="startingPoint">

            <?php foreach ( $cities as $city ) : ?>
                <option value="<?php echo $city['CityID']; ?>"><?php echo $city['CityName']; ?></option>
            <?php endforeach; ?>

        </select>
        <select name="endingPoint">

            <?php foreach ( $cities as $city ) : ?>
                <option value="<?php echo $city['CityID']; ?>"><?php echo $city['CityName']; ?></option>
            <?php endforeach; ?>

        </select>
        
        <?php endif; ?>

        <input type="submit" value="Znajdź połączenie"/>
    </form>
</body>
</html>