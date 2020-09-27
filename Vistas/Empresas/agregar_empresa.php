<?php
include "../../Share/header.php";
include '../../Share/conexion.php';
 $conn=OpenCon();
    $consultaRubro="SELECT *FROM tblRubros";
?>
    <title>Empresas</title>

        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-center">Agregar Empresa</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" require/>
                    <br>

                    <label for="codigo">codigo</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" require/>
                    <br>

                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" require/>
                    <br>
                    
                    <label for="direccion">Direccion</label>
                    <textarea type="text" name="direccion" id="direccion" class="form-control" col="3" require></textarea>
                    <br>
                    <label for="rubro">Rubro</label>
                    <select type="text" name="rubro" id="rubro" class="form-control" require>
                    <?php
                            foreach ($conn->query($consultaRubro) as $valor) {
                                echo "<option value='".$valor["idRubro"]."'>".$valor["nombreRubro"]."</option>";
                            }
                        ?>
                    </select>
                    <br>
                    <label for="comision">Comision</label>
                    <input type="number" name="comision" id="comision" class="form-control" step="0.1" placeholder="%" require/>
                    <br>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_empresas.php" class="btn btn-info">Regresar</a>
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

                $sql = "INSERT INTO tblEmpresas(nombreEmpresa, codigoEmpresa, telefono, direccion,idRubro,porcentajeComision)
                        VALUES ('".$_POST["nombre"]."','".$_POST["codigo"]."','".$_POST["telefono"]."',
                        '".$_POST["direccion"]."','".$_POST["rubro"]."','".$_POST["comision"]."')";

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
