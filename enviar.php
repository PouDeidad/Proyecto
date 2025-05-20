<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="enviar.css">
</head>
<body>
    <header>
        <h1><a href="index.html" class="iman">VIAJES EL TAQUILLOS</a></h1>
        <form>
            <label for="bus">Busqueda: </label> <input type="text" id="bus" autocomplete="off">
            <button>+</button>
        </form>
    </header><br><center>
        <div style="background-image: url('taxi.png'); background-size: cover; position: center;" onclick="taxi()" onmousemove="imagen()">
            <h1>Taxi</h1><hr>
            <?php
                $distancia=$_POST['distancia'];
                $Tarifa_km=3.6;
                $Tarifa_min=15;
                $total=(($distancia/1000)*$Tarifa_km)+$Tarifa_min;
                
                echo "<p>total es: ".$total."</p>";
            
            ?>
        </div>
        <div style="background-image: url('uber.png'); background-size: cover; position: center;" onclick="uber()" onmousemove="imagen()">
            <h1>Uber</h1><hr>
            <?php
                $distancia=$_POST['distancia'];
                $Tarifa_km=35.78;

                $total=($distancia/1000)*$Tarifa_km;
                
                echo "<p>total es: ".$total."</p>";
            
            ?>
        </div>
        <div style="background-image: url('autobus.png'); background-size: cover; position: center;" onclick="autobus()" onmousemove="imagen()">
            <h1>Autobus</h1><hr>
            <?php
                $distancia=$_POST['distancia'];
                echo "<p>total es: 11</p>";
            
            ?>
        </div>
    <script>
        function taxi(){
            location.href="taxi.html";
        }
        function uber(){
            location.href="uber.html";
        }
        function autobus(){
            location.href="autobus.html";
        }
        function imagen(){
            
        }
    </script>
</body>
</html>