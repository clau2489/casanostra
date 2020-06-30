<?php
ob_start();
require_once ("../conexion/db.php");
require_once ("../conexion/conexion.php");
$sql = "DELETE FROM presupuesto";
if ($conn->query($sql) === TRUE) {
	header("Location:../presupuesto.php");
} else {
	echo "Error: " . $sql . "<br>" . $conn->error; //Redireccion de la página
}
$conn->close();
ob_end_flush();
?>