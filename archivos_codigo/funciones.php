<?php

function perfiles_registro($idperfil=0){
    $conexion = mysqli_connect("localhost", "root", "", "administrar_usuarios") or die("Problemas con la conexión");
    
    
    $registros =mysqli_query($conexion, "select * from perfil") or die("Problemas en el select" . mysqli_error($conexion));
    $texto='';
    while ($reg = mysqli_fetch_array($registros)) {
        if($reg['idperfil']==$idperfil){
            $texto.='
        <input type="radio" checked class="radio_elegido" name="perfiles" value="'.$reg['idperfil'].'">'.$reg['nombre_perfil']."<br>";
        }
        else{
            $texto.='
        <input type="radio" class="radio_elegido" name="perfiles" value="'.$reg['idperfil'].'">'.$reg['nombre_perfil']."<br>";
        }
        
        
    }
  
    mysqli_close($conexion);
  
    return ($texto);
  }

function ejecutar_consulta($sql){
    $texto=0;
    $conexion = mysqli_connect("localhost", "root", "", "administrar_usuarios") or die("Problemas con la conexión");
    
    $registros = mysqli_query($conexion, $sql) or die("Problemas en el select" . mysqli_error($conexion));

    mysqli_close($conexion);
    
    return ($registros);
}

if(isset($_REQUEST['verificar'])){
    $retorno=new stdClass;
    $retorno->exito=1;

    $sql="select * from usuarios where usuario like '".$_REQUEST['usuario']."'";
    $texto='';
    $estado='';
    $registros=ejecutar_consulta($sql);
    while ($reg = mysqli_fetch_array($registros)) {
        $texto=$reg['idusuarios'];
        $estado=$reg['estado'];
        break;
    }
    $retorno->datos=$texto;
    $retorno->estado=$estado;
    echo(json_encode($retorno));
}

function ver_botones_edicion($tabla, $id, $estado=0){
    $texto='';
    $texto.='<button style="color:white; title="Editar registro en '.$tabla.'" type="button" class="btn btn-info btn-mini editar_'.$tabla.'" identificador="'.$id.'" id="editar_'.$tabla.'_'.$id.'"><i class="fa fa-edit"></i></button>';

    $texto.='<button title="Eliminar registro en '.$tabla.'" type="button" class="btn btn-danger btn-mini eliminar_'.$tabla.'" identificador="'.$id.'" id="eliminar_'.$tabla.'_'.$id.'"><i class="fa fa-trash"></i></button>';

    if($tabla == "usuarios"){
        $colores=array("0"=>"","1"=>"warning","2"=>"success");
        $titulos=array("0"=>"","1"=>"Desactivar","2"=>"Activar");
        $texto.='<button style="color:white;" title="'.$titulos[$estado].' registro en '.$tabla.'" type="button" class="btn btn-'.$colores[$estado].' btn-mini cambio_estado" estado="'.$estado.'" identificador="'.$id.'" id="estado_'.$tabla.'_'.$id.'"><i class="fa fa-circle"></i></button>';
    }

    return($texto);
}


function ver_botones_modulo($idusuario){
    $sql="select A.* from modulos a, usuarios b, permisos c where c.fk_idperfil like b.fk_idperfil AND b.idusuarios like '".$idusuario."' AND c.fk_idmodulos = a.idmodulos group by a.idmodulos";
    
    $dato='';
    $registros =ejecutar_consulta($sql);
    while ($reg = mysqli_fetch_array($registros)) {
        $dato.='<button type="button" class="btn btn-info" id="'.$reg['identificador_modulo'].'" >'.$reg['nombre_modulo'].'</button>';
                
    }
    return($dato);
  }


  function ver_personas_sistema(){
    $sql="select * from personas ";
    
    $dato='';
    $registros =ejecutar_consulta($sql);
    $dato='
    <table class="table">
        <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Documento</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Correo</th>
        <th>Operacion</th>
        </tbody>
        </thead>
        <tbody>';
    
    while ($reg = mysqli_fetch_array($registros)) {
        $dato.='
        <tr>
        <th>'.$reg['idpersonas'].'</th>
        <th>'.$reg['nombre'].'</th>
        <th>'.$reg['apellido'].'</th>
        <th>'.$reg['documento'].'</th>
        <th>'.$reg['telefono'].'</th>
        <th>'.$reg['direccion'].'</th>
        <th>'.$reg['correo'].'</th>
        <th>'.ver_botones_edicion("personas",$reg['idpersonas']).'</th>
        </tr>
        ';
                
    }
    $dato.='
    </tbody>
    </table>';
    return($dato);
  }

  function ver_usuarios_sistema(){
    $sql="select * from usuarios ";
    
    $dato='';
    $registros =ejecutar_consulta($sql);
    $estado=array("1"=>"Activo","2"=>"Inactivo");
    $perfiles=array("1"=>"Administrador","2"=>"Usuario general");
    $dato='
    <table class="table">
        <thead>
        <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Estado</th>
        <th>Perfil</th>
        <th>Operacion</th>
        </tr>
        </thead>
        <tbody>';
    
    while ($reg = mysqli_fetch_array($registros)) {
        $dato.='
        
        <tr>
        <th>'.$reg['idusuarios'].'</th>
        <th>'.$reg['nombre'].'</th>
        <th>'.$reg['usuario'].'</th>
        <th>'.$estado[$reg['estado']].'</th>
        <th>'.$perfiles[$reg['fk_idperfil']].'</th>
        <th>'.ver_botones_edicion("usuarios",$reg['idusuarios'],$reg['estado']).'</th>
        </tr>
        
        ';
                
    }
    $dato.='
    </tbody>
    </table>';
    return($dato);
  }


