<?php
//funcion de conexion
function OpenCon(){
    
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="bd_automoviles";
    $conn= new mysqli($dbhost,$dbuser, $dbpass, $db) or die("No se ha podido establecer conexion: %s\n". $conn -> error);

    return $conn;
}
//funcion de desconexion
function CloseCon($conn){
    $conn -> close();
}
?>