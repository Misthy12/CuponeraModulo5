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
                <a class="nav-link active" id="activas-tab" data-toggle="tab" href="#activas" role="tab" aria-controls="activas" aria-selected="true">Activos</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="vencidos-tab" data-toggle="tab" href="#vencidos" role="tab" aria-controls="vencidos" aria-selected="false">Vencidos</a>
                </li>
            </ul>
         <div class="tab-content col-12" id="myTabContent">
            <div class="tab-pane fade show active" id="activas" role="tabpanel" aria-labelledby="activas-tab">
                <div class="card card-body">
                    <?php
                            $conn =OpenCon();
                            $hoy= date("Y-m-d");//fecha actual
                            $idClien=$_SESSION["id"];
                            $sql="SELECT cp.idCompra as id, cp.codigoCompra, cp.idCupon, cl.nombresCliente, cl.apellidosClientes, o.idCupon, o.idSucursal,o.descripcion, o.precioRegular, o.precioOferta, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite FROM tblCompraCupon cp
                            INNER JOIN tblcupones o ON cp.idCupon = o.idCupon
                            INNER JOIN tblClientes cl ON cp.idCliente = cl.idCliente WHERE cp.idCliente=$idClien AND o.estado=2";

                            echo "<div class='row col-12'>";
                            //Imprecion de formulario
                            foreach($conn->query($sql) as $row){
                                $sucursal=$row["idSucursal"];
                                $sqlSucursal=$conn->prepare("SELECT nombreSucursal FROM tblSucursales WHERE idSucursal= $sucursal ");
                                $sqlSucursal->execute(array($sucursal));
                                $count=$sqlSucursal->rowCount();
                                $rowS=$sqlSucursal->fetchAll(PDO::FETCH_OBJ);
                                if($count==0)
                                {
                                    ECHO "<h1 class='text-center text-warning'>NO DISPONE DE CUPONES!!</h1>";
                                }
                                else{
                                foreach($rowS as $rowS){}
                                echo "<div class='card col-sm-12 col-md-3' >";
                                echo "<div class='card-header bg-success'> 
                                <h4 class='text-center'>OFERTA ACTIVA</h4>
                                <h6 class='text-center'><b>Codigo de compra: </b>".$row["codigoCompra"]."</h6>
                                </div>";
                                // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                                    echo "<div class='card-body '>";
                                    echo "<h6 class='h5 text-center font-weight-bold'>".$rowS->nombreSucursal."</h6>";
                                    echo "<h6 class='h6 text-center font-weight-bold'> <b>Comprador: </b>".$row["nombresCliente"]." ".$row["apellidosClientes"] ."</h6>";
                                    echo "<p class='text-lg-justify'> <b>OFERTA! </b>".$row["descripcion"]."</p> <hr>";
                                    echo "<p class='text-lg-center'> <b>Precio Oferta: </b>$".$row["precioOferta"]."</p> <hr>";
                                    echo "<p class='text-lg-center'> <b>Precio Oferta: </b>$".$row["precioOferta"]."</p> <hr>";
                                    echo "<p class='text-lg-center'> <b>Precio Regular: </b><s class='text-danger'>$".$row["precioRegular"]."</s></p>";
                                    echo "</div>";
                                    echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$row["fechaLimite"];
                                    echo "</div></div>";
                                    // }
                                }
                            }
                            echo "</div>";
                            CloseCon($conn);
                    ?>
                </div>
            </div>
            <div class="tab-pane fade  col-12" id="vencidos" role="tabpanel" aria-labelledby="vencidos-tab">
                <div class="card card-body">
                    <?php
                            $conn =OpenCon();
                            $sql="SELECT cp.idCompra as id, cp.codigoCompra, cp.idCupon, cl.nombresCliente, cl.apellidosClientes, o.idCupon, o.idSucursal,o.descripcion, o.precioRegular, o.precioOferta, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite FROM tblCompraCupon cp
                            INNER JOIN tblcupones o ON cp.idCupon = o.idCupon
                            INNER JOIN tblClientes cl ON cp.idCliente = cl.idCliente WHERE cp.idCliente=$idClien AND o.estado=5";

                            echo "<div class='row col-12'>";
                            //Imprecion de formulario
                            foreach($conn->query($sql) as $row){
                                $sucursal=$row["idSucursal"];
                                $sqlSucursal=$conn->prepare("SELECT nombreSucursal FROM tblSucursales WHERE idSucursal= $sucursal ");
                                $sqlSucursal->execute(array($sucursal));
                                $count=$sqlSucursal->rowCount();
                                $rowS=$sqlSucursal->fetchAll(PDO::FETCH_OBJ);
                                if($count==0)
                                {
                                    ECHO "<h1 class='text-center text-warning'>NO DISPONE DE CUPONES!!</h1>";
                                }
                                else{
                                foreach($rowS as $rowS){}
                                echo "<div class='card col-sm-12 col-md-3'>";
                                echo "<div class='card-header bg-danger'> <h4 class='text-center'>OFERTA VENCIDA</h4>";
                                echo "<h6 class='text-center'><b>Codigo de compra: </b>".$row["codigoCompra"]."</h6>
                                </div>";
                                    echo "<div class='card-body '>";
                                    echo "<h6 class='h5 text-center font-weight-bold'>".$rowS->nombreSucursal."</h6>";
                                    echo "<h6 class='h6 text-center font-weight-bold'> <b>Comprador: </b>".$row["nombresCliente"]." ".$row["apellidosClientes"] ."</h6>";
                                    echo "<p class='text-lg-justify'> <b>OFERTA! </b>".$row["descripcion"]."</p> <hr>";
                                    echo "<p class='text-lg-center'> <b>Precio Oferta: </b>$".$row["precioOferta"]."</p> <hr>";
                                    echo "<p class='text-lg-center'> <b>Precio Oferta: </b>$".$row["precioOferta"]."</p> <hr>";
                                    echo "<p class='text-lg-center'> <b>Precio Regular: </b><s class='text-danger'>$".$row["precioRegular"]."</s></p>";
                                    echo "</div>";
                                    echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$row["fechaLimite"];
                                    echo "</div></div>";

                                }
                            }
                                echo "</div>";
                                CloseCon($conn);
                    ?>
                </div>
            </div>
           
        </div>
        <?php
         include "../../Share/footer.php";
        ?>