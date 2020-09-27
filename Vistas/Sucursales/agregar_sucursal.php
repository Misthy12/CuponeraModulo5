<?php
include "../../Share/header.php";
include '../../Share/conexion.php';
 $conn=OpenCon();
    $consultaEmpresa="SELECT *FROM tblEmpresas";
?>
    <title>Sucursal</title>

        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-center">Agregar Sucursal</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" require/>
                    <br>

                    <label for="empresa">Empresa</label>
                    <select type="text" name="empresa" id="empresa" class="form-control" require>
                    <?php
                            foreach ($conn->query($consultaEmpresa) as $valor) {
                                echo "<option value='".$valor["idEmpresa"]."'>".$valor["nombreEmpresa"]."</option>";
                            }
                        ?>
                    </select>
                    <br>

                    <label for="encargado">Encargado</label>
                    <input type="text" name="encargado" id="encargado" class="form-control" require/>
                    <br>

                    <label for="clave">Contraseña</label>
                    <input type="text" name="clave" id="clave" class="form-control" require/>
                    <br>
                    
                    <!-- <label for="direccion">Direccion</label>
                    <textarea type="text" name="direccion" id="direccion" class="form-control" col="3" require></textarea>
                    <br> -->
                    
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="alguien.mas@gmail.com" require/>
                    <br>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_sucursales.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>
        </div>
   
        <!-- ENVIO DE DATOS -->
        <?php
            if(isset($_POST["submit"])){
                // include '../../Share/conexion.php';
                // $conn=OpenCon();

                //verificar la conexion
                if ($conn == null){
                    die("No se ha podido conectar con la base de datos :(");
                }

                $sql = "INSERT INTO tblSucursales(nombreSucursal, idEmpresa, nombreEncargadoSuc, password,correo)
                        VALUES ('".$_POST["nombre"]."','".$_POST["empresa"]."','".$_POST["encargado"]."',
                        '".$_POST["clave"]."','".$_POST["correo"]."')";

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
                CloseCon($conn);
            }

        //incluimos footer
        include "../../Share/footer.php";
        ?>
