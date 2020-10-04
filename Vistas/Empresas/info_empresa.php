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
        <div class="row">
            <ul class="nav nav-tabs  col-12" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                <a class="nav-link active" id="activas-tab" data-toggle="tab" href="#activas" role="tab" aria-controls="activas" aria-selected="true">Ofertas Activas</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="espera-tab" data-toggle="tab" href="#espera" role="tab" aria-controls="espera" aria-selected="false">Ofertas En espera</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="rechazada-tab" data-toggle="tab" href="#rechazada" role="tab" aria-controls="rechazada" aria-selected="false">Ofertas Rechazadas</a>
                </li>
            </ul>
            <div class="tab-content col-12" id="myTabContent">
                <div class="tab-pane fade show active" id="activas" role="tabpanel" aria-labelledby="activas-tab">
                    <div class="card card-body">
                        <?php
                                $conn =OpenCon();
                                //consulta de empresa
                                $idE=$row->id;
                                $sqlEmp=$conn->prepare("SELECT idSucursal, idEmpresa FROM tblSucursales WHERE idEmpresa = $idE");
                                $sqlEmp->execute(array($idE));
                                $count=$sqlEmp->rowCount();
                                $rowE=$sqlEmp->fetchAll(PDO::FETCH_OBJ);
                                foreach($rowE as $rowE){}
                                if($count==0)
                                {
                                    ECHO "<h1 class='text-center text-warning'>LA EMPRESA NO DISPONE DE OFERTAS!!</h1>";
                                }
                                else{
                                if($id=$idE){
                                $idSuc=$rowE->idSucursal;
                                $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                                INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                                INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=2 AND s.idSucursal = $idSuc";
                                echo "<div class='row col-12'>";
                                //Imprecion de formulario
                                foreach($conn->query($sql) as $rowO){
                                    echo "<div class='card col-sm-12 col-md-3' >";
                                    echo "<div class='card-header bg-success'> <h4 class='text-center font-weight-bold'>OFERTA ACTIVA</h4>
                                            <h5 class='text-center'> <b>Sucursal: </b>". $rowO["sucursal"]."</h5></div>";
                                    // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                                        echo "<div class='card-body '>";
                                        echo "<h6 class='h6 font-weight-bold text-center'>".$rowO["titulo"]."</h6><hr>";
                                        echo "<h6 class'h6'> <b>Rango de fechas:</b> del ".$rowO["fechaInicio"]." al ".$rowO["fechaFin"]."</h6>";
                                        echo "</div>";
                                        echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$rowO["fechaLimite"]." <br>";
                                        echo "<a type='submit'  href=\"../Ofertas/info_oferta.php?codigo=".$rowO["id"]."\" class='fas fa-eye btn btn-sm btn-outline-info text-center btn-block' title='Ver'>Ver Oferta</a></div>";
                                        echo "</div>";
                                         }
                                        echo "</div>";
                                }}
                                    CloseCon($conn);
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade  col-12" id="espera" role="tabpanel" aria-labelledby="espera-tab">
                    <div class="card card-body">
                        <?php
                                $conn =OpenCon();
                                //consulta de empresa
                                 $idE=$row->id;
                                 if($count==0)
                                 {
                                     ECHO "<h1 class='text-center text-warning'>LA EMPRESA NO DISPONE DE OFERTAS!!</h1>";
                                 }
                                 else{
                                     
                                $id=$_GET["codigo"];
                                if($id=$idE){
                                $idSuc=$rowE->idSucursal;
                                $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                                INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                                INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=1 AND s.idSucursal = $idSuc";
                                
                                echo "<div class='row col-12'>";
                                //Imprecion de formulario
                                foreach($conn->query($sql) as $rowOE){
                                    echo "<div class='card col-sm-12 col-md-3' >";
                                    echo "<div class='card-header bg-warning'> <h4 class='text-center font-weight-bold'>OFERTA EN ESPERA</h4>
                                    <h5 class='text-center'> <b>Sucursal: </b>". $rowOE["sucursal"]."</div>";
                                    // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                                        echo "<div class='card-body '>";
                                        echo "<h6 class='h6 font-weight-bold text-center'>".$rowOE["titulo"]."</h6><hr>";
                                        echo "<h6 class'h6'> <b>Rango de fechas:</b> del ".$rowOE["fechaInicio"]." al ".$rowOE["fechaFin"]."</h6> <br>";
                                        echo "</div>";
                                        echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$rowOE["fechaLimite"]." <br>";
                                        echo "<a type='submit'  href=\"../Ofertas/info_oferta.php?codigo=".$rowOE["id"]."\" class='fas fa-eye btn btn-sm btn-outline-info text-center btn-block' title='Ver'>Ver Oferta</a></div>";
                                        echo "</div>";
                                        
                                }
                            }
                                echo "</div>";
                        }
                                CloseCon($conn);
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade  col-12" id="rechazada" role="tabpanel" aria-labelledby="rechazada-tab">
                    <div class="card card-body">
                        <?php
                                $conn =OpenCon();
                                //consulta de empresa
                                // $idE=$row->id;
                                if($count==0)
                                {
                                    ECHO "<h1 class='text-center text-warning'>LA EMPRESA NO DISPONE DE OFERTAS!!</h1>";
                                }
                                else{
                                    
                               $id=$_GET["codigo"];
                                if($id=$idE){
                                $idSuc=$rowE->idSucursal;
                               
                                $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                                INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                                INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=3 AND s.idSucursal = $idSuc";
                                
                                echo "<div class='row col-12'>";
                                //Imprecion de formulario
                                foreach($conn->query($sql) as $rowOR){
                                    echo "<div class='card col-sm-12 col-md-3' >";
                                    echo "<div class='card-header bg-danger'> <h4 class='text-center font-weight-bold'>OFERTA RECHAZADA</h4>
                                    <h5 class='text-center'> <b>Sucursal: </b>". $rowO["sucursal"]."</div>";
                                    // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                                        echo "<div class='card-body '>";
                                        echo "<h6 class='h6 font-weight-bold text-center'>".$rowOR["titulo"]."</h6><hr>";
                                        echo "<h6 class'h6'> <b>Rango de fechas:</b> del ".$rowOR["fechaInicio"]." al ".$rowOR["fechaFin"]."</h6> <br>";
                                        echo "</div>";
                                        echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$rowOR["fechaLimite"]." <br>";
                                        echo "<a type='submit'  href=\"../Ofertas/info_oferta.php?codigo=".$rowOR["id"]."\" class='fas fa-eye btn btn-sm btn-outline-info text-center btn-block' title='Ver'>Ver Oferta</a></div>";
                                        echo "</div>";
                                        // }
                                    }
                                }
                                    echo "</div>";
                            }
                                
                                    CloseCon($conn);
                        ?>
                    </div>
                </div>
        </div>
        
          <!-- LLAMADO AL FOOTER -->
    <?php
        include '../../Share/footer.php';
    ?>