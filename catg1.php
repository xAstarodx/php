<?php
session_start();
// 1. Verificamos que el usuario esté logueado (usando tu lógica)
if(!isset($_SESSION['id'])){
    header("Location: ./index.php");
    exit();
}

// 2. Cargamos la parte de arriba de tu plantilla
require_once('./Plantillas/top.php'); 
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Administración de Categorías</h1>

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nueva Categoría</h6>
                </div>
                <div class="card-body">
                    <form action="guardar_categoria.php" method="POST">
                        <div class="form-group">
                            <label>Nombre / Descripción</label>
                            <input type="text" name="txt_descripcion" class="form-control" placeholder="Ej: Electrónica" required>
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="txt_estatus" class="form-control">
                                <option value="AC">Activo</option>
                                <option value="IN">Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Guardar Categoría</button>
                    </form>
                </div>
            </div>
        </div>
        
        </div>
</div>

<?php 
// 3. Cargamos la parte de abajo de tu plantilla
require_once('./Plantillas/bottom.php'); 
?>