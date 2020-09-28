<?php
include "../../Share/header.php";
include '../../Share/conexion.php';
 $conn=OpenCon();
    $consultaSucursal="SELECT *FROM tblSucursales";
    // $consultaEstado="SELECT *FROM tblEstadosCupon";
?>
    <title>Oferta</title>

        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-center">Agregar Oferta</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <label for="nombre">Titulo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" require/>
                    <br>

                    <label for="empresa">Sucursal</label>
                    <select type="text" name="empresa" id="empresa" class="form-control" require>
                    <option value="">Seleccione...</option>
                    <?php
                            foreach ($conn->query($consultaSucursal) as $valor) {
                                echo "<option value='".$valor["idSucursal"]."'>".$valor["nombreSucursal"]."</option>";
                            }
                        ?>
                    </select>
                    <br>
                    <div class="col-12">
                        <div class="col-5">
                            <label for="precioRegular">Precio Regular</label>
                            <input type="number" name="precioRegular" id="precioRegular" step="0.5" class="form-control" placeholder="$1.25" require/>
                            <br>
                        </div>
                        <div class="col-5">
                            <label for="precioOferta">Precio Oferta</label>
                            <input type="number" name="precioOferta" id="precioOferta" step="0.5" class="form-control" placeholder="$1.25" require/>
                            <br>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="col-3">
                            <label for="inicio">Fecha Inicio</label>
                            <input type="date" name="inicio" id="inicio" class="form-control"  require/>
                            <br>
                        </div>
                        <div class="col-3">
                            <label for="fin">Fecha Fin</label>
                            <input type="date" name="fin" id="fin" class="form-control"  require/>
                            <br>
                        </div>
                        <div class="col-3">
                            <label for="limite">Fecha Limite</label>
                            <input type="date" name="limite" id="limite" class="form-control"  require/>
                            <br>
                        </div>

                    </div>

                    <div class="col-12">
                            <div class="col-4">
                                <label for="cant">N° Disponibles</label>
                                <input type="number" name="cant" id="cant" class="form-control" placeholder="1" step="1" require/>
                                <br>
                            </div>
                            <div class="col-6">
                                <label for="cant">Estado</label>
                                <input type="text" name="estado" id="estado" class="form-control" value="1" placeholder="Espera" readonly/>
                                <br>
                            </div>
                    </div>
                    
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" col="3" require> Describe tu oferta</textarea>
                    <br>
  
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_ofertas.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>
        </div>
   
        <!-- ENVIO DE DATOS -->
        <?php
            if(isset($_POST["submit"])){
                

                //verificar la conexion
                if ($conn == null){
                    die("No se ha podido conectar con la base de datos :(");
                }

                if($_POST["empresa"]!=""){

                $sql = "INSERT INTO tblCupones(tituloOferta, idSucursal, precioRegular, precioOferta,fechaInicio, fechaFin, fechaLimite, cantidad, estado, descripcion)
                        VALUES ('".$_POST["nombre"]."','".$_POST["empresa"]."','".$_POST["precioRegular"]."',
                        '".$_POST["precioOferta"]."','".$_POST["inicio"]."','".$_POST["fin"]."','".$_POST["limite"]."','".$_POST["cant"]."','".$_POST["estado"]."','".$_POST["descripcion"]."')";

                $count = $conn->exec($sql);

                if($count > 0){
                    echo "<div class=\"alert alert-success \" role=\"alert\" >";
                    echo "Se ha guardado el Registro!! :)";
                    echo "</div>";
                }else{
                    echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                    echo "No se ha guardado el Registro!! :'( \n";
                    echo "</br>";
                    echo "Error: ". $sql;
                    print_r($conn->errorInfo());
                    echo "</div>";
                }
            }
            else{
                echo "<div class='alert alert-danger' role='alert'> ";
                    echo "Aun faltan datos por llenar :'(";
                echo "</div>";
            }
                CloseCon($conn);
            }

        //incluimos footer
        include "../../Share/footer.php";
        ?>
