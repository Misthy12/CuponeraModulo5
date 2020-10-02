<?php
include "../../Share/header.php";
?>
    <title>Ofertas</title>
    
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-12">
                        <h4 class="text-center">Registro de Ofertas</h4>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <a href="agregar_oferta.php" class="btn-success btn" ><i class="fas fa-plus"></i>Agregar</a>
                    </div>
                </div>
            </div>

            <!-- Consulta a la base de datos -->
            <?php
            include '../../Share/conexion.php';
            $conn =OpenCon();
            $sucursal= $_SESSION["id"];
            if($_SESSION["login"]="Sucursal"){
            $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin  FROM tblCupones o
            INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal 
            INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon WHERE o.idSucursal = $sucursal";}
            else{
            $sql="SELECT o.idCupon as id,o.tituloOferta as titulo, s.nombreSucursal as sucursal, o.precioOferta, e.definirEstado as estado, o.descripcion, o.fechaInicio, o.fechaFin  FROM tblCupones o
            INNER JOIN tblSucursales s ON o.idSucursal = s.idSucursal 
            INNER JOIN tblEstadosCupon e ON o.estado=e.idEstadoCupon";}

            ?>

            <div class="card-body table-responsive">
                <table class="table  table-hover table-striped ">
                    <thead class="bg-dark text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Oferta</th>
                            <th>Sucursal</th>
                            <th>Descripcion</th>
                            <th>Precio Ofertado</th>
                            <th>Estado</th>
                            <th>Fechas</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody  class="text-center">
                        <?php
                        foreach( $conn->query($sql) as $row){
                                echo "<tr>";
                                    echo "<td>".$row["id"]."</td>";
                                    echo "<td>".$row["titulo"]."</td>";
                                    echo "<td>".$row["sucursal"]."</td>"; 
                                    echo "<td>".$row["descripcion"]."</td>"; 
                                    echo "<td> $".$row["precioOferta"]."</td>"; 
                                    echo "<td>".$row["estado"]."</td>"; 
                                    echo "<td>".$row["fechaInicio"]." al ".$row["fechaFin"]."</td>"; 
                                    echo "<td>";
                                        echo "<a class='btn btn-sm btn-warning' href=\"./editar_oferta.php?codigo=". $row["id"]."\" ><i class='fas fa-edit'></i></a> \n";
                                        echo "<a class='btn btn-sm btn-info' href=\"./info_oferta.php?codigo=". $row["id"]."\" ><i class='fas fa-info'></i></a> \n";
                                        echo "<a class=\"btn btn-sm btn-danger\" href=\"./eliminar_ofeta.php?codigo=". $row["id"]."\"><i class=\"far fa-trash-alt\"></i></a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            
                
                <?php
                
                    CloseCon($conn);
                   
                    //VALIDACION DE ELIMINACION
                    if (isset($_GET['result'])){
                        if($_GET['result'] == 1){
                            echo "<div class='alert alert-success' role='alert'> ";
                            echo "Se ha eliminado el Registro!! :)";
                            echo "</div>";
                        }else{
                            echo "<div class='alert alert-danger' role='alert'> ";
                            echo "No se ha eliminado el Registro! :'(";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
        
    <?php
    //incluimos footer
    include "../../Share/footer.php";
    ?>