<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="./js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
session_start();
require_once('./model/conexion.php');

if (!isset($_GET['codigo'])) {
    header("Location: categoria.php");
    exit();
}

$id = $_GET['codigo'];

try {
    $sql = $db->prepare("DELETE FROM categoria WHERE id_categoria = ?");
    $resultado = $sql->execute([$id]);

    if ($resultado) {
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Eliminado',
                text: 'La categoría fue eliminada correctamente'
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
            text: 'No se puede eliminar, la categoría está en uso'
        }).then(() => {
            location.href = 'categoria.php';
        });
    </script>
    <?php
}
?>
</body>
</html>
