<?php
session_start();
require_once('Plantillas/top.php');
require_once('model/conexion.php');

$PorPagina = 5;
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

$limit  = $PorPagina;
$offset = ($pagina - 1) * $PorPagina;

$sentencia = $db->query("SELECT COUNT(*) AS conteo FROM categoria");
$conteo    = $sentencia->fetchObject()->conteo;
$paginas   = ceil($conteo / $PorPagina);

$sentencia = $db->prepare("SELECT * FROM categoria LIMIT :limit OFFSET :offset");
$sentencia->bindValue(':limit',  (int) $limit,  PDO::PARAM_INT);
$sentencia->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
$sentencia->execute();
$categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<script src="./js/sweetalert2.all.min.js"></script>

<style>
    .FlexContainer {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        margin-right: 10px;
    }
    .btn-export-pdf  { background-color: #e74c3c; color: #fff; border: none; }
    .btn-export-pdf:hover  { background-color: #c0392b; color: #fff; }
    .btn-export-excel { background-color: #27ae60; color: #fff; border: none; }
    .btn-export-excel:hover { background-color: #1e8449; color: #fff; }
    .badge-ac { background-color: #27ae60; color: #fff; padding: 4px 10px; border-radius: 12px; font-size: .78rem; }
    .badge-in { background-color: #e74c3c; color: #fff; padding: 4px 10px; border-radius: 12px; font-size: .78rem; }
    .btn-accion { margin: 2px; }
</style>

<div class="col-xs-12">
    <div class="mx-auto" style="width: 400px">
        <h2>Listado de Categorías</h2>
    </div>

    <div class="FlexContainer">
        <div>
            <a href="exportar_categoria_pdf.php" class="btn btn-export-pdf btn-sm" title="Exportar a PDF">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <a href="DptoExcel.php" class="btn btn-export-excel btn-sm" title="Exportar a Excel">
                <i class="fas fa-file-excel"></i> Excel
            </a>
        </div>
        <a href="catg1.php" class="btn btn-info btn-sm" role="button">
            <i class="fas fa-plus-circle"></i> Agregar Categoría
        </a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estatus</th>
                <th class="text-center">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria) { ?>
                <tr>
                    <td><?php echo $categoria->id_categoria; ?></td>
                    <td><?php echo htmlspecialchars($categoria->descripcion); ?></td>
                    <td>
                        <?php if ($categoria->estatus == 'AC'): ?>
                            <span class="badge-ac">Activo</span>
                        <?php else: ?>
                            <span class="badge-in">Inactivo</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="consultar_categoria.php?codigo=<?php echo $categoria->id_categoria; ?>"
                           class="btn btn-primary btn-sm btn-accion" title="Consultar">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="modifica_categoria.php?codigo=<?php echo $categoria->id_categoria; ?>"
                           class="btn btn-warning btn-sm btn-accion" title="Modificar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button
                            class="btn btn-danger btn-sm btn-accion"
                            title="Eliminar"
                            onclick="confirmarEliminar(<?php echo $categoria->id_categoria; ?>, '<?php echo htmlspecialchars($categoria->descripcion); ?>')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <p>Mostrando <?php echo $PorPagina; ?> de <?php echo $conteo; ?> Categorías disponibles</p>
        </div>
        <div class="col-xs-12 col-sm-6">
            <p>Página <?php echo $pagina; ?> de <?php echo $paginas; ?></p>
        </div>
    </div>

    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($pagina > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="./categoria.php?pagina=<?php echo $pagina - 1; ?>">&laquo;</a>
                </li>
            <?php } ?>
            <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                <li class="page-item <?php if ($x == $pagina) echo 'active'; ?>">
                    <a class="page-link" href="./categoria.php?pagina=<?php echo $x; ?>"><?php echo $x; ?></a>
                </li>
            <?php } ?>
            <?php if ($pagina < $paginas) { ?>
                <li class="page-item">
                    <a class="page-link" href="./categoria.php?pagina=<?php echo $pagina + 1; ?>">&raquo;</a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<script>
    function confirmarEliminar(id, nombre) {
        Swal.fire({
            title: 'Eliminar categoría?',
            html: 'Estás a punto de eliminar: <strong>' + nombre + '</strong>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash-alt"></i> Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = 'eliminar_categoria.php?codigo=' + id;
            }
        });
    }
</script>

<?php
require_once('Plantillas/bottom.php');
?>
