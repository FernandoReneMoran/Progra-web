<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="estilos/carrito01.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script>
        function cambiar(id,quan,idCarrito,precio){
          if(id){
            quanty = $('#quantity' + id).val();
            subtotal = $('#subtotal' + id).val();
            $.ajax({
                url : 'funciones/cambiar.php',
                type : 'post',
                dataType : 'text',
                data : 'id='+id+'&quanty='+quanty+'&idCarrito='+idCarrito,
                success : function(res){
                    if(res != -1){
                        subtotal = quanty * precio;
                        $('#subtotal' + id).html(subtotal);
                        $('#total').html(res);
                    }else{
                        $('#quantity' + id).html(quan);
                    }
                },error: function(){
                    alert('Error datos no encontrados...');
                }
            });
          }else{
          }
        }
        function eliminar(id,idCarrito){
          if(id){
            if(confirm("Eliminar Producto?")){
                $.ajax({
                    url : 'funciones/eliminarProducto.php',
                    type : 'post',
                    dataType : 'text',
                    data : 'id='+id+'&idCarrito='+idCarrito,
                    success : function(res){
                        if(res != -1){
                            $('#total').html(res);
                            $('#contenedor-fila' + id).html('');
                        }else{
                        }
                    },error: function(){
                        alert('Error datos no encontrados...');
                    }
                });
            }else{
                }
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
WHERE usuario = '$correo' AND status = 0";
$idPedido = $con->query($sql);

while($row = $idPedido->fetch_array()){
    $idCarrito     =$row["id"];
}

$sql = "SELECT * FROM pedidos_productos
WHERE id_pedido = '$idCarrito'";

$carrito = $con->query($sql);

echo "<div class =\"tabla-completa\">";
echo "<p>Parte 1 de 2</p>";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Producto</p>";
echo "<p class =\"titulo-n\">Cantidad</p>";
echo "<p class =\"titulo-n\">Costo Unitario</p>";
echo "<p class =\"titulo-n\">Subtotal</p>";
echo "<p class =\"titulo-final\">Eliminar Producto</p>";
echo "</div>";

while($row = $carrito->fetch_array()){
    $id     =$row["id_producto"];
    
    $sql = "SELECT * FROM productos
    WHERE id = '$id'";

    $nombreProducto = $con->query($sql);
    while($row2 = $nombreProducto->fetch_array()){
        $productoNombre = $row2['nombre'];
    }
    
    $quan     =$row["cantidad"];
    $precio     =$row["precio"];
    $subtotal = $quan * $precio;
    echo "<div id = \"contenedor-fila{$id}\" class =\"contenedor-fila\">";
    echo "<p class =\"dato-n\">$productoNombre</p>";
    echo "<input id = \"quantity$id\" class =\"dato-n\" onChange=\"cambiar($id,$quan,$idCarrito,$precio)\" type=number min = \"1\" value=\"$quan\";>";
    echo "<p id = \"precio$id\" class =\"dato-n\">$precio</p>";
    echo "<p id = \"subtotal$id\" class =\"dato-n\">$subtotal</p>";
    echo  "<button class =\"boton\">";
    echo  "<a class =\"dato-final\" href=\"javascript:void(0);\" onClick=\"eliminar($id,$idCarrito);\">Eliminar</a>";
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
$sql = "SELECT COUNT(*) as count FROM pedidos_productos WHERE id_pedido = '$idCarrito'";
$stmt = mysqli_stmt_init($con);
mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$count = mysqli_fetch_assoc($result)['count'];
if($count >0){
    echo  "<button class =\"botonContinuar\">";
    echo  "<a class =\"dato-final\" href=\"carrito02.php\">Continuar</a>";
    echo "</button>";
}else{
    echo  "<button class =\"botonContinuar\">";
    echo  "<a class =\"dato-final\">No hay Objetos en el carrito</a>";
    echo "</button>";
}
include 'footer.php';
?>