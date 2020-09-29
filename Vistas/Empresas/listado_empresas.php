<?php
include("../../Share/header.php");
?> 
    <title>Empresas</title>
    
 <!-- Main content -->
 <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-12">
                        <h4 class="text-center">Empresas Registradas</h4>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <a href="agregar_empresa.php" class="btn-success btn" ><i class="fas fa-plus"></i>Agregar</a>
                    </div>
                </div>
            </div>

            <!-- Consulta a la base de datos -->
            <?php
            include '../../Share/conexion.php';
            $conn =OpenCon();
            $sql="SELECT e.idEmpresa as id, e.nombreEmpresa, e.telefono, e.codigoEmpresa, e.direccion, r.nombreRubro as rubro FROM tblEmpresas e
            INNER JOIN tblRubros r ON e.idRubro = r.idRubro";
            ?>

            <div class="card-body table-responsive">
                <table class="table  table-hover table-striped ">
                    <thead class="bg-dark text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Rubro</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody  class="text-center">
                        <?php
                        foreach( $conn->query($sql) as $row){
                                echo "<tr>";
                                    echo "<td>".$row["codigoEmpresa"]."</td>";
                                    echo "<td>".$row["nombreEmpresa"] ."</td>";
                                    echo "<td>".$row["telefono"]."</td>";
                                    echo "<td>".$row["direccion"]."</td>"; 
                                    echo "<td>".$row["rubro"]."</td>"; 
                                    echo "<td>";
                                        echo "<a class='btn btn-sm btn-warning' href=\"./editar_empresa.php?codigo=". $row["id"]."\" ><i class='fas fa-edit'></i></a> \n";
                                        echo "<a class='btn btn-sm btn-info' href=\"./info_empresa.php?codigo=". $row["id"]."\" ><i class='fas fa-info'></i></a> \n";
                                        echo "<a class=\"btn btn-sm btn-danger\" href=\"./eliminar_empresa.php?codigo=". $row["id"]."\"><i class=\"far fa-trash-alt\"></i></a>";
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