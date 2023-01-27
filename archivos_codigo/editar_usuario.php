<!DOCTYPE html>
<html>
<head>
    <title>Editar de usuario</title>
    <!-- <script type='text/javascript' src='funciones.js'></script> -->
    <script type='text/javascript' src='https://www.tutorialspoint.com/jquery/jquery-3.6.0.js'></script>

    <script src='funciones.js' language='Javascript'></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<?php
session_start();

$texto='';
include_once("funciones.php");
if($_REQUEST['idusuario'] && $_SESSION['usuario_actual']){

    $texto.='<div id="informacion_registro_usuario" >
    <h2>Ingresa los datos para registrar el usuario</h2>
    <br>
    ';
    $texto.=cargar_datos_usuario($_REQUEST['idusuario']);

    $texto.='
    <br>
    <button class="btn btn-success" type="button" id="editar_registro_usuario" >Editar registro </button>
    </div>';


    echo($texto);
}
?>

</body>
</html>