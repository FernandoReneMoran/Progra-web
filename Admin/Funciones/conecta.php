<?php
//Carpetas del proyecto 
// Admin
////Imagenes
////Js
////Funciones
//////conecta.php este archivo
define("HOST",'localhost:3306');
define("BD",'cliente01');
define("USER_BD",'root');
define("PASS_BD",''); 

function conecta(){
    $con = new mysqli(HOST,USER_BD,PASS_BD,BD);
    return $con;
}
?>