<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_connect_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($clave, $row["clave"])) {
        $_SESSION["usuario"] = $usuario;
        header("Location: home.html");
        exit();
    }
}

header("Location: login.php?mensaje=error");
exit();

$conn->close();
?>



