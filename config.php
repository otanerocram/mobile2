<?php

    $general    = array(
        'titulo_web'            => 'NombreWeb',
        'llave_sitio'           => 'bmlzaWdwczE=',
        'cuenta_asociada'       => 'account',
        'instancia_tomcat'      => 'Track?',
        'api_google_maps'       => 'AIzaSyBEPCRDO0w_ELCdi8JmvdmGF3VbZS6SPqA',
        'enlace_plataforma'     => 'http://gpsfenix.net:8080/track/Track?',
        'enlace_banners'        => 'http://142.93.185.141:8080/monitoreo/images/banner',
        'country_code'        => '51',
    );

    $empresa    = array(
        'desarrollador'         => 'otaneRocraM',
        'web_desarrollador'     => 'https://www.beltren.dev',
        'whatsapp'              => '15484000051'
    );

    $database   = array(
        'hostname'  => '127.0.0.1',
        'username'  => 'gts',
        'password'  => 'password',
        'database'  => 'gts',
        'port'      => 3305
    );

    $mailDetails = array(
        'hostname'      => "mail.mailserver.com",
        'username'      => "alertas@mailserver.com",
        'password'      => 'password',
        'port'          => 25,
        'fromName'      => "Reporte de BUS",
        'fromEmail'     => "alertas@mailserver.com",
        'subject'       => "Notificacion automatica del BUS",
        'replayEmail'   => "sistemas@aguilacontrol.com",
        'toEmail'       => "sistemas@aguilacontrol.com",
    );

    $system     = array(
        'sysName'   => 'PLEX',
        'appKey'    => 'cGxleGFwcA==',
        'timezone'  => -5,
    );

    $whatsapp_link = "https://api.whatsapp.com/send?phone=".$empresa['whatsapp']."&text=Tengo%20una%20consulta%20desde%20la%20App";

    // Funcion para verificar si la sesion ha sido iniciada previamente
    function is_session_started() {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }

    function toConsole( $data ) {
        if (is_array($data)){
            $output = "<script>console.log( '" . implode( ',', $data) . "' );</script>";
        } else {
            $output = "<script>console.log( '" . $data . "' );</script>";
        }
        echo $output;
    }

    function ordernarArray($ArrayaOrdenar, $por_este_campo, $descendiente = false) {
        $posicion = array();
        $NuevaFila = array();
        
        foreach ($ArrayaOrdenar as $clave => $fila) {
            $posicion[$clave] = $fila[$por_este_campo];
            $NuevaFila[$clave] = $fila;
        }

        if ($descendiente) {
            arsort($posicion);
        } else {
            asort($posicion);
        }

        $ArrayOrdenado = array();
        
        foreach ($posicion as $clave => $pos) {
            $ArrayOrdenado[] = $NuevaFila[$clave];
        }
        return $ArrayOrdenado;
        
    }
?>
