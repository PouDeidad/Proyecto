<!DOCTYPE html>
<html lang="en">
<script src="default.js"></script>
<head>
    <meta charset="UTF-8">
    <title>Central</title>
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="enviar.css">
    <link rel="icon" href="imagenes/taco.ico">
</head>
<body>
    <div id="buscador"></div>
    <script>
        fetch("default.html")
        .then(res => res.text())
        .then(data => {
            document.getElementById("buscador").innerHTML = data;
        });
    </script><br><center>
        <div class="apoco" style="background-image: url('imagenes/taxi.png'); background-size: cover; position: center;" onclick="taxi()" onmousemove="imagen()">
            <h1>Taxi</h1><hr>
            <?php
                $distancia=$_POST['distancia'];
                $enlace = mysqli_connect("localhost", "root", "", "taquillo");
                $tarifas = mysqli_query($enlace, "SELECT Taxi FROM transporte LIMIT 2");
                $fila1 = mysqli_fetch_row($tarifas);
                $fila2 = mysqli_fetch_row($tarifas);
                $Tarifa_km = $fila1[0];
                $Tarifa_min = $fila2[0];
                $total=number_format((($distancia/1000)*$Tarifa_km), 2) +$Tarifa_min;
                
                echo "<p>Total es: ".$total."</p>";
            
            ?>
        </div>
        <div class="apoco" style="background-image: url('imagenes/uber.png'); background-size: cover; position: center;" onclick="uber()" onmousemove="imagen()">
            <h1>Uber</h1><hr>
            <?php
                $tarifas = mysqli_query($enlace, "SELECT Uber FROM transporte LIMIT 2");
                $fila1 = mysqli_fetch_row($tarifas);
                $fila2 = mysqli_fetch_row($tarifas);
                $Tarifa_km = $fila1[0];
                $Tarifa_min = $fila2[0];
                $total=number_format((($distancia/1000)*$Tarifa_km), 2) +$Tarifa_min;
                
                echo "<p>Total es: ".$total."</p>";
            ?>  
        </div>
        <div class="apoco" style="background-image: url('imagenes/autobus.png'); background-size: cover; position: center;" onclick="autobus()" onmousemove="imagen()">
            <h1>Autobus</h1><hr>
            <?php
                $tarifas = mysqli_query($enlace, "SELECT Camion FROM transporte LIMIT 2");
                $fila1 = mysqli_fetch_row($tarifas);
                $fila2 = mysqli_fetch_row($tarifas);
                $Tarifa_km = $fila1[0];
                $Tarifa_min = $fila2[0];
                $total=number_format((($distancia/1000)*$Tarifa_km), 2) +$Tarifa_min;
                
                echo "<p>Total es: ".$total."</p>";
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