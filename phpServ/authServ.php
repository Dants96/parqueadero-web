<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo('guess');
    }else{
        echo('auth');
    }
?>
