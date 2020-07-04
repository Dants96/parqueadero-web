<?php
    if(isset($_POST['tipU']) && isset($_POST['user_nom']) && isset($_POST['user_ape']) && isset($_POST['user_nick']) && isset($_POST['pwd']) && isset($_POST['pwdR'])){
        function valPWD (){
            if($_POST['pwd'] != $_POST['pwdR']){
              echo (json_encode(array('error' => true, 'msg' => "las contraseñas no coinciden! pass1 = {$_POST['pwd']} pass2 = {$_POST['pwdR']}")));
            exit();
            }
        }

        function valNick(){
            require 'conexionBDServ.php';
            $consulta = $conexion->prepare("SELECT usuario_nick FROM usuarios WHERE usuario_nick = ?");
            $consulta->bind_param("s", $_POST['user_nick']);
            if (!$consulta->execute()) {
                echo (json_encode(array('error' => true, 'msg' => 'no se pudo ejecutar busqueda en base de datos')));
                return 0;
            } else {
                $encontrado = $consulta->get_result();
                if ($encontrado->num_rows != 0) {
                    echo (json_encode(array('error' => true, 'msg' => 'ya existe un usuario con ese nick')));
                }
            }
        }

        function validar(){
            valPWD();
            valNick();
        }

        validar();
        require 'conexionBDServ.php';

        $passwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        $sentencia = $conexion->prepare("INSERT INTO usuarios(usuario_nom, usuario_ape, usuario_tipo, usuario_nick, usuario_pwd) VALUES(?, ?, ?, ?, ?)");
        $sentencia->bind_param("ssiss", $_POST['user_nom'], $_POST['user_ape'], $_POST['tipU'], $_POST['user_nick'], $passwd);
        if(!$sentencia->execute()){
            echo(json_encode(array('error' => true, 'msg' => 'no se pudo crear usuario en la base de datos')));
            exit();
        }
        $conexion->close();
        echo(json_encode(array('error' => false, 'msg' => "Usuario creado con exito, vienvenido {$_POST['user_nom']}.")));
        session_start();
        $_SESSION['usuario'] = array('nombre' => $datos['user_nom'], 'apellido' => $datos['user_ape'], 'tipo' => $datos['tipU'], 'nick' => $_POST['user_nick']);
    }else{
        $tipo = isset($_POST['tipU']);
    $nom = isset($_POST['user_nom']);
        $ape = isset($_POST['user_ape']);
        $nick = isset($_POST['user_nick']);
        $pass = isset($_POST['pwd']);
        $pass2 = isset($_POST['pwdR']);
        $mesaje = "tipo = {$tipo}, nom = {$nom}, ape ={$ape}, nick = {$nick}, pass = {$pass}, pass2 = {$pass2}";
        echo(json_encode(array('error' => true, 'msg' => $mesaje)));
    }

?>