<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="./js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
// Usamos tu ruta de conexión
require_once('./model/conexion.php');
session_start();

if(isset($_POST['txt_descripcion'])){
    $desc = $_POST['txt_descripcion'];
    $stat = $_POST['txt_estatus'];

    try {
        // Usamos la variable $db que definiste en tu conexión PDO
        $sql = $db->prepare("INSERT INTO categoria (descripcion, estatus) VALUES (?, ?)");
        $resultado = $sql->execute([$desc, $stat]);

        if($resultado){
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Registrado!',
                    text: 'La categoría se guardó correctamente'

                }).then(() => {
                    location.href = 'Categoria.php'; 
                });
            </script>
            <?php
        }
    } catch (Exception $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>
</body>
</html>