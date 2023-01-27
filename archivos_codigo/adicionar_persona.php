<!DOCTYPE html>
<html>
<head>
    <title>Gestion y registro de usuarios</title>
    <!-- <script type='text/javascript' src='funciones.js'></script> -->
    <script type='text/javascript' src='https://www.tutorialspoint.com/jquery/jquery-3.6.0.js'></script>

    <script src='funciones.js' language='Javascript'></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<?php
$texto='';
include_once("funciones.php");

$texto.='<div id="informacion_registro_personas" >
<h2>Ingresa los datos para registrar la persona</h2>
<br>
<input type="text" id="nombre_persona" placeholder="Nombre de persona" value="">
<br>
<input type="text" id="apellido_persona" placeholder="Apellido de persona" value="">
<br>
<input type="text" id="documento_persona" placeholder="Documento de persona" value="">
<br>
<input type="text" id="telefono_persona" placeholder="Telefono de persona" value="">
<br>
<input type="text" id="direccion_persona" placeholder="Direccion de persona" value="">
<br>
<input type="text" id="correo_persona" placeholder="Correo de persona" value="">
<br>
';

$texto.='
<br>
<button class="btn btn-success" type="button" id="aceptar_registro_persona" >Aceptar registro </button>
</div>';


echo($texto);

?>

</body>
</html>