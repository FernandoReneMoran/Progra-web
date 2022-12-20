<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="estilos/carrito01.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>
            function comprar(id,idCarrito){
                if(id){
                    quanty = $('#quantity' + id).val();
                    subtotal = $('#subtotal' + id).val();
                    $.ajax({
                        url : 'funciones/comprar.php',
                        type : 'post',
                        dataType : 'text',
                        data : 'id='+id+'&idCarrito='+idCarrito,
                        success : function(res){
                            alert("Compra realizada con exito");
                            window.location.href = 'index.php';
                        },error: function(){
                            alert('Error datos no encontrados...');
                        }
                    });
                }else{
                }
            }
        </script>
    <head>
<?php
include 'navBar.php';
require "funciones/conecta.php";
$con = conecta();
error_reporting(E_ERROR | E_PARSE);
$idC = $_SESSION['idC'];
$correo = $_SESSION['correoC'];
if($idC == ''){
    header("Location: login.php");
}
$sql = "SELECT id FROM pedidos
WHERE usuario = '$correo'";
$idPedido = $con->query($sql);

while($row = $idPedido->fetch_array()){
    $idCarrito     =$row["id"];
}
$sql = "SELECT COUNT(*) as count FROM pedidos_productos WHERE id_pedido = '$idCarrito'";
$stmt = mysqli_stmt_init($con);
mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$count = mysqli_fetch_assoc($result)['count'];
echo $count;
if($count <=0){
    header("Location: login.php");

}

$sql = "SELECT * FROM pedidos_productos
WHERE id_pedido = '$idCarrito'";

$carrito = $con->query($sql);

echo "<div class =\"tabla-completa\">";
echo "<p>Parte 2 de 2</p>";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Producto</p>";
echo "<p class =\"titulo-n\">Cantidad</p>";
echo "<p class =\"titulo-n\">Costo Unitario</p>";
echo "<p class =\"titulo-n\">Subtotal</p>";
echo "<p class =\"titulo-final\">Eliminar Producto</p>";
echo "</div>";

while($row = $carrito->fetch_array()){
    
    $id     =$row["id_producto"];
    $quan     =$row["cantidad"];
    $precio     =$row["precio"];
    $subtotal = $quan * $precio;
    echo "<div id = \"contenedor-fila{$id}\" class =\"contenedor-fila\">";
    echo "<p class =\"dato-n\">$id</p>";
    echo "<p id = \"cantidad$id\" class =\"dato-n\">$quan</p>";
    echo "<p id = \"precio$id\" class =\"dato-n\">$precio</p>";
    echo "<p id = \"subtotal$id\" class =\"dato-n\">$subtotal</p>";
    echo  "<button class =\"boton\">";
    echo  "<a class =\"dato-final\"></a>";
    echo "</button>";
    echo "</div>";
    $total += $subtotal;
}
echo "<div id = \"contenedor-fila\" class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Total</p>";
echo "<p class =\"dato-n\"></p>";
echo "<p class =\"dato-n\"></p>";
echo "<p id = \"total\" class =\"dato-n\">$total</p>";
echo "<p class =\"boton\"></p>";
echo "</div>";
echo "</div>";
echo  "<button class =\"botonContinuar\">";
echo  "<a class =\"dato-final\" href=\"javascript:void(0);\" onClick=\"comprar($id,$idCarrito);\">Finalizar</a>";
echo "</button>";
include 'footer.php';
?>