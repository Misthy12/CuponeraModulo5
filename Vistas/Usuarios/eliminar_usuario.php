<?php
    if (isset($_GET['codigo'])) {
        include '../../Share/conexion.php';
        $conn = OpenCon();
            
        // Verificamos la conexión
        if ($conn->connect_error) {
            die("No se pudo conectar a la base de datos :( ");
            header('Location: ./listado_usuarios.php?result=0');
        } 
        
        $sql = "DELETE FROM tblusuarios WHERE idUsuario = ?";

        $sth = $conn->prepare($sql);
        $sth->execute(array($_GET['codigo']));
        $count = $sth->rowCount();

            if ($count > 0) {
                header('Location: ./listado_usuarios.php?result=1');                
                exit();
            } else {
                header('Location: ./listado_usuarios.php?result=0');
                exit();
            }
            CloseCon($conn);
    } else {
        header('Location:./listado_usuarios.php?result=0');
    }
?>