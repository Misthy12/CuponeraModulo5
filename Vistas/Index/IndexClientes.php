<?php
    include "../../Share/header.php";
    include "../../Share/conexion.php";
    include '../../Share/funcionesGenerativas.php';
    require '../../Share/PhpMailer/src/PHPMailer.php';
    require '../../Share/PhpMailer/src/SMTP.php';
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row col-12">
            <!-- CONSULTA PARA EXTARER DATOS -->
            <?php
                $conn =OpenCon();
                $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioRegular, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin,o.cantidad, o.fechaLimite  FROM tblCupones o
                INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
                INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.estado=2 AND o.cantidad>0";


                foreach($conn->query($sql) as $row){
                    //para el rango de fechas a mostar
                    //$hoy= date("Y-m-d");//fecha actual

                    //validacion de impresion de oferta
                    // if($hoy >= $row["fechaInicio"] && $hoy <= $row["fechaFin"]){
                        //Imprecion de formulario
                        echo "<form class='col-md-3 col-sm-12' > <div class='card' style='heigth: 25rem'>";
                        echo "<div class='card-header bg-info'>";
                        echo "<h4 class='h4 font-weight-bold text-center'>".$row["titulo"]."</h4><hr>";
                        echo "<h6 class='h6 text-center'>".$row["sucursal"]."</h6></div>";
                        
                        echo "<div class='card-body'>";
                        echo "<p class='text-lg-justify'> <b>OFERTA! </b>".$row["descripcion"]."</p> <hr>";
                        echo "<p class='text-lg-center'> <b>Precio Oferta: </b>$".$row["precioOferta"]."</p> <hr>";
                        echo "<p class='text-lg-center'> <b>Precio Regular: </b><s class='text-danger'>$".$row["precioRegular"]."</s></p>";
                        echo "</div>";
                        echo "<div class='card-footer text-center font-weight-bold'> Ultima Fecha de Canje: ".$row["fechaLimite"]." <br>";
                        echo "<button type='button'  data-toggle='modal' data-target='#Cupon".$row["id"]."' class='fas fa-hand-point-up btn btn-sm btn-outline-info text-center btn-block' title='Comprar'>Comprar</button></div>";
                        echo "</div></form>";
              ?>
                        <!-- Modal -->
              <div class="modal fade" id="Cupon<?php echo$row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><?php echo $row["titulo"] ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <Form action="" method="POST">
                    <input type="text" name="idCliente" id="idCliente" hidden value="<?php echo $_SESSION["id"]?>">
                    <input type="text" name="idCupon" id="idCupon"  hidden value="<?php echo$row["id"]?>">
                    <input type="text" name="Cantidad" id="Cantidad"  hidden value="<?php echo$row["cantidad"]?>">
                    <input type="text" class="label" readonly name="CodigoCompra" id="codigoCompra" value="<?php echo "SUC".$row["id"]."-".generarCodigoS(7).""; ?>">

                    Total $<?php echo $row["precioOferta"] ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" id="btnComprar" name="btnComprar" class="btn btn-primary">Comprar</button>
                    </div>
                    </Form>
                  </div>
                </div>
              </div>
              
              <?php
                   
                }

                    CloseCon($conn);
                    if(isset($_POST["btnComprar"])){
                        $conn=OpenCon();

                        //verificar la conexion
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :(");
                        }

                        if($_POST["idCliente"]!="" && $_POST["idCupon"] != "" && $_POST["CodigoCompra"]!=""){
                            $sql = "INSERT INTO tblcompracupon(idCliente, idCupon, codigoCompra,estado)
                                    VALUES ('".$_POST["idCliente"]."','".$_POST["idCupon"]."','".$_POST["CodigoCompra"]."',0)";
                              $cantidad = ($_POST["Cantidad"]-1);
                              $sql2 = "UPDATE tblCupones SET  cantidad='".$cantidad."' WHERE idCupon='".$_POST["idCupon"]."'";      
                              $count = $conn->exec($sql);
                            $count2 = $conn->exec($sql2);

                            if($count > 0 && $count2){
                                ?>
                                <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'EXITO!',
                                    text: 'Compra Realizada con Exito!'
                                });
                                
                                </script>
                                <?php
                            }else{
                                echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                                echo "No se ha guardado el cliente!! :'( \n";
                                echo "</br>";
                                echo "Error: ". $sql;
                                print_r($conn->errorInfo());
                                echo "</div>";
                            }
                            CloseCon($conn);
                        }
                        else{
                            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                                echo "Aun faltan campos por llenar!! :(";
                                echo "</div>";
                        }
                    }
            ?>
        </div><!--FIN DEL ROW-->

      </div><!--FIN DEL CONTAINER FLUID-->
      <?php
         include "../../Share/footer.php";
        ?>
