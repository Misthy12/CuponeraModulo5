<?php
     include '../../Share/header.php';
     if($_GET)
     {
         //CONEXION
        include("../../Share/conexion.php");
        $conn=OpenCon();

        //extraemos datos
        $id=$_GET["codigo"];
        // $sql="SELECT * FROM tblEmpresas WHERE idEmpresa=?";
        $sql="SELECT e.idEmpresa as id, e.nombreEmpresa, e.telefono, e.codigoEmpresa, e.direccion, e.correo, r.nombreRubro as rubro, e.porcentajeComision FROM tblEmpresas e
            INNER JOIN tblRubros r ON e.idRubro = r.idRubro WHERE e.idEmpresa=$id";
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
                    <h2 class="text-center">Información Empresa</h2>
                </div>

                <div class="card-body">
                    <h3 class=" font-weight-bold  text-center "><?php echo $row->nombreEmpresa ?></h3>
                    <p class="card-text text-center"><b>Codigo:</b><?php echo $row->codigoEmpresa?></p>
                
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Dirección: </b><?php echo $row->direccion?></li>
                        <li class="list-group-item"><b>Correo: </b><?php echo $row->correo?></li>
                        <li class="list-group-item"><b>Telefono:</b> <?php echo $row->telefono?></li>
                        <li class="list-group-item"><b>Rubro: </b><?php echo $row->rubro?></li>
                        <li class="list-group-item"><b>Comision: </b><?php echo $row->porcentajeComision?>%</li>
                    </ul>
                </div>

                <div class="card-footer">
                    <a href="listado_empresas.php" class="btn btn-warning">Regresar</a>
                </div>

            </div>
        </div>
        
          <!-- LLAMADO AL FOOTER -->
    <?php
        include '../../Share/footer.php';
    ?>