<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>
    <link type="txt/css" href="./css/sweetalert2.min.css">
    <script src="./js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
require_once('./model/conexion.php');
session_start();
$correo=$_POST['correo'];
$pass=$_POST['contra'];
//echo($correo);
//echo($pass);
$sentencia=$db->prepare("SELECT * FROM usuarios WHERE Correo=? AND BINARY contraseña=?");
$sentencia->execute([$correo,$pass]);
$datos = $sentencia ->fetch(PDO::FETCH_OBJ);
print_r($datos);
/*if($datos === false){
    ?>
     <script>
        Swal.fire({
            icon:"error",
            title: "Error",
            text:"Usuario no existe!",
            footer: '<a href:"index.php">Pulsa Aqui</a>'
        });
    </script>;
    <?php
}*/
if($datos!=null){
    if($datos->Id_Rol==1 && $datos->Status=='AC'){
        $_SESSION['apellido']=$datos->Apellido;
        $_SESSION['nombre']=$datos->Nombre;
        $_SESSION['id']=$datos->id_usuario;
        ?>
        <script>
           // alert("Usuario Bienvenido <?php echo $datos->Nombre?>...");
            //location.href="index1.php";
            Swal.fire({
                     title: 'Usuario Logeado Existosamente',
                     text: 'Bienvenido al Sistema',
                     icon: 'success'
                    }).then((result) => {
                      if (result.isConfirmed) {
                      location.href='admin_index.php';
                 }
              });       
    
    
        </script>
        <?php
    
       
    }
    if($datos->Id_Rol==2 && $datos->Status=='AC'){
        $_SESSION['apellido']=$datos->Apellido;
        $_SESSION['nombre']=$datos->Nombre;
        $_SESSION['id']=$datos->id_usuario;
        ?>
        <script>
           // alert("Usuario Bienvenido <?php echo $datos->Nombre?>...");
            //location.href="./admin/index.php";
            Swal.fire({
                     title: 'Cliente Logeado Existosamente',
                     text: 'Bienvenido al Sistema',
                     icon: 'success'
                    }).then((result) => {
                      if (result.isConfirmed) {
                      location.href='./cliente/index.php';
                 }
              });       
    
    
        </script>
        <?php
        
    }
}else{
    ?>
    <script>
        Swal.fire({
            icon:"error",
            title: "Error",
            text:"Usuario No Registrado",
            //footer: '<a href:"index.php">Pulsa Aqui</a>'
        }).then(()=>{
            location.href="./index.php"
        })
    </script>
    <?php
    
}

?>
</body>
</html>

