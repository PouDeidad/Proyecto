<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="default.css">
</head>
<body>
    <header>
        <h1><a href="index.html" class="iman">VIAJES EL TAQUILLOS</a></h1>
        <form>
            <label for="bus">Busqueda: </label> <input type="text" id="bus" autocomplete="off">
            <button>+</button>
        </form>
    </header><br><center>
    <?php
    $dist = $_POST['distancia'];
    echo "<h1>La distancia es: $dist m</h1><br>";
    ?>
</body>
</html>