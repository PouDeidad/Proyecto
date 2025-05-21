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
<head>
    <meta charset="UTF-8">
    <title>INICIO</title>
    <link href="default.css" rel="stylesheet">
    <link rel="stylesheet" href="div.css">
</head>
<body onload="IniciarSecuencia()">
    <header>
        <h1><a href="index.html" class="iman">VIAJES EL TAQUILLOS</a></h1>
        <form>
            <label for="bus">Busqueda: </label> <input type="text" id="bus" autocomplete="off">
            <button>+</button>
        </form>
    </header><br><center>
        <div>
            <img src="imagenes/poumuerto.jpg" id="imagen" name="secuencia" alt="Taxi" width="300" height="200">
            <form method="POST" class="for">
                <input type="hidden" name="distancia" value="<?php echo $_POST['distancia']; ?>">
                <button type="submit" name="continuar" class="boton">Continuar</button>
            </form>
        </div>
    <?php
        $enlace = mysqli_connect("localhost", "root", "", "taquillo");
        $distancia = $_POST['distancia'];
        
        $tarifas = mysqli_query($enlace, "SELECT uber FROM transporte LIMIT 2");
        $fila1 = mysqli_fetch_row($tarifas);
        $fila2 = mysqli_fetch_row($tarifas);
        $Tarifa_km = $fila1[0];
        $Tarifa_min = $fila2[0];
        $total=($distancia/1000)*$Tarifa_km+$Tarifa_min;
        $fecha = date('y-m-d');
        // Verificar si ya existe un registro para el mes actual
        $siono = "SELECT CostoTotal, DistanciaTotal FROM rep_men WHERE mes = '$fecha'";
        $resultado = mysqli_query($enlace, $siono);
        
        if (isset($_POST['continuar'])) {
            mysqli_query($enlace, "INSERT INTO rep_sem (Fecha, Costo, Distancia, TipoTransporte) VALUES ('$fecha', '$total', '$distancia', 'Uber')");
            
            if ($fila = mysqli_fetch_assoc($resultado)) {
            // Ya existe, actualizamos los totales
            $CostoTotal = number_format(($total + $fila['CostoTotal']), 2);
            $DistanciaTotal = $distancia + $fila['DistanciaTotal'];

            $update = "UPDATE rep_men 
                    SET CostoTotal = $CostoTotal, DistanciaTotal = $DistanciaTotal 
                    WHERE mes = '$fecha'";
            mysqli_query($enlace, $update);
        } else {
            // No existe, insertamos un nuevo registro
            $CostoTotal = number_format($total, 2);
            $DistanciaTotal = $distancia;

            $insert = "INSERT INTO rep_men (mes, CostoTotal, DistanciaTotal) 
                    VALUES ('$fecha', $CostoTotal, $DistanciaTotal)";
            mysqli_query($enlace, $insert);
        }
            mysqli_close($enlace);
            header("Location: index.html");
        }
    ?>
</body>
</html>