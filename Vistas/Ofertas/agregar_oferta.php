<?php
include "../../Share/header.php";
include '../../Share/conexion.php';
 $conn=OpenCon();
    $consultaSucursal="SELECT *FROM tblSucursales";
?>
    <title>Oferta</title>
    <div class="col-md-8 offset-md-2 col-sm-12">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-center  font-weight-bold">Agregar Oferta</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-7 col-sm-12">
                            <label for="nombre">Titulo</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" require/>
                            <br>
                        </div>
                        
                        <div class="col-md-5 col-sm-12">
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
                        </div>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="precioRegular">Precio Regular</label>
                            <input type="number" name="precioRegular" id="precioRegular" step="0.5" class="form-control" placeholder="$1.25" require/>
                            <br>
                        </div>  
                        <div class="col-md-6 col-sm-12">
                            <label for="precioOferta">Precio Oferta</label>
                            <input type="number" name="precioOferta" id="precioOferta" step="0.5" class="form-control" placeholder="$1.25" require/>
                            <br>
                        </div>
                    </div>

                    <div class="row col-12 form-group">
                        <div class="col-md-4 col-sm-12">
                            <label for="inicio">Fecha Inicio</label>
                            <input type="date" name="inicio" id="inicio" class="form-control" min="<?php date("Y-m-d") ?>" value="<?php date("Y-m-d") ?>" require/>
                            <br>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="fin">Fecha Fin</label>
                            <input type="date" name="fin" id="fin" class="form-control" min="<?php date("Y-m-d") ?>" require/>
                            <br>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="limite">Fecha Limite</label>
                            <input type="date" name="limite" id="limite" min class="form-control" min="<?php date("Y-m-d") ?>"  require/>
                            <br>
                        </div>

                    </div>

                    <div class="row col-12 form-group">
                            <div class="col-md-4 col-sm-12">
                                <label for="cant">N° Disponibles</label>
                                <input type="number" name="cant" id="cant" class="form-control" placeholder="1" step="1"/>
                                <br>
                            </div>
                            
                            <div class="col-md-8 col-sm-12">
                                <label for="cant">Estado</label>
                                <input type="text" class="form-control" value="En Espera de Aprobacion" readonly/>
                                <input type="hidden" name="estado" id="estado" class="form-control" value="1" placeholder="Espera" readonly/>
                                <br>
                            </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="descripcion">Descripcion</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" col="3" placeholder="Describe tu oferta" require> </textarea>
                        <br>
                    </div>

                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_ofertas.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>
            
            

            <div class="card-footer">                    
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){
                        

                        //verificar la conexion
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :(");
                        }

                        if($_POST["empresa"]!="" && $_POST["nombre"]!=""  && $_POST["precioRegular"]!=""  && $_POST["precioOferta"]!="" && $_POST["inicio"]!="" && $_POST["fin"]!=""  && $_POST["limite"]!=""  && $_POST["cant"]!="" && $_POST["descripcion"]!=""){

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
                echo "
            </div>
        </div>
    </div>";//fin del div card-footer, CARD, COL
        
        //incluimos footer
        include "../../Share/footer.php";
        ?>
