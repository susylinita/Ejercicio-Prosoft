<!DOCTYPE html>
<html>
<head>
    <title>Menu de usuarios</title>
    <!-- <script type='text/javascript' src='funciones.js'></script> -->
    <script type='text/javascript' src='https://www.tutorialspoint.com/jquery/jquery-3.6.0.js'></script>

    <script src='funciones.js' language='Javascript'></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="estilos.css" media="screen" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>

<?php
session_start();
$texto='';
include_once("funciones.php");

if($_REQUEST['session'] || $_SESSION['usuario_actual']){
    $_SESSION['usuario_actual']=$_REQUEST['session'];
    $texto.='<div id="menu_botones_superiores" class="inside-navigation grid-container grid-parent" style="display:inline-flex; margin-right:1px;">';
    
    $texto.=ver_botones_modulo($_REQUEST['session']);
    // $texto.='<button type="button" id="gestion_personas" >Gesti&oacute;n de personas </button>';
    // $texto.='<button type="button" id="gestion_usuarios" >Gesti&oacute;n de usuarios </button>';
    
    $texto.='</div>';

    $texto.='<div id="contenido_gestion_personas">';
    $texto.='<button title="Adicionar registro persona" type="button" class="btn btn-primary" id="adicion_personas">Adicionar persona</button>';
    $texto.=ver_personas_sistema();
    $texto.='</div>';

    $texto.='<div id="contenido_gestion_usuarios" style="display: none;">';
    $texto.='<button title="Adicionar registro usuario" type="button" class="btn btn-primary" id="adicion_usuario">Adicionar usuario</button>';
    $texto.=ver_usuarios_sistema();
    $texto.='</div>';
}
else{
    $texto.='<h1>NO HAY UN USUARIO INICIADO</h1>';
}

    

    

    echo($texto);

?>

</body>
</html>