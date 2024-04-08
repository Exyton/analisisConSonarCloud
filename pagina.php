<?php
$servername = "localhost";
$username = "exyton";
$password = getenv('MYSQL_PASSWORD');
$dbname = "alumnos";

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

    // Sentencia preparada para evitar inyección SQL
    $sql = "INSERT INTO alumnos (nombre, matricula, carrera) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $matricula, $carrera);

    if ($stmt->execute()) {
        $mensaje = "Alumno agregado correctamente";
    } else {
        $mensaje = "Error al agregar alumno: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agregar Alumno</title>
</head>
<body>
    <h2>Agregar Alumno</h2>
    <?php if(isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
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
