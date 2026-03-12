<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
    exit();
}
if (!isset($_GET['codigo'])) {
    header("Location: categoria.php");
    exit();
}

require_once('./model/conexion.php');
require_once('./Plantillas/top.php');

$id = $_GET['codigo'];
$sentencia = $db->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
$sentencia->execute([$id]);
$categoria = $sentencia->fetch(PDO::FETCH_OBJ);

if (!$categoria) {
    header("Location: categoria.php");
    exit();
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detalle de Categoría</h1>

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle"></i> Información
                    </h6>
                    <a href="categoria.php" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width:40%">Código</th>
                            <td><?php echo $categoria->id_categoria; ?></td>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <td><?php echo htmlspecialchars($categoria->descripcion); ?></td>
                        </tr>
                        <tr>
                            <th>Estatus</th>
                            <td>
                                <?php if ($categoria->estatus == 'AC'): ?>
                                    <span style="background:#27ae60;color:#fff;padding:4px 12px;border-radius:12px;">Activo</span>
                                <?php else: ?>
                                    <span style="background:#e74c3c;color:#fff;padding:4px 12px;border-radius:12px;">Inactivo</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <a href="modifica_categoria.php?codigo=<?php echo $categoria->id_categoria; ?>"
                           class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modificar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('./Plantillas/bottom.php'); ?>
