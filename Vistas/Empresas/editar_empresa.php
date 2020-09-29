<?php
    
    include "../../Share/header.php";
    
   if($_GET){
       //CONEXION
       include "../../Share/conexion.php";
       $conn=OpenCon();

       //extraemos datos
       $id=$_GET["codigo"];
    //    $sql="SELECT*FROM tblClientes WHERE idCliente=?";
        $sql="SELECT e.idEmpresa as id, e.nombreEmpresa, e.telefono, e.codigoEmpresa, e.direccion, r.nombreRubro as rubro, e.porcentajeComision, e.idRubro FROM tblEmpresas e
            INNER JOIN tblRubros r ON e.idRubro = r.idRubro WHERE e.idEmpresa=$id";
       $stmm = $conn->prepare($sql);
       $stmm->execute(array($id));
       $row=$stmm->fetchAll(PDO::FETCH_OBJ);
       foreach($row as $row){}

       //para los rubros en select
       $consultaRubro="SELECT *FROM tblRubros";
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
    <title>Empresas</title>
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="text-center">Editar Empresa</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-7 col-sm-12">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $row->nombreEmpresa ?>" require/>
                            <br>
                        </div>
                        
                        <div class="col-md-5 col-sm-12">
                            <label for="codigo">codigo</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $row->codigoEmpresa ?>" readonly require/>
                             <br>        
                        </div>
                    </div>

                    <div class="row col-12 form-group">
                        <div class="col-md-7 col-sm-12">
                            <label for="rubro">Rubro</label>
                            <select type="text" name="rubro" id="rubro" class="form-control" require>
                                <option value="<?php echo $row->idRubro ?>"><?php echo $row->rubro?></option>
                                <?php
                                    foreach ($conn->query($consultaRubro) as $valor) {
                                        echo "<option value='".$valor["idRubro"]."'>".$valor["nombreRubro"]."</option>";
                                    }
                                ?>
                            </select>
                            <br>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <label for="comision">Comision</label>
                            <input type="number" name="comision" id="comision" class="form-control"  placeholder="%" value="<?php echo $row->porcentajeComision?>" require/>
                            <br>
                            </div>
                    </div>
                    <div class="col-12">
                        <label for="direccion">Direccion</label>
                        <textarea type="text" name="direccion" id="direccion" class="form-control" col="3" require><?php echo $row->direccion ?></textarea>
                        <br>
                    </div>
                    
                    <div class="row col-12 form-group">
                        <div class="col-md-5 col-sm-12"> 
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $row->telefono ?>" require/>
                            <br>
                        </div>
                            
                        <div class="col-md-7 col-sm-12">
                            <label for="correo">Correo Electronico</label>
                            <input type="email" name="correo" id="correo" class="form-control" placeholder="alguien@gmail.com" require/>
                            <br>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->idRubro ?>"/>
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success"/>
                    <a href="listado_empresas.php" class="btn btn-info">Regresar</a>
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

                        $sql = "UPDATE tblEmpresas SET nombreEmpresa='".$_POST["nombre"]."', codigoEmpresa='".$_POST["codigo"]."', correo='".$_POST["correo"]."', telefono='".$_POST["telefono"]."', idRubro='".$_POST["rubro"]."',
                            direccion='".$_POST["direccion"]."', porcentajeComision='".$_POST["comision"]."' WHERE idEmpresa='".$_POST["id"]."'";
                        $codigo=$_POST["id"];        
                        $count = $conn->exec($sql);
                        if($count > 0){

                            echo "<script type='text/javascript'>alert('Se ha modificado la informacion del Registro');</script>";
                            
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
