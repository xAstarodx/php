<?php
require_once('./model/conexion.php');
session_start();

// Si no está logueado, redirige al login
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
    exit();
}

// Verificamos que llegó el código por GET
if (!isset($_GET['codigo'])) {
    header("Location: categoria.php");
    exit();
}

$codigo = $_GET['codigo'];

// Buscamos la categoría en la base de datos
$sentencia = $db->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
$sentencia->execute([$codigo]);
$categoria = $sentencia->fetch(PDO::FETCH_OBJ);

// Si no existe esa categoría, regresamos al listado
if (!$categoria) {
    header("Location: categoria.php");
    exit();
}

require_once('./Plantillas/top.php');
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Administración de Categorías</h1>

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modificar Categoría</h6>
                </div>
                <div class="card-body">
                    <form action="actualizar_categoria.php" method="POST">

                        <!-- Campo oculto con el ID de la categoría -->
                        <input type="hidden" name="id_categoria" value="<?php echo $categoria->id_categoria ?>">

                        <div class="form-group">
                            <label>Código</label>
                            <input type="text" class="form-control" value="<?php echo $categoria->id_categoria ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label>Nombre / Descripción</label>
                            <input 
                                type="text" 
                                name="txt_descripcion" 
                                class="form-control" 
                                value="<?php echo $categoria->descripcion ?>" 
                                required>
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select name="txt_estatus" class="form-control">
                                <option value="AC" <?php if ($categoria->estatus == 'AC') echo 'selected' ?>>Activo</option>
                                <option value="IN" <?php if ($categoria->estatus == 'IN') echo 'selected' ?>>Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block">Guardar Cambios</button>
                        <a href="categoria.php" class="btn btn-secondary btn-block mt-2">Cancelar</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('./Plantillas/bottom.php');
?>
