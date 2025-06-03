<!DOCTYPE html>
<html lang="es">
<script src="default.js"></script>
<head>
    <meta charset="UTF-8">
    <title>Reportes Mensuales</title>
    <link href="default.css" rel="stylesheet">
    <link href="reportes.css" rel="stylesheet">
    <link rel="icon" href="imagenes/taco.ico">
    <style>
        img{
            animation: flotar 0.6s ease-in-out 
            infinite alternate; margin: 50px;
        }
        @keyframes flotar {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }
        
    </style>
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
        <div class="repo">
            <table border="1">
            <thead>
                <tr>
                <th>Fecha</th>
                <th>Costo Total</th>
                <th>Distancia Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $enlace = mysqli_connect("localhost", "root", "", "taquillo");
                $resultado = mysqli_query($enlace, "SELECT * FROM rep_men");
                while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['Mes'] . "</td>";
                echo "<td>" . $fila['CostoTotal'] . " $</td>";
                echo "<td>" . $fila['DistanciaTotal'] . " mts</td>";
                echo "</tr>";
                }
                mysqli_close($enlace);
                ?>
            </tbody>
            </table>
        </div>
</body>
</html>