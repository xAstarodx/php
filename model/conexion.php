<?php

    $contraseña = '';
    $usuario = "root";
    $nombredb = "proyecto";
    $host = "localhost";

    try{
        $db = new PDO("mysql:host=".$host.";dbname=".$nombredb, $usuario, $contraseña);
        $db->exec("SET CHARACTER SET utf8");
        //echo "Conexion exitosa ";
        return $db;
    }catch (Exception $e){
        echo "Error de conexion" . $e->getMessage();
    }





?>








