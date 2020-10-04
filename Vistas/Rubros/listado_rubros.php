<?php
include("../../Share/header.php");
?>
    <title>Rubros</title>
    
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-12">
                        <h4 class="text-center">Registro de Rubros</h4>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <a href="agregar_rubro.php" class="btn-success btn" ><i class="fas fa-plus"></i>Agregar</a>
                    </div>
                </div>
            </div>

            <!-- Consulta a la base de datos -->
            <?php
            include '../../Share/conexion.php';
            $conn =OpenCon();
            $sql="SELECT * FROM tblRubros";

            ?> 

            <div class="card-body table-responsive">
                <table class="table  table-hover table-striped ">
                    <thead class="bg-dark text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody  class="text-center">
                        <?php
                        foreach( $conn->query($sql) as $row){
                                echo "<tr>";
                                    echo "<td>".$row["idRubro"]."</td>";
                                    echo "<td>".$row["nombreRubro"]."</td>";
                                    echo "<td>".$row["descripcion"]."</td>"; 
                                    echo "<td>";
                                        echo "<a class='btn btn-sm btn-warning' href=\"./editar_rubro.php?codigo=". $row["idRubro"]."\" ><i class='fas fa-edit'></i></a> \n";
                                        echo "<a class=\"btn btn-sm btn-danger\" href=\"./eliminar_rubro.php?codigo=". $row["idRubro"]."\"><i class=\"far fa-trash-alt\"></i></a>";
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
                            Print"<script>
                            Swal.fire({
                              icon: 'success',
                              title: 'Hecho!',
                              text: 'Se Ha Eliminado el registro!',
                            })
                            </script>";
                        }else{
                            Print"<script>
                            Swal.fire({
                              icon: 'error',
                              title: 'OPPS!',
                              text: 'No se ha podido eliminar!',
                            })
                            </script>";
                        }
                    }
                ?>
            
            </div>
        </div>
        
    <?php
    //incluimos footer
    include "../../Share/footer.php";
    ?>