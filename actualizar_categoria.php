<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="./js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
require_once('./model/conexion.php');
session_start();

if (isset($_POST['id_categoria'])) {
    $id   = $_POST['id_categoria'];
    $desc = $_POST['txt_descripcion'];
    $stat = $_POST['txt_estatus'];

    try {
        $sql = $db->prepare("UPDATE categoria SET descripcion = ?, estatus = ? WHERE id_categoria = ?");
        $resultado = $sql->execute([$desc, $stat, $id]);

        if ($resultado) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'La categoría se modificó correctamente'
                }).then(() => {
                    location.href = 'categoria.php';
                });
            </script>
            <?php
        }
    } catch (Exception $e) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo actualizar la categoría'
            }).then(() => {
                location.href = 'categoria.php';
            });
        </script>
        <?php
    }
} else {
    header("Location: categoria.php");
    exit();
}
?>
</body>
</html>
