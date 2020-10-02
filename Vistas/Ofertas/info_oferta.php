<?php
     include '../../Share/header.php';
     
     if($_GET)
     {
         //CONEXION
        include("../../Share/conexion.php");
        $conn=OpenCon();

        //extraemos datos del cupon
        $id=$_GET["codigo"];
        $sql="SELECT o.idCupon as id,o.tituloOferta as nombre, s.nombreSucursal as sucursal, o.idSucursal, o.precioRegular, o.precioOferta, o.fechaInicio, o.fechaFin, o.fechaLimite, o.cantidad, o.descripcion, ce.definirEstado as estado FROM tblCupones o
        INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
        INNER JOIN tblEstadosCupon ce ON o.estado = ce.idEstadoCupon
        WHERE o.idCupon=$id";
        $stmm = $conn->prepare($sql);
        $stmm->execute(array($id));
        $row=$stmm->fetchAll(PDO::FETCH_OBJ);
        foreach($row as $row){}

        //empresa
        $idSucursal=$row->idSucursal;
        $empresa=$conn->prepare("SELECT * FROM tblSucursales WHERE idSucursal=$idSucursal");
        $empresa->execute(array($idSucursal));
        $rowSucu=$empresa->fetchAll(PDO::FETCH_OBJ);
        foreach($rowSucu as $rowSucu){}

        $idEmpresa=$rowSucu->idEmpresa;
        $comision=$conn->prepare("SELECT * FROM tblEmpresas WHERE idEmpresa=$idEmpresa");
        $comision->execute(array($idEmpresa));
        $rowComi=$comision->fetchAll(PDO::FETCH_OBJ);
        foreach($rowComi as $rowComi){}
        //Cerranmos Conexion
        CloseCon($conn);
      }
      else
      {
       $id="";
         echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
          <strong>Error</strong> No se han enviado variables</div>";
      }
    ?>
        <div class="col-md-6 offset-md-3 col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h2 class="text-center">Información Oferta</h2>
                    <h6 class="text-center "><b>Estado: </b><?php echo $row->estado?></h6>
                </div>

                <div class="card-body">
                    <h3 class=" font-weight-bold text-center "><?php echo $row->nombre ?></h3><br>
                    <h5 class="card-subtitle text-center"><b >Sucursal:</b><?php echo $row->sucursal?></h5><br>
                    <p class="card-text text-justify"><b >Descripcion Oferta: </b><?php echo $row->descripcion?> </p>
                    <div class="col-12 table-responsive">
                        <table class="table  ">
                            <tr class="col-12">
                                <td  colspan="2">
                                    <b>Cantidad Limite de Cupones: </b><?php echo $row->cantidad?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Cupones Vendidos: </b><?php 
                                    //consulta para saber el numero de vendidos
                                    $stmt = $conn->prepare("SELECT idCompra FROM tblCompraCupon WHERE idCupon=$row->id");
                                    $stmt->execute();
                                    $count=$stmt->rowCount();
                                    echo $count ?>
                                </td>
                                <td><b>Cupones Disponibles: </b><?php echo $row->cantidad-$count ?> </td>
                            </tr>
                            <tr>
                                <td><b>Precio Regular: $</b><?php echo $row->precioRegular?></td>
                                <td><b>Precio Oferta: $</b><?php echo $row->precioOferta?></td>
                            </tr>
                            <tr>
                                <td><b>Fecha Valides: </b><?php echo $row->fechaInicio." <b>al</b> ". $row->fechaFin?> </td> 
                                <td><b>Limite:</b> <?php echo $row->fechaLimite?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b class="text-success">INGRESOS TOTALES: $ </b><?php $ingresosTot=$count * $row->precioOferta; echo $ingresosTot?></td>  
                            </tr>
                            <tr>
                                <td colspan="2"><b class="text-danger text-uppercase">Cargo por servicios</Canvas>: $ </b><?php echo ($ingresosTot * $rowComi->porcentajeComision)/100?></td>  
                            </tr>
                        </table>
                    </div>
                </div>
                

                <div class="card-footer">
                    <a href="listado_ofertas.php" class="btn btn-warning">Regresar</a>
                </div>

            </div>
        </div>
        
          <!-- LLAMADO AL FOOTER -->
    <?php
        include '../../Share/footer.php';
    ?>