if(isset($_REQUEST['adicionar_usuario'])){
    $retorno=new stdClass;
    $retorno->exito=1;

    $sql="INSERT INTO usuarios(nombre, usuario, fk_idperfil) VALUES ('".$_REQUEST['nombre_registro']."','".$_REQUEST['usuario_registro']."','".$_REQUEST['fk_idperfil']."')";
    $texto='';
    $registro=ejecutar_consulta($sql);

    echo(json_encode($retorno));

}

if(isset($_REQUEST['adicionar_persona'])){
    $retorno=new stdClass;
    $retorno->exito=1;

    $sql="INSERT INTO `personas`(`nombre`, `apellido`, `documento`, `telefono`, `direccion`, `correo`) VALUES ('".$_REQUEST['nombre_persona']."','".$_REQUEST['apellido_persona']."','".$_REQUEST['documento_persona']."','".$_REQUEST['telefono_persona']."','".$_REQUEST['direccion_persona']."','".$_REQUEST['correo_persona']."')";
    $texto='';
    $registro=ejecutar_consulta($sql);

    echo(json_encode($retorno));

}

function cargar_datos_persona($idpersona){
    $sql="select * from personas where idpersonas like '".$idpersona."'";
    $registro=ejecutar_consulta($sql);
    
    $texto='';
    while ($fila = mysqli_fetch_array($registro)) {
        $texto.='
        <input type="text" readonly id="identificador_persona" placeholder="Identificador de persona" value="'.$fila['idpersonas'].'">
        <br>
        <input type="text" id="nombre_persona" placeholder="Nombre de persona" value="'.$fila['nombre'].'">
        <br>
        <input type="text" id="apellido_persona" placeholder="Apellido de persona" value="'.$fila['apellido'].'">
        <br>
        <input type="text" id="documento_persona" placeholder="Documento de persona" value="'.$fila['documento'].'">
        <br>
        <input type="text" id="telefono_persona" placeholder="Telefono de persona" value="'.$fila['telefono'].'">
        <br>
        <input type="text" id="direccion_persona" placeholder="Direccion de persona" value="'.$fila['direccion'].'">
        <br>
        <input type="text" id="correo_persona" placeholder="Correo de persona" value="'.$fila['correo'].'">
        <br>';
    }
    return($texto);
}

if(isset($_REQUEST['editar_persona'])){
    $retorno=new stdClass;
    $retorno->exito=1;

    $sql="UPDATE `personas` SET nombre='".$_REQUEST['nombre_persona']."',apellido='".$_REQUEST['apellido_persona']."',documento='".$_REQUEST['documento_persona']."',telefono='".$_REQUEST['telefono_persona']."',direccion='".$_REQUEST['direccion_persona']."',correo='".$_REQUEST['correo_persona']."' WHERE idpersonas='".$_REQUEST['identificador_persona']."'";

    $texto='';
    $registro=ejecutar_consulta($sql);

    echo(json_encode($retorno));

}

if(isset($_REQUEST['eliminar_persona'])){
    $retorno=new stdClass;
    $retorno->exito=1;
    $texto='';
    $sql='DELETE FROM `personas` WHERE idpersonas like "'.$_REQUEST['identificador'].'"';
    
    
    $registro=ejecutar_consulta($sql);

    echo(json_encode($retorno));

}

function cargar_datos_usuario($idusuarios){
    $sql="select * from usuarios where idusuarios like '".$idusuarios."'";
    $registro=ejecutar_consulta($sql);
    
    $texto='';
    while ($fila = mysqli_fetch_array($registro)) {
        $texto.='
        <input type="text" readonly id="identificador_usuario" placeholder="Identificador de usuario" value="'.$fila['idusuarios'].'">
        <br>
        <input type="text" id="nombre_usuario" placeholder="Nombre del usuario" value="'.$fila['nombre'].'">
        <br>
        <input type="text" id="usuario_usuario" placeholder="Etiqueta del usuario" value="'.$fila['usuario'].'">
        <br>';
        $texto.=perfiles_registro($fila['fk_idperfil']);
        $texto.='
        <input type="hidden" id="fk_idperfil" value="'.$fila['fk_idperfil'].'">
        <br>';
    }
    return($texto);
}

if(isset($_REQUEST['editar_usuario'])){
    $retorno=new stdClass;
    $retorno->exito=1;

    $sql="UPDATE `usuarios` SET nombre='".$_REQUEST['nombre_usuario']."',usuario='".$_REQUEST['usuario_usuario']."',fk_idperfil='".$_REQUEST['fk_idperfil']."' WHERE idusuarios like '".$_REQUEST['identificador_usuario']."'";

    $texto='';
    $registro=ejecutar_consulta($sql);

    echo(json_encode($retorno));

}

if(isset($_REQUEST['eliminar_usuario'])){
    $retorno=new stdClass;
    $retorno->exito=1;
    $texto='';
    $sql='DELETE FROM `usuarios` WHERE idusuarios like "'.$_REQUEST['identificador'].'"';
    
    
    $registro=ejecutar_consulta($sql);

    echo(json_encode($retorno));

}

if(isset($_REQUEST['cambio_estado_usuario'])){
    $retorno=new stdClass;
    $retorno->exito=1;

    $sql="UPDATE `usuarios` SET estado='".$_REQUEST['estado']."' WHERE idusuarios like '".$_REQUEST['identificador']."'";

    $texto='';
    $registro=ejecutar_consulta($sql);

    echo(json_encode($retorno));

}
?>