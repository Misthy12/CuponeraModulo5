<?php
//funcion de conexion
function OpenCon(){
    
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="";
    $conn= new mysqli($dbhost,$dbuser, $dbpass, $db) or die("No se ha podido establecer conexion: %s\n". $conn -> error);

    return $conn;
}
//funcion de desconexion
function CloseCon($conn){
    $conn -> close();
}
function OpenConPDO(){
    /*Conexion a una Base de Datos MySql*/
    $dsn = 'mysql:dbname=;host=127.0.0.1';
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
 function CloseConPDO($mbd){
    $mbd = null;
 }
?>