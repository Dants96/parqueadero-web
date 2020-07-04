<?php
    if(isset($_POST['nickIN'])){
        require 'conexionBDServ.php';
        $consulta = $conexion->prepare("SELECT usuario_nick FROM usuarios WHERE usuario_nick = ?");
        $consulta->bind_param("s", $_POST['nickIN']);
        if(!$consulta->execute()){
            echo(json_encode(array('get' => true, 'msg' => 'no se pudo ejecutar busqueda en base de datos')));            
        }else{
            $encontrado = $consulta->get_result();
            if($encontrado->num_rows == 0){
                echo(json_encode(array('get' => false, 'msg' => 'no encontrado usuario con ese nick')));
            }else{
            echo (json_encode(array('get' => true, 'msg' => 'existe un usuario con ese nick')));
            }
        }
        $conexion->close();
    }

?>