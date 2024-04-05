<?php
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si se ha enviado el formulario de agregar alumno
if(isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];
    $carrera = $_POST['carrera'];

    $sql = "INSERT INTO alumnos (nombre, matricula, carrera) VALUES ('$nombre', '$matricula', '$carrera')";

    if ($conn->query($sql) === TRUE) {
        echo "Alumno agregado correctamente";
    } else {
        echo "Error al agregar alumno: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Alumno</title>
</head>
<body>
    <h2>Agregar Alumno</h2>
    <form method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="matricula">Matrícula:</label><br>
        <input type="text" id="matricula" name="matricula" required><br><br>
        <label for="carrera">Carrera:</label><br>
        <input type="text" id="carrera" name="carrera" required><br><br>
        <input type="submit" name="submit" value="Agregar Alumno">
    </form>
</body>
</html>
