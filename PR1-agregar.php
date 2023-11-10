<?php
session_start();

$list_animes = array("ONE PIECE", "BLEACH", "NANATSU NO TAIZAI", "SWORD ART ONLINE", "FATE");
$list_tamaño = array("XL", "grande", "mediano", "pequeño");

//$_SESSION["nombreVacioError"] = false;
//$_SESSION["precioNanError"] = false;
if (isset($_SESSION["user"]) && isset($_SESSION["permisos"])) {

    $user = $_SESSION["user"];
    $permisos = $_SESSION["permisos"];
} else {
    //print_r($_SESSION);
    header('Location: login');
}
?>

<html>

<head>
    <script>

        function comprobarDatos() {
            var nombre = document.forms["campos"]["nombre"].value;
            var anime = document.forms["campos"]["anime"].value;
            var tam = document.forms["campos"]["tam"].value;
            var precio = document.forms["campos"]["precio"].value;

            console.log(nombre + ", " + anime + ", " + tam + ", " + precio)
            $mensaje = "";

            if (isNaN(precio)) {

                if (isNaN(precio)) {
                    $mensaje += "El precio no es numérico\n"
                    alert($mensaje);
                }
                return false;

            } else if (precio <= 0) {
                $mensaje += "El precio no puede ser negativo o 0";
                alert($mensaje);
                return false;
            } else {
                numero = precio.parseFloat();
                numeroRedondeado = numero.toFixed(2);
                document.forms["campos"]["precio"].value = numeroRedondeado;
            }

        }
    </script>
    <style>
        /* Estilos para la barra de información */
        .barra_info {
            background-color: #ff6600;
            /* Un fondo naranja */
            color: white;
            /* Texto en blanco */
            padding: 10px;
            border-bottom: 2px solid #e35300;
            /* Un tono más oscuro de naranja para el borde inferior */
            font-family: 'Arial', sans-serif;
            /* Cambiar la fuente a algo legible */
            display: flex;
            justify-content: space-between;
        }

        .cerrar_sesion a {
            color: white;
            /* Cambiar el color del enlace a un tono más oscuro de naranja */
            text-decoration: none;
            /* Eliminar subrayado en el enlace */
        }
        .cuerpo {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: burlywood;
            column-gap: 40px;
        }

        /* Estilos para el formulario */
        .formulario {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
        }

        .formulario h1 {
            color: #ff6600;
            font-size: 24px;
        }

        .formulario input[type="text"],
        .formulario input[type="file"],
        .formulario select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .formulario input[type="submit"] {
            background-color: #ff6600;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
        }

        /* Estilos para el enlace "Cancelar y volver" */
        .cancelar {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #0077cc;
            font-weight: bold;
        }

        /* Estilos para la imagen */
        #foto {
            width: 300px;
            height: 350px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="barra_info">
        Bienvenido
        <?php
        echo $user;
        echo "<br>Rango: " . $permisos . "<br>";


        ?>

        <div class="cerrar_sesion"><a href="login">Cerrar sesion</a></div>
    </div>

    <div class="cuerpo">

        <form class="formulario" enctype="multipart/form-data" name="campos" onsubmit="return comprobarDatos()"
            action="PR1-validar-figura.php" method="POST">
            <h1>CREAR FIGURA</h1><br><br>
            Nombre de figura: <input type="text" name="nombre" required><br><br>
            Anime: <select name="anime">
                <?php
                foreach ($list_animes as $a) {
                    echo "<option value='$a'>$a</option>";
                }
                ?>
            </select><br><br>

            Tamaño:
            <select name="tam">
                <?php
                foreach ($list_tamaño as $t) {
                    echo "<option value='$t'>$t</option>";
                }
                ?>
            </select><br><br>
            Precio: <input type="text" name="precio" required><br><br>

            <input id="imagen" type="file" name="img" accept="image/*"><br><br>

            <input type="submit" name="agregar" value="Agregar">
            <a href="dashboard" class="cancelar">Cancelar y volver</a>

        </form>

        <div><img id="foto" width="300px" height="350px" alt="Vista previa de la imagen"/></div>
    </div>

    <script>

        document.getElementById('imagen').onchange = function () {
            var reader = new FileReader(); //instanciamos el objeto de laapiFileReader
            reader.onload = function (e) {
                document.getElementById("foto").src = e.target.result;
            };
            // carga el contenido del fichero imagen.
            reader.readAsDataURL(this.files[0]);
        };
    </script>

</body>

</html>