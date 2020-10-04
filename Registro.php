<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Copatibilidad -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Titulo Proyecto -->
    <title>Cuponera</title>
          <!-- Theme Alert -->
  
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../Tools/lib/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../Tools/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="Tools/lib/sweetAlert2/asweetalert2.min.css">
</head>
<body>

<title>Clientes</title>
<br>
    <div class="col-md-6 offset-md-3 col-sm-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="text-center text-uppercase">Registro</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="form">
                   
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombreCliente">Nombre</label>
                            <input type="text" name="nombreCliente" id="nombreCliente" class="form-control" require/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="apellidoCliente">Apellido</label>
                            <input type="text" name="apellidoCliente" id="apellidoCliente" class="form-control" require/>
                            <br>
                        </div>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" require/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="correo">Correo Electronico</label>
                            <input type="email" name="correo" id="correo" class="form-control" require/>
                            <br>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="direccion">Direccion</label>
                        <textarea type="text" name="direccion" id="direccion" class="form-control" col="3" placeholder="Ingrese su direccion" require></textarea>
                        <br>
                    </div>

                    <div class="row col-12 form-group">
                        <div class="col-md-4 col-sm-12">
                            <label for="dui">DUI</label>
                            <input type="text" name="dui" id="dui" class="form-control" placeholder="0000000-0" require/>
                            <br>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="clave">Contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" require/>
                            <br>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control" value="No Verificado" readonly require/>

                            <!-- <select type="text" name="estado" id="estado" class="form-control" require>
                                <option value="verificado" >Verificado</option>
                                <option value="noVerificado">No Verificado</option>
                            </select> -->
                            <br>
                        </div>
                    </div>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="index.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>

            </div>
        </div>
    </div>
    <br>
    <hr>
    <footer class="main-footer text-center">
         <details>
            <summary><strong>Copyright &copy; 2020 <a href="http://adminlte.io">Alondra Nestor Keyssi Fidel</a>.</strong></summary>
                <!-- <p><a href="mailto:nancycolatoam@gmail.com">nancycolatoam@gmail.com</a></p> -->
                Todos los derechos reservados.
                <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> Beta
                </div>
        </details> 
    </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
 
    <!-- jQuery -->
    <script src="../../Tools/lib/jquery/dist/jquery.min.js"></script>
    <script src="../../Tools/lib/jquery/dist/jquery.validate.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../Tools/lib/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="../../Tools/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- OTON PARA MENU -->
    <!-- <script>
         $.widget.bridge('uibutton', $.ui.button);
    </script> -->
    <!-- Bootstrap 4 -->
    <!-- Alert -->
    <script src="Tools/lib/sweetAlert2/sweetalert2.all.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../Tools/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../Tools/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../Tools/dist/js/demo.js"></script>
</body>
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){
                        include 'Share/conexion.php';
                        $conn=OpenCon();

                        //verificar la conexion
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :(");
                        }

                        if($_POST["nombreCliente"]!="" && $_POST["apellidoCliente"] != "" && $_POST["telefono"]!="" && $_POST["correo"]!="" && $_POST["direccion"]!="" && $_POST["dui"]!="" &&$_POST["clave"]!=""){
                            $clave=password_hash($_POST["clave"], PASSWORD_DEFAULT);//clave encriptada
                            $sql = "INSERT INTO tblClientes(nombresCliente, apellidosClientes, telefono, correoCliente, direccionCliente,dui,password,estado)
                                    VALUES ('".$_POST["nombreCliente"]."','".$_POST["apellidoCliente"]."','".$_POST["telefono"]."','".$_POST["correo"]."',
                                    '".$_POST["direccion"]."','".$_POST["dui"]."','".$clave."','".$_POST["estado"]."')";

                            $count = $conn->exec($sql);

                            if($count > 0){
                                Print"<script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se Ha registrado el Cliente!',
                                })
                                </script>";
                            }else{
                                Print"<script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'OPPS!',
                                  text: 'No se Ha realizado el Registro!',
                                })
                                </script>";
                            }
                            CloseCon($conn);
                        }
                        else{
                            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                                echo "Aun faltan campos por llenar!! :<";
                                echo "</div>";
                        }
                    }
                    ?>
</html>