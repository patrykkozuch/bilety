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
        <select name="startingPoint">
            <?php $cities = selectCities();
                foreach ($cities as $city)
                {
            ?>
                <option value="<?php echo $city['CityID']; ?>"><?php echo $city['CityName']; ?></option>
            <?php
                }
            ?>
        </select>
        <select name="endingPoint">
            <?php $cities = selectCities();
                foreach ($cities as $city)
                {
            ?>
                <option value="<?php echo $city['CityID']; ?>"><?php echo $city['CityName']; ?></option>
            <?php
                }
            ?>
        </select>
        <input type="submit" value="Znajdź połączenie"/>
    </form>
</body>
</html>