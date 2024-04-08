<?php
$servername = "localhost";
$username = "exyton";
$password = "exyton12345";
$dbname = "alumnos";

#Solucion al problea de la password
#use Defuse\Crypto\keyOrPassword;

#function createKey() {
#    $password = $_ENV["SECRET"]
#    return KeyOrPassword::createFromPassword($password);
#}
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
#Error TRUE mayusculas, -> correcciín "true"
    if ($conn->query($sql) === true) {
        echo "Alumno agregado correctamente";
    } else {
        echo "Error al agregar alumno: " . $conn->error;
    }
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
