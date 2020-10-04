<?php
include "../../Share/header.php";
?>
    <title>Clientes</title>
    <div class="col-md-8 offset-md-2 col-sm-12">
        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-center">Agregar Cliente</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="form">
                   
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombreCliente">Nombre</label>
                            <input type="text" name="nombreCliente" id="nombreCliente" class="form-control" require/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="apellidoCliente">Apellido</label>
                            <input type="text" name="apellidoCliente" id="apellidoCliente" class="form-control" require/>
                            <br>
                        </div>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" require/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="correo">Correo Electronico</label>
                            <input type="email" name="correo" id="correo" class="form-control" require/>
                            <br>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="direccion">Direccion</label>
                        <textarea type="text" name="direccion" id="direccion" class="form-control" col="3" placeholder="Ingrese su direccion" require></textarea>
                        <br>
                    </div>

                    <div class="row col-12 form-group">
                        <div class="col-md-4 col-sm-12">
                            <label for="dui">DUI</label>
                            <input type="text" name="dui" id="dui" class="form-control" placeholder="0000000-0" require/>
                            <br>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="clave">Contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" require/>
                            <br>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control" value="No Verificado" readonly require/>

                            <!-- <select type="text" name="estado" id="estado" class="form-control" require>
                                <option value="verificado" >Verificado</option>
                                <option value="noVerificado">No Verificado</option>
                            </select> -->
                            <br>
                        </div>
                    </div>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_clientes.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>

            <div class="card-footer">
   
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){
                        include '../../Share/conexion.php';
                        $conn=OpenCon();

                        //verificar la conexion
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :(");
                        }

                        if($_POST["nombreCliente"]!="" && $_POST["apellidoCliente"] != "" && $_POST["telefono"]!="" && $_POST["correo"]!="" && $_POST["direccion"]!="" && $_POST["dui"]!="" &&$_POST["clave"]!=""){
                            $clave=password_hash($_POST["clave"], PASSWORD_DEFAULT);//clave encriptada
                            $sql = "INSERT INTO tblClientes(nombresCliente, apellidosClientes, telefono, correoCliente, direccionCliente,dui,password,estado)
                                    VALUES ('".$_POST["nombreCliente"]."','".$_POST["apellidoCliente"]."','".$_POST["telefono"]."','".$_POST["correo"]."',
                                    '".$_POST["direccion"]."','".$_POST["dui"]."','".$clave."','".$_POST["estado"]."')";

                            $count = $conn->exec($sql);

                            if($count > 0){
                                Print"    <script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se Ha registrado el Cliente!',
                                })
                                </script>";
                            }else{
                                Print"    <script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'OPPS!',
                                  text: 'No se Ha realizado el Registro!',
                                })
                                </script>";
                            }
                            CloseCon($conn);
                        }
                        else{
                            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                                echo "Aun faltan campos por llenar!! :<";
                                echo "</div>";
                        }
                    }
                echo "
            </div>
        </div>
    </div>";//fin del div card-footer, CARD, COL

        //incluimos footer
        include "../../Share/footer.php";
        ?>
