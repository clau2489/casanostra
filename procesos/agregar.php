<?php
ob_start();
require_once ("../conexion/db.php");
require_once ("../conexion/conexion.php");
$dato_uno = $_POST["dato_uno"];
$dato_dos = $_POST["dato_dos"];
$dato_tres = $_POST["dato_tres"];
$dato_cuatro = $_POST["dato_cuatro"];
$dato_cinco = $_POST["dato_cinco"];
$dato_seis = $_POST["dato_seis"]; 
$sql = "INSERT INTO articulo (codigo, descripcion, preciodecompra, porcentaje, ganancia, preciofinal) VALUES ('$dato_uno', '$dato_dos', '$dato_tres', '$dato_cuatro', '$dato_cinco', '$dato_seis')";
if ($conn->query($sql) === TRUE) {
	header("Location:../home.php");
} else {
	echo "Error: " . $sql . "<br>" . $conn->error; //Redireccion de la página
}
$conn->close();
ob_end_flush();
?>