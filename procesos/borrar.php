<?php
ob_start();
require_once ("../conexion/db.php");
require_once ("../conexion/conexion.php");
$id= $_GET['id'];
$sql = "DELETE FROM articulo WHERE id_articulo='$id'";
if ($conn->query($sql) === TRUE) {
	header("Location:../home.php");
} else {
	echo "Error: " . $sql . "<br>" . $conn->error; //Redireccion de la página
}
$conn->close();
ob_end_flush();
?>