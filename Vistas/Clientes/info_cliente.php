<?php
     include '../../Share/header.php';
     if($_GET)
     {
         //CONEXION
        include("../../Share/conexion.php");
        $conn=OpenCon();

        //extraemos datos
        $id=$_GET["codigo"];
        $sql="SELECT * FROM tblClientes WHERE idCliente=?";
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
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-header bg-info">
                    <h2 class="text-center">Información Cliente</h2>
                </div>

                <div class="card-body">
                <h3 class="card-title text-center "><?php echo $row->nombresCliente ." " .$row->apellidosClientes?></h3>
                    <p class="card-text text-center"><b>Dui: </b> <?php echo $row->dui?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Correo:</b> <a href=" mailto:'<?php $row->correoCliente?>'"><u><i><?php echo $row->correoCliente?></i></u></a></li>
                    <li class="list-group-item"><b>Dirección: </b><?php echo $row->direccionCliente?></li>
                    <li class="list-group-item"><b>Telefono:</b> <?php echo $row->telefono?></li>
                    <li class="list-group-item"><b>Estado: </b><?php echo $row->estado?></li>
                </ul>
                </div>

                <div class="card-footer">
                    <a href="listado_clientes.php" class="btn btn-warning">Regresar</a>
                </div>

            </div>
        </div>
        
          <!-- LLAMADO AL FOOTER -->
    <?php
        include '../../Share/footer.php';
    ?>