
    <?php
    
    include "../../Share/header.php";
    
   if($_GET){
       //CONEXION
       include "../../Share/conexion.php";
       $conn=OpenCon();

       //extraemos datos
       $id=$_GET["codigo"];
       $sql="SELECT*FROM tblusuarios WHERE idUsuario=?";
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

   <title>Usuarios</title>

   <div class="col-md-8 offset-md-2 col-sm-12">
       <div class="card">
           <div class="card-header bg-warning">
               <h4 class="text-center ">Editar</h4>
           </div>
           <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombreCliente">Nombre</label>
                            <input type="text" name="nombreCliente" id="nombreCliente" class="form-control" value="<?php echo $row->nombreUsuario?>" required/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="correo">Correo Electronico</label>
                            <input type="email" name="correo" id="correo" class="form-control" value="<?php echo $row->email?>" required/>
                            <br>
                        </div>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12" hidden>
                            <label for="clave">Contraseña</label>
                            <input type="text" name="clave" id="clave" class="form-control" value="<?php echo $row->password?>" required/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12" hidden>
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control" value="<?php echo $row->estado?>" readonly/>
                            <br>
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->idUsuario?>" required/>
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    
                    <?php
                        if($_SESSION["login"] ="Admin"){
                            echo "<a href='../Usuarios/listado_usuarios.php' class='btn btn-warning'>Regresar</a>";
                        }
                    ?>
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

                        if($_POST["nombreUsuario"]!="" && $_POST["correo"]!=""){

                            $sql = "UPDATE tblusuarios SET nombreUsuario='".$_POST["nombreUsuario"]."', email='".$_POST["correo"]."', estado='".$_POST["estado"]."' WHERE idUsuario='".$_POST["id"]."'";
                            $codigo=$_POST["id"];        
                            $count = $conn->exec($sql);
                            if($count > 0){

                                echo "<script type='text/javascript'>alert('Se ha modificado la informacion del Usuario');</script>";
                                
                                
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
