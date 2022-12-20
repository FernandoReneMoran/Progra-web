<?php
$nombre = $_REQUEST['nombre'];
$correo = $_REQUEST['correo'];
$comentarios = $_REQUEST['comentarios'];
$message ="De parte de EzShop \n Estaremos en contacto para brindarte las mejores ofertas y la mejor asistencia posible";
$subject = "Mensaje de EzShop";
mail($correo, $subject, $message);
?>