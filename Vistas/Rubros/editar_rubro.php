
    <?php
    
    include "../../Share/header.php";
    
   if($_GET){
       //CONEXION
       include "../../Share/conexion.php";
       $conn=OpenCon();

       //extraemos datos
       $id=$_GET["codigo"];
       $sql="SELECT*FROM tblRubros WHERE idRubro=?";
       $stmm = $conn->prepare($sql);
       $stmm->execute(array($id));
       $row=$stmm->fetchAll(PDO::FETCH_OBJ);
       foreach($row as $row){}
     CloseCon($conn);
     }
     else
     {
      $id="";
        echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
         <strong>Error</strong> No se han enviado variables</div>";
     }
      
   ?>

   <title>Rubros</title>
   <div class="col-md-8 offset-md-2 col-sm-12">
       <div class="card">
           <div class="card-header bg-warning">
               <h4 class="text-center">Editar</h4>
           </div>
           <div class="card-body">
                <form action="" method="POST">
                    <label for="nombreRubro">Nombre</label>
                    <input type="text" name="nombreRubro" id="nombreRubro" class="form-control" value="<?php echo $row->nombreRubro ?>" required/>
                    <br>

                    <label for="descripcion">Descripcion</label>
                    <textarea type="text" name="descripcion" id="descripcion" class="form-control" row="3" required><?php echo $row->descripcion ?></textarea>
                    <br>
                    <!-- extraer el id -->
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->idRubro ?>" required/>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_rubros.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>

            <div class="card-footer"> 
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){

                        //verificar la conexion
                        
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :'( ");
                        }

                        if($_POST["nombreRubro"]!="" && $_POST["nombreRubro"]!=" "){
                            $sql = "UPDATE tblRubros SET nombreRubro='".$_POST["nombreRubro"]."', descripcion='".$_POST["descripcion"]."' WHERE idRubro='".$_POST["id"]."'";
                            $codigo=$_POST["id"];        
                            $count = $conn->exec($sql);
                            if($count > 0){
                                Print"<script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se Ha Actualizado el registrado!',
                                })
                                </script>";
                            }else{
                                Print"<script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'OPPS!',
                                  text: 'No se Ha realizado la actualización!',
                                })
                                </script>";
                            }
                            CloseCon($conn);
                        }
                        else{
                            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                            echo "Aun faltan campos por llenar!! :(";
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

