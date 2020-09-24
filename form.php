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
        <input type="text" name="Tekst" id="">
        <select name="startingPoint">
            <option value="54.366667 18.633333">Gdańsk</option>
            <option value="54.466667 17.016667">Słupsk</option>
        </select>
        <select name="endingPoint">
            <option value="54.366667 18.633333">Gdańsk</option>
            <option value="54.466667 17.016667">Słupsk</option>
        </select>
        <input type="submit" value="Znajdź połączenie"/>
    </form>
</body>
</html>