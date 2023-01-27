
    
    $(document).on("click","#gestion_usuarios",function () {
    console.log("Mostrar gestion de usuarios");
    $("#informacion_gestion_usuarios").show(500);
    $("#informacion_registro_usuarios").hide(500);
    });

    $(document).on("click","#registro_usuarios",function () {
    console.log("Mostrar registro usuarios");
    $("#informacion_registro_usuarios").show(500);
    $("#informacion_gestion_usuarios").hide(500);
    });

    $(document).on("click",".radio_elegido",function () {
    console.log("perfil escogido");
    valor=$(this).val();
    $("#fk_idperfil").val(valor);
    });
    
    $(document).on("click","#inicio_usuario",function () {
        console.log("inicio");
        usuario=$("#usuario").val();
        
        if(usuario==''){
            alert("Debes llenar el campo de usuario");
        }
        else{
            $.ajax({
                type:'POST',
                url: "funciones.php",
                data: "verificar=1&usuario="+usuario,
                success: function(html){
                    console.log(html);
                    objeto_verificar=jQuery.parseJSON(html);
                    if(objeto_verificar.datos>"0"){
                        window.open("menu.php?session="+objeto_verificar.datos,"_self");
                    }
                    else{
                        alert("El nombre del usuario no esta registrado en el sistema");
                    }
                }
            });
        }

    });

    $(document).on("click","#aceptar_registro",function () {
    console.log("Registrando usuario");
    nombre_registro=$("#nombre_registro").val();
    usuario_registro=$("#usuario_registro").val();
    fk_idperfil=$("#fk_idperfil").val();
    console.log("val1: "+nombre_registro);
    console.log("val2: "+usuario_registro);
    console.log("val3: "+fk_idperfil);
    if(fk_idperfil!="" && nombre_registro!="" && usuario_registro!=""){
        console.log("realizar registro");
        $.ajax({
            type:'POST',
            url: "funciones.php",
            data: "adicionar_usuario=1&nombre_registro="+nombre_registro+"&usuario_registro="+usuario_registro+"&fk_idperfil="+fk_idperfil,
            success: function(html){
                console.log(html);
                objeto_adicion=jQuery.parseJSON(html);
                if(objeto_adicion.exito>"0"){
                    alert("El usuario se registro con exito");
                    window.history.go(-1);
                }
                
            }
        });
    }
    else{
        console.log("Falta ingresar informacion");
    }
    
    });

    $(document).on("click","#gestion_personas",function () {
        console.log("Mostrar gestion de usuarios");
        $("#contenido_gestion_personas").show(500);
        $("#contenido_gestion_usuarios").hide(500);
    });

    $(document).on("click","#gestion_usuarios",function () {
        console.log("Mostrar registro usuarios");
        $("#contenido_gestion_usuarios").show(500);
        $("#contenido_gestion_personas").hide(500);
    });

    $(document).on("click","#adicion_usuario",function () {
        window.open("adicionar_usuario.php","_self");
        
    });

    $(document).on("click","#adicion_personas",function () {
        window.open("adicionar_persona.php","_self");
        
    });


    $(document).on("click","#aceptar_registro_persona",function () {
    console.log("Registrando usuario");
    
    nombre_persona=$("#nombre_persona").val();
    apellido_persona=$("#apellido_persona").val();
    documento_persona=$("#documento_persona").val();
    telefono_persona=$("#telefono_persona").val();
    direccion_persona=$("#direccion_persona").val();
    correo_persona=$("#correo_persona").val();
    
    if(nombre_persona!="" && apellido_persona!="" && documento_persona!="" && telefono_persona!="" && direccion_persona!="" && correo_persona!=""){
        console.log("realizar registro persona");
        $.ajax({
            type:'POST',
            url: "funciones.php",
            data: "adicionar_persona=1&nombre_persona="+nombre_persona+"&apellido_persona="+apellido_persona+"&documento_persona="+documento_persona+"&telefono_persona="+telefono_persona+"&direccion_persona="+direccion_persona+"&correo_persona="+correo_persona,
            success: function(html){
                console.log(html);
                objeto_adicion=jQuery.parseJSON(html);
                if(objeto_adicion.exito>"0"){
                    alert("La persona se registro con exito");
                    window.history.go(-1);
                }
                
            }
        });
    }
    else{
        console.log("Falta ingresar informacion");
    }
    
    });

    $(document).on("click",".editar_personas",function () {
        identificador=$(this).attr("identificador");
        console.log("editando persona"+identificador);
        
        window.open("editar_persona.php?idpersona="+identificador,"_self");
        
    });

    $(document).on("click",".editar_usuarios",function () {
        identificador=$(this).attr("identificador");
        console.log("editando usuario "+identificador);
        
        window.open("editar_usuario.php?idusuario="+identificador,"_self");
        
    });

    


    $(document).on("click","#editar_registro_persona",function () {
        console.log("editar persona");
        identificador_persona=$("#identificador_persona").val();
        nombre_persona=$("#nombre_persona").val();
        apellido_persona=$("#apellido_persona").val();
        documento_persona=$("#documento_persona").val();
        telefono_persona=$("#telefono_persona").val();
        direccion_persona=$("#direccion_persona").val();
        correo_persona=$("#correo_persona").val();
        
        if(nombre_persona!="" && apellido_persona!="" && documento_persona!="" && telefono_persona!="" && direccion_persona!="" && correo_persona!=""){
            console.log("realizar registro persona");
            $.ajax({
                type:'POST',
                url: "funciones.php",
                data: "editar_persona=1&nombre_persona="+nombre_persona+"&apellido_persona="+apellido_persona+"&documento_persona="+documento_persona+"&telefono_persona="+telefono_persona+"&direccion_persona="+direccion_persona+"&correo_persona="+correo_persona+"&identificador_persona="+identificador_persona,
                success: function(html){
                    console.log(html);
                    objeto_adicion=jQuery.parseJSON(html);
                    if(objeto_adicion.exito>"0"){
                        alert("La persona se edito con exito");
                        window.history.go(-1);
                        
                    }
                    
                }
            });
        }
        else{
            console.log("Falta ingresar informacion");
        }
        
        });

    $(document).on("click",".eliminar_personas",function () {
        identificador=$(this).attr("identificador");
        console.log("eliminar persona");
        $.ajax({
            type:'POST',
            url: "funciones.php",
            data: "eliminar_persona=1&identificador="+identificador,
            success: function(html){
                console.log(html);
                objeto_adicion=jQuery.parseJSON(html);
                if(objeto_adicion.exito>"0"){
                    alert("La persona se elimino con exito");
                    window.location.reload();
                }
                
            }
        });
    });

    $(document).on("click","#editar_registro_usuario",function () {
        console.log("editar persona");
        identificador_usuario=$("#identificador_usuario").val();
        nombre_usuario=$("#nombre_usuario").val();
        usuario_usuario=$("#usuario_usuario").val();
        fk_idperfil=$("#fk_idperfil").val();
                
        if(identificador_usuario!="" && nombre_usuario!="" && usuario_usuario!="" && fk_idperfil!=""){
            console.log("realizar registro persona");
            $.ajax({
                type:'POST',
                url: "funciones.php",
                data: "editar_usuario=1&identificador_usuario="+identificador_usuario+"&nombre_usuario="+nombre_usuario+"&usuario_usuario="+usuario_usuario+"&fk_idperfil="+fk_idperfil,
                success: function(html){
                    console.log(html);
                    objeto_adicion=jQuery.parseJSON(html);
                    if(objeto_adicion.exito>"0"){
                        alert("El usuario se edito con exito");
                        window.history.go(-1);
                        
                    }
                    
                }
            });
        }
        else{
            console.log("Falta ingresar informacion");
        }
        
        });

        $(document).on("click",".eliminar_usuarios",function () {
            identificador=$(this).attr("identificador");
            console.log("eliminar usuario");
            $.ajax({
                type:'POST',
                url: "funciones.php",
                data: "eliminar_usuario=1&identificador="+identificador,
                success: function(html){
                    console.log(html);
                    objeto_adicion=jQuery.parseJSON(html);
                    if(objeto_adicion.exito>"0"){
                        alert("El usuario se elimino con exito");
                        window.location.reload();
                    }
                    
                }
            });
        });

        $(document).on("click",".cambio_estado",function () {
            identificador=$(this).attr("identificador");
            estado=$(this).attr("estado");
            console.log("val: "+identificador);
            console.log("val: "+estado);
            estado_nuevo="";
            if(estado=="2"){
                estado_nuevo="1";
            }
            else{
                estado_nuevo="2";
            }
            console.log("cambio usuario");
            $.ajax({
                type:'POST',
                url: "funciones.php",
                data: "cambio_estado_usuario=1&identificador="+identificador+"&estado="+estado_nuevo,
                success: function(html){
                    console.log(html);
                    objeto_adicion=jQuery.parseJSON(html);
                    if(objeto_adicion.exito>"0"){
                        alert("El usuario se cambio estado con exito");
                        window.location.reload();
                    }
                    
                }
            });
        });
    
