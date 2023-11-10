<?php
session_start();
include('funciones.php');


if (isset($_SESSION["user"]) && isset($_SESSION["permisos"])) {

    $user = $_SESSION["user"];
    $permisos = $_SESSION["permisos"];
} else {
    //print_r($_SESSION);
    header('Location: login');
}

function mostrarProductos()
{
    try {
        $con = new PDO('mysql:dbname=fesfiguras;host=localhost;charset=utf8', 'santimn', 'root');
        $sql = 'SELECT * FROM figuras';

        crearTablaQuery($con, "LISTA DE FIGURAS", $sql, "figuras", array(0, 1, 2, 3, 4, 5, 6), "blue", "red");

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

?>
<html>

<head>
    <style>
        /* Fondo del body */
        body {
            background-color: burlywood;
            /* Un color de fondo claro */
        }

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

        /* Estilos para la tabla */
        .tabla table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla th,
        .tabla td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .tabla th {
            background-color: #ff6600;
            /* Fondo naranja en las celdas de encabezado */
            color: white;
            font-weight: bold;
            /* Texto en negrita en las celdas de encabezado */
        }

        .tabla td:last-child a {
            color: #0077cc;
            /* Color azul para los enlaces en la última columna */
            text-decoration: none;
        }

        /* Estilos para el formulario y el botón "Agregar" (si es para administradores) */



        .info {
            display: flex;
            flex-direction: row;
            justify-content: space-around;

        }

        .foto {
            padding: 20px;
            text-align: center;
        }

        .foto img {
            width: 100%;
            height: 100%;
        }

        form {
            margin-top: 20px; /* Agregar un margen superior para separar el formulario del contenido anterior */
            text-align: center; /* Centrar el formulario en la página */
        }

        input[type="submit"] {
            background-color: #ff6600;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        
    </style>
</head>

<body>

    <div class="barra_info">
        <div class="usuario">
            Bienvenido
            <?php
            echo $user;
            echo "<br>Rango: " . $permisos . "<br>";
            ?>
        </div>

        <div class="cerrar_sesion">
            <a href="login">Cerrar sesion</a>
        </div>
    </div>


    <div class="info">
        <div class="tabla">
            <?php
            mostrarProductos();
            ?>
        </div>
        <div class="foto">
            <img src="" alt="Haga click en un enlace para ver la imagen">
        </div>
    </div>

    <!-- Mover el formulario al final de la página, fuera del div .info -->
    <form action="agregar" method="POST">
        <?php
        if ($_SESSION['permisos'] == "admin") {
            echo "<input type=\"submit\" name=\"agregarProd\" value=\"Agregar\"/><br>";
        }
        ?>
    </form>
    <a id="enlaceDescarga" style="display: none;" download></a>

    <script>

        botones = document.getElementsByClassName("enlace");
        botonesVer = document.getElementsByClassName("ver");

        for (i = 0; i < botones.length; i++) {
            botones[i].addEventListener("click", mostrarImg);
            botones[i].addEventListener("click", descargarImg);
        }
        for (i = 0; i < botonesVer.length; i++) {
            botonesVer[i].addEventListener("click", mostrarFigura);
        }

        function mostrarImg(e) {
            console.log(e.currentTarget);

            foto = document.getElementsByClassName("foto")[0].getElementsByTagName("img")[0];
            foto.src = "img/" + e.currentTarget.textContent;
            console.log("Texto " + e.currentTarget.textContent);
        }

        function descargarImg(e){
            var urlImagen ="img/"+ e.currentTarget.textContent; 

            var enlaceDescarga = document.getElementById('enlaceDescarga');

            enlaceDescarga.href = urlImagen;
            enlaceDescarga.download = e.currentTarget.textContent; 
            enlaceDescarga.click();
        }

    </script>
</body>

</html>