<?php
    require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no, user-scalable=no"/>
        <meta name="description" content="Rastreo y ubicación satelital">
        <meta name="author" content="<?php echo $general['titulo_web']; ?>">

        <link rel="shortcut icon" href="favicon.ico">
        <title><?php echo $general['titulo_web']; ?></title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css"/>

        <!-- Custom styles for this template-->
        <link href="css/signin.css" rel="stylesheet"/>

        <style>

            .message_modal{
                width: 300px;
                background-color: #000;
                height: 100px;
                position: absolute;
                left: 50%;
                top: 50%;
                margin: 0 auto;
                text-align: center;
                vertical-align: middle;
                transform: translate(-50%, -50%);
            }
        </style>

    </head>

    <body>
        <div class="container">

            <form id="loginForm" class="form-signin" role="form" action="#">
                <img class="form-logo" src="images/logo.png"/>
                <input id="inputUsuario" type="text" class="form-control input-sm" name="usuario" placeholder="Usuario" required>
                <input id="inputPassword" type="password" class="form-control input-sm" name="password" placeholder="Contraseña" autocomplete="on" required>
                <button id="loginNow" class="btn btn-lg btn-success btn-block">Ingresar</button>
                <span class="poweredBy">Desarrollado por <a href="<?php echo $empresa['web_desarrollador']; ?>" target="blank"><?php echo $empresa['desarrollador']; ?></a> </span>
    
            </form>

            <a id="WhatsApp" class='btn btn-danger' target="_blank" href="<?php echo $whatsapp_link; ?>">Contacto</a>
            <!-- <a id="WhatsApp" class='btn btn-danger' target="_blank" href="https://api.whatsapp.com/send?phone=51991143120&text=Tengo%20una%20consulta%20desde%20la%20App">Atencion al Cliente</a>-->
            <!-- <a id="WhatsApp" class='btn btn-danger' target="_blank" href="https://api.whatsapp.com/send?phone=51942301330&text=Tengo%20una%20consulta%20desde%20la%20App">Monitoreo 1</a> -->
            <!-- <a id="Waze" class='btn btn-danger' target="_blank" href="https://waze.com/ul?ll=-11.992253,-77.070244&navigate=yes">Waze</a> -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="usuario_desactivado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Mensaje del Sistema</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Usuario no se encuentra activo
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/global.js"></script>

    <script>

        var storageKey = "<?php echo $general['llave_sitio']; ?>";

        $(document).ready(function() {

            if (typeof(Storage) !== "undefined") {
                /* Rutina para verificar que el usuario exista en el teléfono */
                storageData = JSON.parse(localStorage.getItem(storageKey));
                
                if (storageData === null){
                    storageData       = {
                        accountID:          "",
                        userID:             "",
                        password:           "",
                        description:        "",
                        isActive:           0,
                        groupID:            "",
                    };
                    /* NO EXISTE UNA SESION PREVIA*/

                } else {
                    /* SI EXISTE UNA SESION PREVIA, REDIRIGIENDO A LA PAGINA SYSTEM.PHP*/
                    window.setTimeout(function() {location.href = "system.php";}, 0);
                
                };
            } else {
                alert("La app no puede correr en esta version");
            }

            $("#loginForm").submit(function(e) {
                e.preventDefault();
                return false;
            });
            
            $("#loginNow").click(function(e){
                // alert("hola");
                e.preventDefault();
                var inputUsuario    = $("#inputUsuario").val();
                var inputPassword   = $("#inputPassword").val();
                
                if ((inputUsuario == "") || (inputPassword == "")){
                    // Do nothing.
                }else{
                    checkLogin(inputUsuario,inputPassword);
                }
                
            });
            
        });

        $(document).on('keydown','#password', function(ev){
            if (ev.which === 13 ){
                $("#procesar").click();
                return false;
            }
        });

        function checkLogin(usuario,password){
            $.ajax({
                url: "doLogin.php",
                data: {
                    cuenta:     "<?php echo $general['cuenta_asociada']; ?>", // Constante en config.php
                    usuario:    usuario,
                    password:   password
                },
                timeout: 30000,
                error: function(x,t,m){
                    if (t==="timeout"){
                        alert("Se sobrepasó el tiempo de espera");
                    }
                },
                success: function(datos){
                    //loading(false);
                    var ajaxData    = $.parseJSON(datos);
                
                    /** Llenando variables con la consulta SQL **/
                    $.each(ajaxData,function(index,value){

                        storageData       = {
                            accountID:          ajaxData[index].accountID,
                            userID:             ajaxData[index].userID,
                            password:           ajaxData[index].password,
                            description:        ajaxData[index].description,
                            isActive:           ajaxData[index].isActive,
                            groupID:            ajaxData[index].groupID,
                        };

                    });         

                    if (storageData.accountID != "" && storageData.isActive == 1){
                        /* La cuenta existe y el usuario esta activo*/
                        localStorage.setItem(storageKey,JSON.stringify(storageData));
                        window.setTimeout(function() {location.href = "system.php";}, 0);

                    } else if(storageData.isActive==0){
                        $('#usuario_desactivado').modal('show');

                    } else{
                        
                        $("#inputUsuario").val("");
                        $("#inputPassword").val("");
                        $("#inputUsuario").focus();
                        alert('Usuario y/o contraseña errada');
                    }
                    
                }
            });
        };

    </script>

  </body>
</html>
