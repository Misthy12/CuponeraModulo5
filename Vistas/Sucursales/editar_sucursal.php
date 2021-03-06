<?php
    
    include "../../Share/header.php";
    
   if($_GET){
       //CONEXION
       include "../../Share/conexion.php";
       $conn=OpenCon();

       //extraemos datos
       $id=$_GET["codigo"];
       $sql="SELECT s.idSucursal as id, s.idEmpresa, s.nombreSucursal, s.nombreEncargadoSuc as encargado, e.nombreEmpresa as empresa, s.correo, s.password FROM tblSucursales s
            INNER JOIN tblEmpresas e ON s.idEmpresa = e.idEmpresa WHERE s.idSucursal=$id";
       $stmm = $conn->prepare($sql);
       $stmm->execute(array($id));
       $row=$stmm->fetchAll(PDO::FETCH_OBJ);
       foreach($row as $row){}

       //para los rubros en select
       $consultaEmpresas="SELECT *FROM tblEmpresas";
     CloseCon($conn);
     }
     else
     { 
      $id="";
        echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
         <strong>Error</strong> No se han enviado variables</div>";
     }
     
   ?>

<!-- CUERPO DE LA PAGINA -->
    <div class="col-md-8 offset-md-2 col-sm-12">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="text-center font-weight-bold">Editar Sucursal</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-7 col-sm-12">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $row->nombreSucursal ?>" required/>
                            <br>
                        </div>
                    
                        <div class="col-md-5 col-sm-12">
                            <label for="empresa">Empresa</label>
                            <select type="text" name="empresa" id="empresa" class="form-control"  required>
                            <option value="<?php echo $row->idEmpresa ?>"><?php echo $row->empresa?></option>
                            
                                <?php
                                    foreach ($conn->query($consultaEmpresa) as $valor) {
                                        echo "<option value='".$valor["idEmpresa"]."'>".$valor["nombreEmpresa"]."</option>";
                                    }
                                ?>
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="encargado">Encargado</label>
                        <input type="text" name="encargado" id="encargado" class="form-control" value="<?php echo $row->encargado ?>" required/>
                        <br>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="correo">Correo</label>
                            <input type="email" name="correo" id="correo" readonly class="form-control" placeholder="alguien.mas@gmail.com" value="<?php echo $row->correo ?>" required/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="clave">Contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" value="<?php echo $row->clave?>" required/>
                            <br>
                        </div>
                    </div>
                    
                    <!-- <label for="direccion">Direccion</label>
                    <textarea type="text" name="direccion" id="direccion" class="form-control" col="3" require></textarea>
                    <br> -->
                    
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->id ?>"/>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_sucursales.php" class="btn btn-info">Regresar</a>
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

                        if($_POST["nombre"]!="" && $_POST["empresa"] != "" && $_POST["encargado"]!="" && $_POST["correo"]!="" && $_POST["clave"]!=""){
                            $clave=password_hash($_POST["clave"], PASSWORD_DEFAULT);//clave encriptada

                            $sql = "UPDATE tblSucursales SET nombreSucursal='".$_POST["nombre"]."', idEmpresa='".$_POST["empresa"]."', nombreEncargadoSuc='".$_POST["encargado"]."',
                                password='".$clave."', correo='".$_POST["correo"]."' WHERE idSucursal='".$_POST["id"]."'";
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
                        }else{
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
