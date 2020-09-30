        <!-- Panel de ofertas  -->
        <div class="row col-12">
            <!-- CONSULTA PARA EXTARER DATOS -->
            <?php
                $conn =OpenCon();
                $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=2";


                      //Imprecion de formulario
                      echo "<form class='col-md-3 col-sm-12' > <div class='card' style='heigth: 25rem; ' >";
                      echo "<div class='card-header bg-info'> <h2>OFERTAS EN</h2></div>";
                      foreach($conn->query($sql) as $row){
                        // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                        echo "<div class='card-body'>";
                        echo "<h4 class='h4 font-weight-bold text-center'>".$row["titulo"]."</h4><hr>";
                        echo "<h6 class='h6 text-center'>".$row["sucursal"]."</h6>";
                        echo "</div>";
                        echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$row["fechaLimite"]." <br>";
                        echo "<button type='submit' class='fas fa-hand-point-up btn btn-sm btn-outline-info text-center btn-block' title='Comprar'>Comprar</button></div>";
                        echo "</div></form>";
                    // }
                }
                CloseCon($conn);
            ?>
        </div><!--FIN DEL ROW-->