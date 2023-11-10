<?php
session_start();

if (isset($_SESSION["user"]) && isset($_SESSION["permisos"])) {
    $user = $_SESSION["user"];
    $permisos = $_SESSION["permisos"];
} else {
    //print_r($_SESSION);
    header('Location: /entrega1/login');
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

        /* Estilos para la nueva sección */
        .figura {
            width: 30%;
            margin: 0 auto;
            background-color: #fff;
            /* Fondo blanco */
            border: 1px solid #ccc;
            border-radius: 10px;
            /* Mayor redondez para una apariencia de tarjeta */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Sombra suave */
            text-align: center;
            padding: 20px;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            /* Ajusta el tamaño máximo de la imagen */
        }

        .button-container {
display: flex;
justify-content: center;
     /* Centra horizontalmente el contenido */
    width: 75px; /* Ancho específico del contenedor */
}

.button-link {
    padding: 10px 20px;
    background-color: #ff6600; /* Color de fondo */
    color: white; /* Texto en blanco */
    text-decoration: none; /* Sin subrayado en el enlace */
    border: none;
    border-radius: 5px; /* Redondez de los bordes */
    cursor: pointer;
    transition: background-color 0.3s; /* Transición suave al pasar el mouse */
    width: 100%; /* Ancho del botón al 100% del contenedor */
}

        .button-link:hover {
            background-color: #005599;
            /* Cambio de color al pasar el mouse */
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

        <div class="cerrar_sesion"><a href="/entrega1/login">Cerrar sesion</a></div>
    </div>
    <br><br>

    <div class="figura">
        <?php
        $id = $_GET["id"];

        //echo "ID de usuario: " . $id;
        
        try {
            $con = new PDO('mysql:dbname=fesfiguras;host=localhost;charset=utf8', 'santimn', 'root');
            $sql = 'SELECT * FROM figuras WHERE id= :id';
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            //$fields = $result->setFetchMode(PDO::FETCH_ASSOC);
        
            if ($stmt) {


                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $campos = array_keys($fila);
                    //print_r($campos);
        
                    for ($i = 0; $i < count($campos); $i++) {
                        if ($campos[$i] == "img_blob") {
                            if ($fila[$campos[$i]] == "" || $fila[$campos[$i]] === null) {
                                echo "<br>" . $campos[$i] . ": NULL";

                            } else {
                                echo '<br>' . $campos[$i] . ':<br> <img src="data:image/jpeg;base64,' . base64_encode($fila[$campos[$i]]) . 
                                '"width=100px height=100px ></td>';
                            }
                        } else {
                            echo "<br>" . $campos[$i] . ": " . $fila[$campos[$i]];
                        }
                    }
                }
            } else {
                echo "Error en la consulta: " . $conexion->errorInfo()[2];
            }



        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        ?>
    </div>
        <div class="button-container">
            <div class="button-link">
                <a href="/entrega1/dashboard">Volver</a>
            </div>
        </div>


    </body>

</html>