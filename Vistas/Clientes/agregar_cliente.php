<?php
include "../../Share/header.php";
?>
    <title>Autores</title>

        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-center">Agregar Cliente</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <label for="nombreCliente">Nombre</label>
                    <input type="text" name="nombreCliente" id="nombreCliente" class="form-control" require/>
                    <br>

                    <label for="apellidoCliente">Apellido</label>
                    <input type="text" name="apellidoCliente" id="apellidoCliente" class="form-control" require/>
                    <br>

                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" require/>
                    <br>
                    <label for="correo">Correo Electronico</label>
                    <input type="email" name="correo" id="correo" class="form-control" require/>
                    <br>
                    <label for="direccion">Direccion</label>
                    <textarea type="text" name="direccion" id="direccion" class="form-control" col="3" require></textarea>
                    <br>
                    <label for="dui">DUI</label>
                    <input type="text" name="dui" id="dui" class="form-control" require/>
                    <br>
                    <label for="clave">Contraseña</label>
                    <input type="text" name="clave" id="clave" class="form-control" require/>
                    <br>
                    <label for="estado">Estado</label>
                    <select type="text" name="estado" id="estado" class="form-control" require>
                        <option value="verificado">Verificado</option>
                        <option value="noVerificado">No Verificado</option>
                    </select>
                    <br>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_clientes.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>
        </div>
   
        <!-- ENVIO DE DATOS -->
        <?php
            if(isset($_POST["submit"])){
                include '../../Share/conexion.php';
                $conn=OpenCon();

                //verificar la conexion
                if ($conn == null){
                    die("No se ha podido conectar con la base de datos :(");
                }

                $sql = "INSERT INTO tblClientes(nombresCliente, apellidosClientes, telefono, correoCliente, direccionCliente,dui,password,estado)
                        VALUES ('".$_POST["nombreCliente"]."','".$_POST["apellidoCliente"]."','".$_POST["telefono"]."','".$_POST["correo"]."',
                        '".$_POST["direccion"]."','".$_POST["dui"]."','".$_POST["clave"]."','".$_POST["estado"]."')";

                $count = $conn->exec($sql);

                if($count > 0){
                    echo "<div class=\"alert alert-success \" role=\"alert\" >";
                    echo "Se ha guardado el Registro!! :)";
                    echo "</div>";
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

        //incluimos footer
        include "../../Share/footer.php";
        ?>
