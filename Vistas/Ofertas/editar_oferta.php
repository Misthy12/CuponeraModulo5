<?php
    
    include "../../Share/header.php";
    
   if($_GET){
       //CONEXION
       include "../../Share/conexion.php";
       $conn=OpenCon();

       //extraemos datos
       $id=$_GET["codigo"];
        $sql="SELECT o.idCupon as id,o.tituloOferta as nombre, s.nombreSucursal as sucursal, o.idSucursal, o.precioRegular, o.precioOferta, o.fechaInicio, 
            o.fechaFin, o.fechaLimite, o.cantidad, o.descripcion, ce.definirEstado as estado, o.estado as idEstado  FROM tblCupones o
            INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal
            INNER JOIN tblEstadosCupon ce ON o.estado = ce.idEstadoCupon
            WHERE o.idCupon=$id";
       $stmm = $conn->prepare($sql);
       $stmm->execute(array($id));
       $row=$stmm->fetchAll(PDO::FETCH_OBJ);
       foreach($row as $row){}

       //para los rubros en select
        $consultaSucursal="SELECT *FROM tblSucursales";
        $consultaEstado="SELECT *FROM tblEstadosCupon";
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
<title>Oferta</title>

<div class="col-md-8 offset-md-2 col-sm-12">
    <div class="card">
        <div class="card-header bg-warning">
            <h3 class="text-center font-weight-bold">Editar Oferta</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">

                <div class="row col-12 form-group">
                    <div class="col-md-7 col-sm-12">
                        <label for="nombre">Titulo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $row->nombre ?>"  required/>
                        <br>
                    </div>
                    
                    <div class="col-md-5 col-sm-12">
                        <label for="sucursal">Sucursal</label>
                        <select type="text" name="sucursal" id="sucursal" class="form-control"  required>
                        <option value="<?php echo $row->idSucursal ?>" ><?php echo $row->sucursal?></option>
                        <?php
                                foreach ($conn->query($consultaSucursal) as $valor) {
                                    echo "<option value='".$valor["idSucursal"]."'>".$valor["nombreSucursal"]."</option>";
                                }
                            ?>
                        </select>
                        <br>
                     </div>
                </div>

                <div class="row col-12 form-group">
                    <div class="col-md-6 col-sm-12">
                        <label for="precioRegular">Precio Regular</label>
                        <input type="number" name="precioRegular" id="precioRegular" step="0.5" class="form-control" value="<?php echo $row->precioRegular ?>"  required/>
                        <br>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="precioOferta">Precio Oferta</label>
                        <input type="number" name="precioOferta" id="precioOferta" step="0.5" class="form-control" value="<?php echo $row->precioOferta ?>"  required/>
                        <br>
                    </div>
                </div>

                <div class="row col-12 form-group">
                    <div class="col-md-4 col-sm-12">
                        <label for="inicio">Fecha Inicio</label>
                        <input type="date" name="inicio" id="inicio" class="form-control" value="<?php echo $row->fechaInicio ?>"  required/>
                        <br>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="fin">Fecha Fin</label>
                        <input type="date" name="fin" id="fin" class="form-control" value="<?php echo $row->fechaFin ?>"   required/>
                        <br>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="limite">Fecha Limite</label>
                        <input type="date" name="limite" id="limite" class="form-control" value="<?php echo $row->fechaLimite ?>"   required/>
                        <br>
                    </div>

                </div>

                <div class="row col-12 form-group">
                        <div class="col-md-4 col-sm-12">
                            <label for="cant">N° Disponibles</label>
                            <input type="number" name="cant" id="cant" class="form-control" value="<?php echo $row->cantidad ?>"  step="1" required/>
                            <br>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <label for="estado">Estado</label>
                            <select type="text" name="estado" id="estado" class="form-control"  required>
                                <option value="<?php echo $row->idEstado ?>" ><?php echo $row->estado?></option>
                                 <?php
                                    foreach ($conn->query($consultaEstado) as $valor) {
                                        echo "<option value='".$valor["idEstadoCupon"]."'>".$valor["definirEstado"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                </div>
                
                <div class="col-12">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" col="3" required><?php echo $row->descripcion ?> </textarea>
                    <br>
                </div>
                                    
                <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->id ?>"  required/>
                
                <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                <a href="listado_ofertas.php" class="btn btn-info">Regresar</a>
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

                    if($_POST["sucursal"]!="" && $_POST["nombre"]!=""  && $_POST["precioRegular"]!=""  && $_POST["precioOferta"]!="" && $_POST["inicio"]!="" && $_POST["fin"]!=""  && $_POST["limite"]!=""  && $_POST["cant"]!="" && $_POST["descripcion"]!=""){

                        $sql = "UPDATE tblCupones SET tituloOferta='".$_POST["nombre"]."', idSucursal='".$_POST["sucursal"]."', precioRegular='".$_POST["precioRegular"]."', precioOferta='".$_POST["precioOferta"]."', fechaInicio='".$_POST["inicio"]."',
                        fechaFin='".$_POST["fin"]."', fechaLimite='".$_POST["limite"]."', cantidad='".$_POST["cant"]."', descripcion='".$_POST["descripcion"]."', estado='".$_POST["estado"]."' WHERE idCupon='".$_POST["id"]."'";
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
                    else{
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
