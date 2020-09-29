
    <?php
    
    include "../../Share/header.php";
    
   if($_GET){
       //CONEXION
       include "../../Share/conexion.php";
       $conn=OpenCon();

       //extraemos datos
       $id=$_GET["codigo"];
       $sql="SELECT*FROM tblClientes WHERE idCliente=?";
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

   <title>Cliente</title>

   <div class="col-md-8 offset-2">
       <div class="card">
           <div class="card-header bg-warning">
               <h4 class="text-center ">Editar</h4>
           </div>
           <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombreCliente">Nombre</label>
                            <input type="text" name="nombreCliente" id="nombreCliente" class="form-control" value="<?php echo $row->nombresCliente?>" require/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="apellidoCliente">Apellido</label>
                            <input type="text" name="apellidoCliente" id="apellidoCliente" class="form-control" value="<?php echo $row->apellidosClientes?>" require/>
                            <br>
                        </div>
                    </div>

                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $row->telefono?>" require/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="correo">Correo Electronico</label>
                            <input type="email" name="correo" id="correo" class="form-control" value="<?php echo $row->correoCliente?>" require/>
                            <br>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="direccion">Direccion</label>
                        <textarea type="text" name="direccion" id="direccion" class="form-control" col="3" value="" require><?php echo $row->direccionCliente?></textarea>
                        <br>
                    </div>

                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="dui">DUI</label>
                            <input type="text" name="dui" id="dui" class="form-control" value="<?php echo $row->dui?>" require/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control" value="<?php echo $row->estado?>" readonly/>
                            <br>
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->idCliente?>" require/>
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_clientes.php" class="btn btn-info">Regresar</a>
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

                        $sql = "UPDATE tblClientes SET nombresCliente='".$_POST["nombreCliente"]."', apellidosClientes='".$_POST["apellidoCliente"]."', telefono='".$_POST["telefono"]."', correoCliente='".$_POST["correo"]."',
                            direccionCliente='".$_POST["direccion"]."', dui='".$_POST["dui"]."', estado='".$_POST["estado"]."' WHERE idCliente='".$_POST["id"]."'";
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
