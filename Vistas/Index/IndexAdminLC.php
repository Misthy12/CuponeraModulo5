    <?php 
      include "../../Share/header.php";
      include "../../Share/funcionesAdminLC.php";
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo numeroCupones(); ?></h3>

                <p>Cupones</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php if(numeroEmpresas()!=0){echo (numeroEmpresas()/100);} else{ echo 0;} ?><sup style="font-size: 20px">%</sup></h3>

                <p>Empresas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="./Vistas/Empresas/listado_empresas.php" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3> <?php echo numeroSucursales(); ?> </h3>

                <p>Sucursales</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="./Vistas/Sucursales/listado_sucursales.php" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3> <?php echo numeroClientes()?> </h3>

                <p>Clientes</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="./Vistas/Clientes/listado_clientes.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <!-- /.row (main row) -->
          <!-- Panel de ofertas  -->
          </div>

          <div class="row">
            <!-- CONSULTA PARA EXTARER DATOS -->
            <?php
                $conn =OpenCon();
                $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=1";


                      //Imprecion de formulario;
                      echo "<div class='col-12'><div class='card' >";
                      echo "<div class='card-header bg-warning text-center'> <h2>OFERTAS EN ESPERA DE APROBACION</h2></div>";
                      echo "<div class='row'>";
                      
                      foreach($conn->query($sql) as $row){

                        // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                        echo "<div class='col-3'><div class='card-body'>";
                        echo "<h4 class='h4 font-weight-bold text-center'>".$row["titulo"]."</h4><hr>";
                        echo "<h6 class='h6 text-center'>".$row["sucursal"]."</h6>";
                        echo "</div>";
                        echo "<div class='card-footer text-center font-weight-bold'> Rango de fechas: ".$row["fechaInicio"].$row["fechaFin"]." <br>";
                        echo "<a class='btn btn-sm btn-outline-info text-center btn-block fa-hand-eye' href=\"../Ofertas/editar_oferta.php?codigo=". $row["id"]."\" ><i class='fas fa-edit'></i></a> \n";
                        echo "</div></div>";
                    // }
                        }
                        echo "</div></div></div>";

                CloseCon($conn);
            ?>
          </div><!--FIN DEL ROW-->
      </div><!--FIN DEL ROW-->

        <?php      
         include "../../Share/footer.php";
        ?>

        
