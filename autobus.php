<!DOCTYPE html>
<html lang="es">
<script language="javascript" type="text/javascript">
        var SecuenciaID=null
        var imagen=0
        var duracion=1000

        {imagenes=new CreaArray(4)
            imagenes[1].src="imagenes/poumuerto.jpg"
            imagenes[2].src="imagenes/pouguapo.jpg"
            imagenes[3].src="imagenes/poufino.jpg"
            imagenes[4].src="imagenes/poudios.jpg"
        }
        function CreaArray(n){
            this.length=n
            for(var i=1;i<=n;i++){
                this[i]=new Image()
            }
            return this
        }

        function MostrarSecuencia(){
            {
                document.images["secuencia"].src=imagenes[imagen].src
                imagen++
                if(imagen==5)
                imagen=1
            }
            SecuenciaID=setTimeout("MostrarSecuencia()", duracion)
            SecuenciaEjecutandose=true
        }

        function IniciarSecuencia(){
            imagen=1
            MostrarSecuencia()
        }
        
</script>
<script src="default.js"></script>
<head>
    <meta charset="UTF-8">
    <title>Autobus</title>
    <link href="default.css" rel="stylesheet">
    <link rel="stylesheet" href="div.css">
    <link rel="icon" href="imagenes/taco.ico">
</head>
<body onload="IniciarSecuencia()">
    <div id="buscador"></div>
    <script>
        fetch("default.html")
        .then(res => res.text())
        .then(data => {
            document.getElementById("buscador").innerHTML = data;
        });
    </script><br><center>
        <div class="apoco">
            <p>La forma para saber calcular el costo del autobus primero la tarifa mnima es de 10.5 pesos.</p>
            <img src="poumuerto.jpg" id="imagen" name="secuencia" alt="Taxi" width="300" height="200">
            <form method="POST" class="pipipi">
                <input type="hidden" name="distancia" value="<?php echo $_POST['distancia']; ?>">
                <button type="submit" name="continuar" class="boton">Continuar</button>
            </form>
        </div>
        <?php
            ini_set('display_errors', 1);

            $enlace = mysqli_connect("localhost", "root", "", "taquillo");
            $distancia = $_POST['distancia'];

            $tarifas = mysqli_query($enlace, "SELECT Camion FROM transporte LIMIT 2");
            $Tarifa_km = floatval(mysqli_fetch_row($tarifas)[0] ?? 0);
            $Tarifa_min = floatval(mysqli_fetch_row($tarifas)[0] ?? 0);

            $total = ($distancia / 1000) * $Tarifa_km + $Tarifa_min;
            $fecha = date('Y-m-d');

            if (isset($_POST['continuar'])) {
                //semanal
                $nuevoId = intval(mysqli_fetch_assoc(mysqli_query($enlace, "SELECT MAX(Id) AS id FROM rep_sem"))['id'] ?? 0) + 1;
                mysqli_query($enlace, "INSERT INTO rep_sem (Id, Fecha, Costo, Distancia, TipoTransporte) VALUES ($nuevoId, '$fecha', $total, $distancia, 'Autobus')");
                
                //tabla de reporte mensual
                $resultado = mysqli_query($enlace, "SELECT Idmen, CostoTotal, DistanciaTotal FROM rep_men WHERE mes = '$fecha'");
                if ($fila = mysqli_fetch_assoc($resultado)) {
                    $CostoTotal = number_format($total + $fila['CostoTotal'], 2, '.', '');
                    $DistanciaTotal = $distancia + $fila['DistanciaTotal'];
                    $idExistente = $fila['Idmen'];
                    mysqli_query($enlace, "UPDATE rep_men SET CostoTotal = $CostoTotal, DistanciaTotal = $DistanciaTotal WHERE Idmen = $idExistente");
                } else {
                    $maxIdQuery = mysqli_query($enlace, "SELECT MAX(Idmen) AS maxId FROM rep_men");
                    $row = mysqli_fetch_assoc($maxIdQuery);
                    $nuevoId = isset($row['maxId']) ? $row['maxId'] + 1 : 1;
                    $CostoTotal = number_format($total, 2, '.', '');
                    $DistanciaTotal = $distancia;
                    mysqli_query($enlace, "INSERT INTO rep_men (Idmen, mes, CostoTotal, DistanciaTotal) VALUES ($nuevoId, '$fecha', $CostoTotal, $DistanciaTotal)");
                }
                header("Location: index.html");
                exit();
            }
        ?>
</body>
</html>