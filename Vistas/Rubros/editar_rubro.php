
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
   <div class="col-md-8 offset-2">
       <div class="card">
           <div class="card-header bg-warning">
               <h4 class="text-center">Editar</h4>
           </div>
           <div class="card-body">
                <form action="" method="POST">
                    <label for="nombreRubro">Nombre</label>
                    <input type="text" name="nombreRubro" id="nombreRubro" class="form-control" value="<?php echo $row->nombreRubro ?>" require/>
                    <br>

                    <label for="descripcion">Descripcion</label>
                    <textarea type="text" name="descripcion" id="descripcion" class="form-control" row="3" require><?php echo $row->descripcion ?></textarea>
                    <br>
                    <!-- extraer el id -->
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->idRubro ?>" require/>
                    
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

                        $sql = "UPDATE tblRubros SET nombreRubro='".$_POST["nombreRubro"]."', descripcion='".$_POST["descripcion"]."' WHERE idRubro='".$_POST["id"]."'";
                        $codigo=$_POST["id"];        
                        $count = $conn->exec($sql);
                        if($count > 0){

                            echo "<script type='text/javascript'>alert('Se ha modificado la informacion del Cliente');</script>";
                            
                            
                        }else{
                            echo "<div class=\"alert alert-danger\" role=\"alert\" >";
                            echo "No se ha modificado la informacion!\n";
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

