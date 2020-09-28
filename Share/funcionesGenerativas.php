<?php

function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
   }

   function generarClaves($long){
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $password = "";
    //Reconstruimos la contraseña segun la longitud que se quiera
    for($i=0;$i<$long;$i++) {
       //obtenemos un caracter aleatorio escogido de la cadena de caracteres
        $password .= substr($str,rand(0,62),1);
    }
    return $password;
   }
    
?>