<?php
session_start();
if(isset($_SESSION['id'])){
    
    require_once('./Plantillas/top.php');
    require_once('./Plantillas/bottom.php');
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="./css/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <script src="./js/sweetalert2.all.min.js"></script>
    </head>
    <body>
        
    </body>
    </html>
    <script>
        Swal.fire({
            icon:"error",
            title: "Error",
            text:"Usuario Logeado",
            //footer: '<a href:"index.php">Pulsa Aqui</a>'
        }).then(()=>{
            location.href="./index.php"
        })
    </script>
    <?php

}


?>

