<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>
    <link type="txt/css" href="css/sweetalert2.min.css">
    <script src="./js/sweetalert2.all.min.js"></script>
</head>
<body>
    
</body>
</html>

<?php
    require_once('./model/conexion.php');

    $correo=$_POST['correo'];
    $pass=$_POST['contra'];



   // echo"el correo es:$correo "."\nla contraseña es :$pass";
    $sentencia=$db->prepare('SELECT * FROM usuarios WHERE correo=? AND BINARY password=?');
    $sentencia->execute([$correo,$pass]);
    $datos=$sentencia->fetch(PDO::FETCH_OBJ);
    print_r($datos);

    if($datos->Id_Rol== 1 && $datos-> Status=='AC'){
        ?>
        <script>
            //alert("Usuario Bienvenido <?php echo $datos->Nombre ?>.....");
            //location.href="./admin/index.php";

            Swal.fire({
                title:"Admin Logueado Exitosamente",
                Text:"Bienvenido al Sistema",
                icon:'success'
            }).then((result)=>{
                if(result.isConfirmed){
                location.href="./admin/index.php";
            }
        })


        </script>
    <?php

    }

    if($datos->Id_Rol== 2 && $datos-> Status=='AC'){
        ?>
        <script>
            //alert("Usuario Bienvenido <?php echo $datos->Nombre ?>.....");
            //location.href="./admin/index.php";

            Swal.fire({
                title:"Cliente Logueado Exitosamente",
                Text:"Bienvenido al Sistema",
                icon:'success'
            }).then((result)=>{
                if(result.isConfirmed){
                location.href="./admin/index.php";
            }
        })


        </script>
    <?php

    }


