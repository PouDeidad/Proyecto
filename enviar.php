<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Central</title>
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
        <div style="background-image: url('imagenes/taxi.png'); background-size: cover; position: center;" onclick="taxi()" onmousemove="imagen()">
            <h1>Taxi</h1><hr>
            <?php
                $distancia=$_POST['distancia'];
                $Tarifa_km=5;
                $Tarifa_min=15;
                $total=number_format((($distancia/1000)*$Tarifa_km), 2) +$Tarifa_min;
                
                echo "<p>total es: ".$total."</p>";
            
            ?>
        </div>
        <div style="background-image: url('imagenes/uber.png'); background-size: cover; position: center;" onclick="uber()" onmousemove="imagen()">
            <h1>Uber</h1><hr>
            <?php
                $distancia=$_POST['distancia'];
                $Tarifa_km=35.78;
                $Tarifa_min=35;
                $total=number_format((($distancia/1000)*$Tarifa_km), 2) +$Tarifa_min;
                
                echo "<p>total es: ".$total."</p>";
            ?>  
        </div>
        <div style="background-image: url('imagenes/autobus.png'); background-size: cover; position: center;" onclick="autobus()" onmousemove="imagen()">
            <h1>Autobus</h1><hr>
            <?php
                $distancia=$_POST['distancia'];
                $Tarifa_km=0;
                $Tarifa_min=10.5;
                $total=number_format((($distancia/1000)*$Tarifa_km), 2) +$Tarifa_min;
                
                echo "<p>total es: ".$total."</p>";
            ?>
        </div>
    <script>
        function taxi() {
            enviarPorPost('taxi.php');
        }
        function uber() {
            enviarPorPost('uber.php');
        }
        function autobus() {
            enviarPorPost('autobus.php');
        }

        function enviarPorPost(url) {
            // Obtener el valor de distancia desde PHP
            var distancia = <?php echo ($_POST['distancia'])?>;
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'distancia';
            input.value = distancia;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>