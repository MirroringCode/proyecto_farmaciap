<?php
session_start();
if (empty($_SESSION['active'])) {
    header('Location: ../index.php'); // Redirige al inicio de sesión
    exit();
}
require("../conexion.php");
$id_user = $_SESSION['idUser'];
$permiso = "clientes";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM cliente WHERE idcliente = $id");
    mysqli_close($conexion);
    header("Location: clientes.php");
}
