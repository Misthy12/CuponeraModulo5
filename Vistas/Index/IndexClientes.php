<?php
    include "../../Share/header.php";
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row col-12">
            <!-- CONSULTA PARA EXTARER DATOS -->
            <?php
            include "../../Share/conexion.php";
                $conn =OpenCon();
                $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin, o.fechaLimite  FROM tblCupones o
                INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=2";


                foreach($conn->query($sql) as $row){
                    //para el rango de fechas a mostar
                    //$hoy= date("Y-m-d");//fecha actual

                    //validacion de impresion de oferta
                    // if($hoy >= $row["fechaInicio"] && $hoy <= $row["fechaFin"]){
                        //Imprecion de formulario
                        echo "<form class='col-md-3 col-sm-12' > <div class='card' style='heigth: 25rem; ' >";
                        echo "<div class='card-header bg-info'>";
                        echo "<h4 class='h4 font-weight-bold text-center'>".$row["titulo"]."</h4><hr>";
                        echo "<h6 class='h6 text-center'>".$row["sucursal"]."</h6></div>";
                        // echo "<div class='card-body'>".$row["fechaInicio"].$row["fechaFin"]."</div>";
                        echo "<div class='card-body'>";
                        echo "<p class='text-lg-justify'> <b>OFERTA! </b>".$row["descripcion"]."</p> <hr>";
                        echo "<p class='text-lg-center'> <b>Precio Oferta: </b>$".$row["precioOferta"]."</p> <hr>";
                        echo "<p class='text-lg-center'> <b>Precio Regular: </b><s class='text-danger'>$".$row["precioRegular"]."</s></p>";
                        echo "</div>";
                        echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$row["fechaLimite"]." <br>";
                        echo "<button type='submit' class='fas fa-hand-point-up btn btn-sm btn-outline-info text-center btn-block' title='Comprar'>Comprar</button></div>";
                        echo "</div></form>";
                    // }
                }
                CloseCon($conn);
            ?>
        </div><!--FIN DEL ROW-->

      </div><!--FIN DEL CONTAINER FLUID-->

      <?php
         include "../../Share/footer.php";
        ?>
