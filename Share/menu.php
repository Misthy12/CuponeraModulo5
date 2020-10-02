<?php
  include('validar.php');
?>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<!-- Navbar -->  
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links --> 
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>  
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link text-dark  font-weight-bold  ">LA CUPONERA!!</a>  
      </li>
    </ul>  

  </nav>  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
       <i class="brand-image img-circle mt-2 text-xl nav-icon " style="color:#fff" >LC</i>

      <span class="brand-text font-weight-light text-center text-uppercase"><b><i>La Cuponera<i></b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <a class="brand-link">
        <i class="brand-image img-circle mt-2 text-lg nav-icon fas fa-user" style="color:#fff" ></i>
        <span class="brand-text font-weight-light text-center"><?php echo $_SESSION["nombre"]; ?></span>
      </a>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <?php
              if($_SESSION["login"]=="Cliente"){
               echo "<a href='../../Vistas/Index/IndexClientes.php' class='nav-link active'>";
              }
              else if($_SESSION["login"]=="Sucursal"){
                echo "<a href='../../Vistas/Index/IndexEmpresas.php' class='nav-link active'>";
              }
              else{
                echo "<a href='../../Vistas/Index/IndexAdminLC.php' class='nav-link active'>";
              }
            ?>
            
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php
              if($_SESSION["login"]=="Cliente"){?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Cupones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Clientes/misCupones.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis compras</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              <?php echo $_SESSION["nombre"]; ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Clientes/editar_cliente.php?codigo=<?php echo$_SESSION['id']?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis Datos Personales</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
              }
              if($_SESSION["login"]=="Sucursal"||$_SESSION["login"]=="Admin" ){?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Ofertas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Ofertas/listado_ofertas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ofertas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Vistas/Ofertas/agregar_oferta.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Oferta</p>
                </a>
              </li>
            </ul>
          </li>
              <?php } 
              if($_SESSION["login"]=="Admin"){?>    
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Empresas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Empresas/listado_empresas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado Empresas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Vistas/Sucursales/listado_sucursales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado Sucursales</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clientes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Clientes/listado_clientes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado Clientes</p>
                </a>
              </li>
            </ul>
          </li>
          <!--<li class="nav-item has-treeview">
             <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Usuario</p>
                </a>
              </li>
            </ul>
          </li>         
          </li> -->
     
        
          <li class="nav-item has-treeview">
            <a href="../../Vistas/Rubros/listado_rubros.php" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Rubros

              </p>
            </a>
          </li> 
          <?php }?> 
          <li class="nav-item has-treeview">
            <a href="../../Share/salir.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Salir
              </p>
            </a>
          </li>        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
   <br>