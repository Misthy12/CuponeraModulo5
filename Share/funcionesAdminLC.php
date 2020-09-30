<?php
   include "conexion.php";

   //funciones para IndexAdmin 
   function numeroCupones(){
        //consulta a bd
        $conn=OpenCon();

        //consulta de Num de cupones
        $stmt = $conn->prepare("SELECT idCupon FROM tblCupones");
        $stmt->execute();
        $count=$stmt->rowCount();
        return($count);
   }

   function numeroEmpresas(){
        //consulta a bd
        $conn=OpenCon();

        //consulta de Num de cupones
        $stmt = $conn->prepare("SELECT idEmpresa FROM tblEmpresas");
        $stmt->execute();
        $count=$stmt->rowCount();
        return($count);
   }

   function numeroSucursales(){
        //consulta a bd
        $conn=OpenCon();

        //consulta de Num de cupones
        $stmt = $conn->prepare("SELECT idSucursal FROM tblSucursales");
        $stmt->execute();
        $count=$stmt->rowCount();
        return($count);
   }
   
   function numeroClientes(){
        //consulta a bd
        $conn=OpenCon();

        //consulta de Num de cupones
        $stmt = $conn->prepare("SELECT idCliente FROM tblClientes");
        $stmt->execute();
        $count=$stmt->rowCount();
        return($count);
   }
?>