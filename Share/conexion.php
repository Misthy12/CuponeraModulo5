<?php
//funcion de conexion
// function OpenCon(){
    
//     $dbhost="localhost";
//     $dbuser="root";
//     $dbpass="";
//     $db="dbCuponera";
//     $conn= new mysqli($dbhost,$dbuser, $dbpass, $db) or die("No se ha podido establecer conexion: %s\n". $conn -> error);

//     return $conn;
// }
// //funcion de desconexion
// function CloseCon($conn){
//     $conn -> close();
// }

//CONECCION PARA PDO
function OpenCon(){
    /*Conexion a una Base de Datos MySql*/
    $dsn = 'mysql:dbname=dbCuponera;host=127.0.0.1';
    $usuario = 'root';
    $contrasena = '';
    try{
       $mbd = new PDO($dsn,$usuario,$contrasena,array(PDO::ATTR_PERSISTENT => true));
    } 
    catch (PDOException $e){
       die('Fallo la conexión: ' .$e->getMessage());
       $mbd = null;
    }
    return $mbd;
 }
 function CloseCon($mbd){
    $mbd = null;
 }
?>