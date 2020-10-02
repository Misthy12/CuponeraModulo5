<?php 
  include "../../Share/header.php";
  include "../../Share/conexion.php";
//   include('../../Share/validar.php');
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Panel de ofertas  -->
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
                            $idSuc= $_SESSION["id"];
                            $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                            INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                            INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=2 AND s.idSucursal = $idSuc";

                            //Imprecion de formulario
                            foreach($conn->query($sql) as $row){
                                echo "<div class='card col-sm-12 col-md-3' >";
                                echo "<div class='card-header bg-info'> <h4 class='text-center'>OFERTA ACTIVA</h4></div>";
                                // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                                    echo "<div class='card-body '>";
                                    echo "<h6 class='h6 font-weight-bold text-center'>".$row["titulo"]."</h6><hr>";
                                    echo "<h6 class'h6'> <b>Rango de fechas:</b> del ".$row["fechaInicio"]." al ".$row["fechaFin"]."</h6>";
                                    echo "</div>";
                                    echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$row["fechaLimite"]." <br>";
                                    echo "<a type='submit'  href=\"../Ofertas/info_oferta.php?codigo=".$row["id"]."\" class='fas fa-eye btn btn-sm btn-outline-info text-center btn-block' title='Ver'>Ver Oferta</a></div>";
                                    echo "</div>";
                                    // }
                                }
                                CloseCon($conn);
                    ?>
                </div>
            </div>
            <div class="tab-pane fade  col-12" id="espera" role="tabpanel" aria-labelledby="espera-tab">
                <div class="card card-body">
                    <?php
                            $conn =OpenCon();
                            $idSuc= $_SESSION["id"];
                            $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                            INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                            INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=1 AND s.idSucursal = $idSuc";

                            //Imprecion de formulario
                            foreach($conn->query($sql) as $row){
                                echo "<div class='card col-sm-12 col-md-3' >";
                                echo "<div class='card-header bg-info'> <h4 class='text-center'>OFERTA EN ESPERA</h4></div>";
                                // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                                    echo "<div class='card-body '>";
                                    echo "<h6 class='h6 font-weight-bold text-center'>".$row["titulo"]."</h6><hr>";
                                    echo "<h6 class'h6'> <b>Rango de fechas:</b> del ".$row["fechaInicio"]." al ".$row["fechaFin"]."</h6> <br>";
                                    echo "</div>";
                                    echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$row["fechaLimite"]." <br>";
                                    echo "<a type='submit'  href=\"../Ofertas/info_oferta.php?codigo=".$row["id"]."\" class='fas fa-eye btn btn-sm btn-outline-info text-center btn-block' title='Ver'>Ver Oferta</a></div>";
                                    echo "</div>";
                                    // }
                                }
                                CloseCon($conn);
                    ?>
                </div>
            </div>
            <div class="tab-pane fade  col-12" id="rechazada" role="tabpanel" aria-labelledby="rechazada-tab">
                <div class="card card-body">
                    <?php
                            $conn =OpenCon();
                            $idSuc= $_SESSION["id"];
                            $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                            INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                            INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=3 AND s.idSucursal = $idSuc";

                            //Imprecion de formulario
                            foreach($conn->query($sql) as $row){
                                echo "<div class='card col-sm-12 col-md-3' >";
                                echo "<div class='card-header bg-info'> <h4 class='text-center'>OFERTA RECHAZADA</h4></div>";
                                // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                                    echo "<div class='card-body '>";
                                    echo "<h6 class='h6 font-weight-bold text-center'>".$row["titulo"]."</h6><hr>";
                                    echo "<h6 class'h6'> <b>Rango de fechas:</b> del ".$row["fechaInicio"]." al ".$row["fechaFin"]."</h6> <br>";
                                    echo "</div>";
                                    echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$row["fechaLimite"]." <br>";
                                    echo "<a type='submit'  href=\"../Ofertas/info_oferta.php?codigo=".$row["id"]."\" class='fas fa-eye btn btn-sm btn-outline-info text-center btn-block' title='Ver'>Ver Oferta</a></div>";
                                    echo "</div>";
                                    // }
                                }
                                CloseCon($conn);
                    ?>
                </div>
            </div>
        </div>
        <?php
         include "../../Share/footer.php";
        ?>