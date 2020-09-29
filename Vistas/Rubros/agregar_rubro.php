<?php
include "../../Share/header.php";
?>
    <title>Rubros</title>
    <div class="col-md-8 offset-md-2 col-sm-12">
        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-center">Agregar Rubro</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <label for="nombreRubro">Nombre</label>
                    <input type="text" name="nombreRubro" id="nombreRubro" class="form-control" require/>
                    <br>
 
                    <label for="descripcion">Descripcion</label>
                    <textarea type="text" name="descripcion" id="descripcion" class="form-control" row="3" require></textarea>
                    <br>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_rubros.php" class="btn btn-info">Regresar</a>
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

                        $sql = "INSERT INTO tblRubros(nombreRubro, descripcion)
                                VALUES ('".$_POST["nombreRubro"]."','".$_POST["descripcion"]."')";

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
                    echo "
            </div>
        </div>
    </div>";//fin del div card-footer, CARD, COL

        //incluimos footer
       include "../../Share/footer.php";
    ?>
