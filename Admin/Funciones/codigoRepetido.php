<?php
require "conecta.php";
$con = conecta();
$codi = $_REQUEST['codigo'];

$sql = "SELECT COUNT(*) as count FROM productos WHERE codigo = '$codi' and eliminado = 0";
$stmt = mysqli_stmt_init($con);
mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$count = mysqli_fetch_assoc($result)['count'];

echo $count;
?>