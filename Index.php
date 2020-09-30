<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Cuponera</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./Tools/lib/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="./Tools/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./Tools/css/cssLogin.css">
  <!-- Theme Alert -->
  <link rel="stylesheet" href="Tools/lib/sweetAlert2/asweetalert2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" id="login">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
        <div class="login-logo card-header">
          <a href="#" class="text-uppercase font-weight-bold "><em>La Cuponera</em></a>
        </div>
      <div class="card-body login-card-body">
        <div class="text-center"><i class="fas fa-user-circle text-center fa-4x"></i></div>
        <p class="login-box-msg h5">Iniciar Sesión</p>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Cliente</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Empresa</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Administrador</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <label for="remember">
                  <a href="Vistas/Clientes/agregar_cliente.php">Registrarme</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="btnCliente" name="btnCliente" class="btn btn-primary btn-block">INICIAR</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <form action="" method="post">
    <div class="input-group mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="btnEmpresa" name="btnEmpresa" class="btn btn-primary btn-block">INICIAR</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <form action="" method="post">
    <div class="input-group mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="btnAdmin" name="btnAdmin" class="btn btn-primary btn-block">INICIAR</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>
  </div>
        
      </div>
      <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="Tools/lib/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Tools/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="Tools/dist/js/adminlte.min.js"></script>
<!-- Alert -->
<script src="Tools/lib/sweetAlert2/sweetalert2.all.min.js"></script>

</body>
</html>
<?php
include("Share/conexion.php"); //incluimos el archivo que se conecta a la base de datos
$conn=OpenCon();
if (isset($_POST['btnCliente'])) { //comprobamos si se envían variables desde el form por el método POST
  $email=$_POST["email"]; //Capturamos lo digitado por el usuario en la caja de texto de nombre usuario
  $clave=$_POST["password"];//Capturamos lo digitado por el usuario en la caja de texto de nombre clave encriptada
  //$hash_password= hash('sha256', $password); //Password encryption 
  $stmt = $conn->prepare("SELECT *FROM tblclientes WHERE correoCliente=:email AND password=:clave"); 
  $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
  $stmt->bindParam("clave", $clave,PDO::PARAM_STR) ;
  $stmt->execute();
  $count=$stmt->rowCount();
  $data=$stmt->fetch(PDO::FETCH_OBJ);
  if($count){
    //variables allevar
    $_SESSION['id']=$data->idCliente; // Storing user session value
    $_SESSION["nombre"]=$data->nombresCliente;
    $_SESSION["login"]="Cliente";//identificar la sesion
    print "<script> window.location = './Vistas/Index/IndexClientes.php';</script>";
  }
  else
  {
    ?>
    <script>
    Swal.fire({
      icon: 'error',
      title: 'ERROR!',
      text: 'Datos Clientes Incorrectos!',
    })
    </script>
    <?php
  } 
}
else if (isset($_POST['btnEmpresa'])) { //comprobamos si se envían variables desde el form por el método POST
  $email=$_POST["email"]; //Capturamos lo digitado por el usuario en la caja de texto de nombre usuario
  $clave=$_POST["password"];//Capturamos lo digitado por el usuario en la caja de texto de nombre clave encriptada
  //$hash_password= hash('sha256', $password); //Password encryption 
  $stmt = $conn->prepare("SELECT *FROM tblsucursales WHERE correo=:email AND password=:clave"); 
  $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
  $stmt->bindParam("clave", $clave,PDO::PARAM_STR) ;
  $stmt->execute();
  $count=$stmt->rowCount();
  $data=$stmt->fetch(PDO::FETCH_OBJ);
  if($count){
    //variables allevar
    $_SESSION['id']=$data->idSucursal; // Storing user session value
    $_SESSION["nombre"]=$data->nombreSucursal;
    //$_SESSION["sucursal"]=$data->nombreSucursal;
    $_SESSION["login"]="Sucursal";//identificar la sesion
    print "<script> window.location = '';</script>";
  }
  else
  {
    ?>
    <script>
    Swal.fire({
      icon: 'error',
      title: 'ERROR!',
      text: 'Datos de Empresa Incorrectos!',
    })
    </script>
    <?php
  } 
}

else if (isset($_POST['btnAdmin'])) { //comprobamos si se envían variables desde el form por el método POST
  $email=$_POST["email"]; //Capturamos lo digitado por el usuario en la caja de texto de nombre usuario
  $clave=$_POST["password"];//Capturamos lo digitado por el usuario en la caja de texto de nombre clave encriptada
  //$hash_password= hash('sha256', $password); //Password encryption 
  $stmt = $conn->prepare("SELECT *FROM tblUsuarios WHERE email=:email AND password=:clave"); 
  $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
  $stmt->bindParam("clave", $clave,PDO::PARAM_STR) ;
  $stmt->execute();
  $count=$stmt->rowCount();
  $data=$stmt->fetch(PDO::FETCH_OBJ);
  if($count){
    //variables allevar
    $_SESSION['id']=$data->idUsuario; // Storing user session value
    $_SESSION["nombre"]=$data->nombreUsuario;
    $_SESSION["login"]="Admin";//identificar la sesion
    print "<script> window.location = './Vistas/Index/IndexAdminLC.php';</script>";
  }
  else
  {
    ?>
    <script>
    Swal.fire({
      icon: 'error',
      title: 'ERROR!',
      text: 'Datos Administrador Incorrectos!',
    })
    </script>
    <?php
  } 
}
?>