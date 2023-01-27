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
    include_once("funciones.php"); ;

    $texto='';

    $texto.='
    <div id="menu_botones_superiores">
    <button type="button" class="btn btn-info" id="gestion_usuarios" >Gesti&oacute;n de usuarios </button>
    <button type="button" class="btn btn-info" id="registro_usuarios" >Registrar usuarios </button>
    </div>

    <div id="informacion_gestion_usuarios">
    <h2>Ingresa el nombre de tu usuario</h2>
    <br>
    <input type="text" id="usuario" placeholder="Usuario" value="">
    <br>
    <br>
    <button class="btn btn-success" type="button" id="inicio_usuario" >Iniciar usuario </button>
    </div>
    
    <div id="informacion_registro_usuarios" style="display: none;">
    <h2>Ingresa los datos para registrar tu usuario</h2>
    <br>
    <input type="text" id="nombre_registro" placeholder="Nombre de persona" value="">
    <br>
    <input type="text" id="usuario_registro" placeholder="Usuario" value="">
    <br>';
    $texto.=perfiles_registro();
    $texto.='
    <input type="hidden" id="fk_idperfil" value="">
    <br>
    <button class="btn btn-success" type="button" id="aceptar_registro" >Aceptar registro </button>
    </div>';
    
    echo ($texto);
    ?>

</body>
</html>

