<?php
include "../../Share/header.php";
include '../../Share/conexion.php';
?>
    <title>Ofertas</title>
    <div class="col-md-8 offset-md-2 col-sm-12">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-center  font-weight-bold">Canjear Oferta</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-7 col-sm-12">
                            <label for="Codigo">Codigo Cupon</label>
                            <input type="text" name="Codigo" id="Codigo" class="form-control" required/>
                            <br>
                        </div>                  
                    </div>

                    <input type="Submit" value="Buscar" name="submit" class="btn btn-success">
                    <a href="listado_ofertas.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>
            
            

            <div class="card-footer">                    
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){
                        
                        $conn=OpenCon();
                        //verificar la conexion
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :(");
                        }

                        if($_POST["Codigo"]!="" ){

                            $id=$_POST["Codigo"];
                            $sql='SELECT o.idCupon as id,o.tituloOferta as nombre, s.nombreSucursal as sucursal, o.idSucursal, o.precioRegular, o.precioOferta, o.fechaInicio, o.fechaFin, o.fechaLimite, o.cantidad, o.descripcion, ce.definirEstado as estado, o.estado as idEstado, cl.dui FROM tblCupones o 
                            INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal 
                            INNER JOIN tblEstadosCupon ce ON o.estado = ce.idEstadoCupon 
                            INNER Join tblcompracupon cm On o.idCupon = cm.idCupon 
                            iNNER Join tblclientes cl ON cm.idCliente= cl.idCliente 
                            WHERE cm.codigoCompra=?';
                           $stmm = $conn->prepare($sql);
                           $stmm->execute(array($id));
                           $row=$stmm->fetchAll(PDO::FETCH_OBJ);
                           foreach($row as $row){}
                        if($row != null){
                            Print'<script>
                            if('.$row->idEstado.'==2){
                                Swal.fire({
                                    title: "'.$row->nombre.'",
                                    html:"Sucursal:'.$row->sucursal.'</br> Dui:'.$row->dui.' </br> Estado:'.$row->estado.'</br> Fecha Fin:'.$row->fechaLimite.'",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Cajear!"
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "./vender.php?codigo='.$row->id.'";
                                        Swal.fire({
                                            icon: "success",
                                            title: "Hecho!",
                                            text: "Canjeado Exitosamente!"
                                          })
                                    }
                                  })
                            }
                            else{
                                Swal.fire({
                                    title: "'.$row->nombre.'",
                                    html:"Sucursal:'.$row->sucursal.'</br> Dui:'.$row->dui.' </br><b> Estado:'.$row->estado.'</b></br> Fecha Fin:'.$row->fechaLimite.'",
                                    text:"Producto Canjeado Anteriormente",
                                    showCancelButton: false
                                  })
                            }
                            </script>';
                        }else{
                            Print"<script>
                            Swal.fire({
                              icon: 'error',
                              title: 'OPPS!',
                              text: 'No existe Ningun Cupon!',
                            })
                            </script>";
                        }
                    }
                    else{
                        echo "<div class='alert alert-danger' role='alert'> ";
                            echo "Aun faltan datos por llenar :'(";
                        echo "</div>";
                    }
                        CloseCon($conn);
                    }
                echo "
            </div>
        </div>
    </div>";//fin del div card-footer, CARD, COL
        
        //incluimos footer
        include "../../Share/footer.php";
        ?>
