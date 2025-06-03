<!DOCTYPE html>
<html lang="es">
    <script src="default.js"></script>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="default.css" rel="stylesheet">
    <link rel="stylesheet" href="reportes.css">
    <style>
        select {
            padding: 5px;
            margin: 0 20px;
        }
    </style>
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
        <style>
        </style>
        <div class="repo">
        <?php
        $cn = mysqli_connect("localhost", "root", "", "taquillo");

        //Actualizar
        if (isset($_POST['update'], $_POST['campo'], $_POST['valor'], $_POST['id'])) {
            $id = (int)$_POST['id'];
            $campo = $_POST['campo'];
            $valor = $_POST['valor'];

            $r = mysqli_fetch_assoc(mysqli_query($cn, "SELECT * FROM rep_sem WHERE Id=$id"));
            $m = mysqli_fetch_assoc(mysqli_query($cn, "SELECT * FROM rep_men WHERE IdMen=1"));

            if ($r && $m) {
                if ($campo == 'Costo' || $campo == 'Distancia') {
                    $viejo = $r[$campo];
                    $nuevo = floatval($valor);
                    $total = $m[$campo.'Total'] - $viejo + $nuevo;
                    mysqli_query($cn, "UPDATE rep_men SET {$campo}Total=$total WHERE IdMen=1");
                }

                mysqli_query($cn, "UPDATE rep_sem SET $campo='$valor' WHERE Id=$id");
            }
        }

        //borrar
        if (isset($_POST['delete'], $_POST['id'])) {
            $id = (int)$_POST['id'];
            $r = mysqli_fetch_assoc(mysqli_query($cn, "SELECT * FROM rep_sem WHERE Id=$id"));
            $m = mysqli_fetch_assoc(mysqli_query($cn, "SELECT * FROM rep_men WHERE IdMen=1"));

            if ($r && $m) {
                $ct = $m['CostoTotal'] - $r['Costo'];
                $dt = $m['DistanciaTotal'] - $r['Distancia'];
                mysqli_query($cn, "DELETE FROM rep_sem WHERE Id=$id");
                mysqli_query($cn, "UPDATE rep_men SET CostoTotal=$ct, DistanciaTotal=$dt WHERE IdMen=1");
            }
        }

        //tabla
        $res = mysqli_query($cn, "SELECT * FROM rep_sem");
        echo "<table border=1 cellpadding='5'><tr>
        <th>Id</th><th>Fecha</th><th>Costo</th><th>Distancia</th><th>Tipo</th><th>Acción</th>
        </tr>";

        while ($f = mysqli_fetch_assoc($res)) {
            echo "<tr>
                <td>{$f['Id']}</td>
                <td>{$f['Fecha']}</td>
                <td>{$f['Costo']}</td>
                <td>{$f['Distancia']}</td>
                <td>{$f['TipoTransporte']}</td>
                <td style='width: 40%;'>
                    <form method='post' style='display:inline'>
                        <input type='hidden' name='id' value='{$f['Id']}'>
                        <select name='campo' onchange='this.form.submit()'>
                            <option selected disabled>Editar</option>
                            <option value='Fecha'>Fecha</option>
                            <option value='Costo'>Costo</option>
                            <option value='Distancia'>Distancia</option>
                            <option value='TipoTransporte'>Tipo</option>
                        </select>
                    </form>";

            if (isset($_POST['campo']) && $_POST['id'] == $f['Id']) {
                echo "<form method='post' style='display:inline'>
                    <input type='hidden' name='id' value='{$f['Id']}'>
                    <input type='hidden' name='campo' value='{$_POST['campo']}'>";

                if ($_POST['campo'] == 'Fecha') {
                    echo "<input type='date' name='valor'>";
                } elseif ($_POST['campo'] == 'TipoTransporte') {
                    echo "<select name='valor'>
                            <option>Uber</option>
                            <option>Taxi</option>
                            <option>Autobus</option>
                        </select>";
                } else {
                    echo "<input name='valor' style='border: 3px solid rgb(54, 0, 124);'>";
                }

                echo "<button name='update' style='float:right'>Actualizar</button></form>";
            }

            echo "<form method='post' style='float:right'>
                <input type='hidden' name='id' value='{$f['Id']}'>
                <button name='delete' onclick='return confirm(\"¿Eliminar?\")'>Borrar</button>
            </form></td></tr>";
        }
        echo "</table>";
        ?>
        </div>
</body>
</html>
