<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $clave = $_POST["clave"];

    $hashed_password = password_hash($clave, PASSWORD_DEFAULT);

    $db = new mysqli('localhost', 'root', '', 'health_connect_db');

    if ($db->connect_error) {
        die("Error en la conexión a la base de datos: " . $db->connect_error);
    }

    $sentencia = $db->prepare("insert into usuarios(nombre,usuario,clave) values (?,?,?);");
    $resultado = $sentencia->execute([$nombre, $usuario, $hashed_password]);    

    if ($resultado === TRUE){
        //echo "OK";
        header ('Location: registrar.php?mensaje=registrado');
    }
    else{
        //echo "NOO"; 
        header ('Location: registrar.php?mensaje=error');
        exit();
    }
}

