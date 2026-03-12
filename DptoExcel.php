<?php
require_once('model/conexion.php');
$nombre = 'categoria.xls';
header('Expires: 0');
header('Cache-control: private');
header("Content-type: application/vnd.ms-excel;charset=iso-8859-15"); // Archivo de Excel
header("Cache-Control: cache, must-revalidate");
header('Content-Description: File Transfer');
header('Last-Modified: ' . date('D, d M Y H:i:s'));
header("Pragma: public");
header('Content-Disposition:attachment; filename="' . $nombre . '"');
header("Content-Transfer-Encoding: binary");
echo ("<table border='0'> 
						<tr > 
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;'>ID</td> 
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>NOMBRE</td>
												</tr>");


$sentencia = $db->prepare("SELECT * FROM categoria");
$sentencia->execute();
$reporte = $sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach ($reporte as $value) {

	echo ("<tr>
                        <td style='border:1px solid #eee;'>" . $value["id_categoria"] . "</td>
				 		<td style='border:1px solid #eee;'>" . $value["descripcion"] . "</td>
						<td style='border:1px solid #eee;'>" . $value["estatus"] . "</td>
						</tr>");
}
echo "</table>";
