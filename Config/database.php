<?php
$servername = "localhost:3306";
$database = "login";
$username = "root";
$password = "Asd123.,";
// Crea la conexion.
$conn = mysqli_connect($servername, $username, $password, $database);
// Chequea si la conexion fue exitosa.
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Muestra "Connected successfully"; Si la conexion fue exitosa.
//mysqli_close($conn); Cierra la conexion a la base de datos.
?>