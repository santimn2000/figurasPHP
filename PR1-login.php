<?php

session_start();
session_destroy();

?>

<html>

<head>
    <style>
        /* Estilo del formulario de inicio de sesión */
        body {
            background-color: burlywood;
            /* Color de fondo claro */
            font-family: 'Arial', sans-serif;
            /* Fuente legible */
        }

        h1 {
            text-align: center;
            color: #ff6600;
            /* Color de encabezado naranja */
        }

        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        span {
            color: red;
        }

        p {
            color: red;
        }

        input[type="submit"] {
            background-color: #ff6600;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>LOGIN DE USUARIOS</h1>

    <form action="PR1-validar-usuario.php" method="POST">
        Usuario: <input type="text" name="user" />
        <?php
        if (isset($_SESSION['userError'])) {
            if ($_SESSION['userError'] == true) {
                echo "<span color=red>Usuario no válido</span>";
            }
        }
        ?>
        <br>
        <br>
        Contraseña: <input type="password" name="passwd" />
        <?php
        if (isset($_SESSION['passwdError'])) {
            if ($_SESSION['passwdError'] == true) {
                echo "<span color=red>Contraseña no valida</span>";
            }
        }
        ?>
        <br>

        <?php
        if (isset($_SESSION['loginError'])) {
            if ($_SESSION['loginError'] == true) {
                echo "<p style=\"color:red\">Usuario y contraseña no coinciden</p> <br>";
            }
        }
        ?>
        <input type="submit" name="enviar" value="Enviar" />
    </form>
</body>

</html>