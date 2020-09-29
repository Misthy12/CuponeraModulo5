<?php
     include '../../Share/header.php';
     if($_GET)
     {
         //CONEXION
        include("../../Share/conexion.php");
        $conn=OpenCon();

        //extraemos datos
        $id=$_GET["codigo"];
        $sql="SELECT o.idCupon as id,o.tituloOferta as nombre, s.nombreSucursal as sucursal, o.idSucursal, o.precioRegular, o.precioOferta, o.fechaInicio, o.fechaFin, o.fechaLimite, o.cantidad, o.descripcion, ce.definirEstado as estado FROM tblCupones o
        INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
        INNER JOIN tblEstadosCupon ce ON o.estado = ce.idEstadoCupon
        WHERE o.idCupon=$id";
        $stmm = $conn->prepare($sql);
        $stmm->execute(array($id));
        $row=$stmm->fetchAll(PDO::FETCH_OBJ);
        foreach($row as $row){}
       
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
                </div>

                <div class="card-body">
                    <h3 class=" font-weight-bold text-center "><?php echo $row->nombre ?></h3><br>
                    <h5 class="card-subtitle text-center"><b >Sucursal:</b><?php echo $row->sucursal?></h5><br>
                    <p class="card-text text-justify"><b >Descripcion Oferta: </b><?php echo $row->descripcion?> </p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Cantidad Limite de Cupones: </b><?php echo $row->cantidad?></li>
                    <li class="list-group-item"><b>Precio Regular: $</b><?php echo $row->precioRegular?></li>
                    <li class="list-group-item"><b>Precio Oferta: $</b><?php echo $row->precioRegular?></li>
                    <li class="list-group-item"><b>Fecha Valides: </b><?php echo $row->fechaInicio." al ". $row->fechaFin ?></li>
                    <li class="list-group-item"><b>Limite:</b> <?php echo $row->fechaLimite?></li>
                    <li class="list-group-item"><b>Estado: </b><?php echo $row->estado?></li>
                </ul>
                

                <div class="card-footer">
                    <a href="listado_ofertas.php" class="btn btn-warning">Regresar</a>
                </div>

            </div>
        </div>
        
          <!-- LLAMADO AL FOOTER -->
    <?php
        include '../../Share/footer.php';
    ?>