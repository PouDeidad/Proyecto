<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALCULO</title>
</head>
<body>
    <?php
    $distancia=$_POST['DISTANCIA'];
    $Tarifa_km=35.78;

    $total=($distancia/1000)*$Tarifa_km;
    
    echo "total es: ".$total;
    
    ?>
</body>
</html>