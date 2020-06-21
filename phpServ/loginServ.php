<?php
sleep(0.8);
    if( isset($_POST['usuarioIN']) && isset($_POST['pwdIN'])){
        require 'conexionBDServ.php';
        $consulta = $conexion->prepare("SELECT usuario_nom, usuario_ape, usuario_tipo, usuario_pwd FROM usuarios WHERE usuario_nick = ?");
        $consulta->bind_param("s", $_POST['usuarioIN']); 
        if(!$consulta->execute()){
            echo (json_encode(array('error' => true, 'msg' => 'Error al conectar con la base de datos')));
        }else{
            $usuarios = $consulta->get_result();
            if($usuarios->num_rows == 1){
                $datos = $usuarios->fetch_assoc();
                if($datos['usuario_pwd'] == $_POST['pwdIN']){
                session_start();
                $_SESSION['usuario'] = array('nombre' => $datos['usuario_nom'], 'apellido' => $datos['usuario_ape'], 'tipo' => $datos['usuario_tipo'], 'nick' => $_POST['usuarioIN']);
                echo (json_encode(array('error' => false, 'nombre' => $datos['usuario_nom'], 'apellido' => $datos['usuario_ape'], 'tipo' => $datos['usuario_tipo'], 'nick' => $_POST['usuarioIN'])));
                }else{
                    echo (json_encode(array('error' => true, 'msg' => 'contraseña incorrecata')));            
                }
                
            }else{
            echo(json_encode(array('error' => true, 'msg' => 'El usuario no se encuentra registrado')));}
        }  
    $conexion->close();    
    }else{
        echo (json_encode(array('error' => true, 'msg' => 'ERROR no hay informacion')));
    }
    

    

?>