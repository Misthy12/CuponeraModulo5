<?php
include("../../Share/header.php");
?>
    <title>Clientes</title>
    

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10 col-md-7">
                        <h4 class="text-center">Clientes Registrados</h4>
                    </div>
                    
                    <div class="col-lg-2 col-md-2">
                        <a href="agregar_cliente.php" class="btn-success btn" ><i class="fas fa-plus"></i>Agregar</a>
                    </div>
                </div>
            </div>

            <!-- Consulta a la base de datos -->
            <?php
            include '../../Share/conexion.php';
            $conn =OpenCon();
            $sql="SELECT * FROM tblclientes";
            ?>

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Dui</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                       foreach( $conn->query($sql) as $row){
                            echo "<tr>";
                                echo "<td>".$row["idCliente"]."</td>";
                                echo "<td>".$row["nombresCliente"] .$row["apellidosClientes"]."</td>";
                                echo "<td>".$row["telefono"]."</td>";
                                echo "<td>".$row["direccionCliente"]."</td>"; 
                                echo "<td>".$row["dui"]."</td>"; 
                                echo "<td>";
                                    echo "<a class='btn btn-sm btn-warning' href=\"../Clientes/editar_cliente.php?codigo=". $row["idCliente"]."\" ><i class='fas fa-edit'></i></a> \n";
                                    echo "<a class='btn btn-sm btn-info' href=\"../Clientes/info_cliente.php?codigo=". $row["idCliente"]."\" ><i class='fas fa-info'></i></a> \n";
                                    echo "<a class=\"btn btn-sm btn-danger\" href=\"./eliminar_cliente.php?codigo=". $row["idCliente"]."\"><i class=\"far fa-trash-alt\"></i></a>";
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
                            echo "Se ha eliminado el Cliente!! :)";
                            echo "</div>";
                        }else{
                            echo "<div class='alert alert-danger' role='alert'> ";
                            echo "No se ha eliminado el Cliente! :'(";
                            echo "</div>";
                        }
                    }
                ?>
            <div class="card-footer text-center ">
                    <details>
                    <summary>Por: ---</summary>
                    <p><a href="mailto:nancycolatoam@gmail.com">nancycolatoam@gmail.com</a></p>
                    </details>
            </div>
        </div>
        
    <?php
    //incluimos footer
    include "../../Share/footer.php";
    ?>