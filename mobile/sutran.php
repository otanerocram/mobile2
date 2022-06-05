<?php

$placa = strtoupper($_GET["placa"]);

if ($placa == "") {
    $response[] = array(
        'RESPONSE'              => "SIN_PLACA"
    );

    echo json_encode($response);
    die();
}

$placaConsulta  = preg_replace("/-/", "", $placa);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://webexterno.sutran.gob.pe/ConsultaSutran/");
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, "TipoConsulta=0&Vehiculo.Placa=$placaConsulta");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$remote_server_output = curl_exec($ch);
curl_close($ch);

$dom = new DOMDocument();
@$dom->loadHTML($remote_server_output);
$txt = "";

foreach ($dom->getElementsByTagName('button') as $btn) {
    $txt .= $btn->getAttribute('onclick');
}

function encuentra($searchThis)
{
    global $txt;

    $pos1 = strpos($txt, '"' . $searchThis . '"');
    $len1 = strlen('"' . $searchThis . '"');
    $startPos = $pos1 + $len1 + 1;


    $respStr = "";
    $letra = "";

    for ($i = 1; $i <= 100; $i++) {

        // print_r("pos: ".($startPos+$i)."<br>"); 
        $letra = substr($txt, $startPos + $i, 1);
        $esComilla = strcmp($letra, '"'); // El valor es CERO en caso de ser igual a la comilla
        // print_r("esComilla: ".$esComilla."<br>");
        // print_r("letra: ".$letra."<br>");

        if ($esComilla != 0) {
            $respStr .= $letra;
        } else {
            break;
        }
    }

    // print_r("resp: ".$respStr);
    if (strpos($respStr, "'{") !== false) {
        $respStr = "No Habilitado";
    }

    return $respStr;
}

if (encuentra("STR_PLACA") == "") {
    $response[] = array(
        'RESPONSE'              => "SIN_REGISTRO"
    );
    die();
}

$response[] = array(
    'RESPONSE'              => "REGISTRO",
    'STR_PLACA'             => encuentra("STR_PLACA"),          // SOAT
    'NRO_MOTOR'             => encuentra("NRO_MOTOR"),
    'STR_NROPOLIZA'         => encuentra("STR_NROPOLIZA"),
    'STR_ENTIDADPOLIZA'     => encuentra("STR_ENTIDADPOLIZA"),
    'DTE_FECHAPOLIZA'       => encuentra("DTE_FECHAPOLIZA"),
    'STR_ENTIDADCITV'       => encuentra("STR_ENTIDADCITV"),    // Revision Tecnica
    'STR_NROCITV'           => encuentra("STR_NROCITV"),
    'DTE_FECHACITV'         => encuentra("DTE_FECHACITV"),
    'STR_ANIO_FABRICA'      => encuentra("STR_ANIO_FABRICA"),
    'EMV_CODIGOV'           => encuentra("CodigoV"),   // Transmision GPS
    'EMV_NOMBRE_ETT'        => encuentra("NombreETT"),
    'EMV_FVIGENCIA'         => encuentra("FVigencia"),
    'EMV_ESTADO'            => encuentra("Estado"),
    'EMV_NOMBRE_EMV'        => encuentra("NombreEMV"),
    'EMV_FECHA'             => encuentra("Fecha"),
    'EMV_FECHA_TRANSMISION' => encuentra("FechaTransmision"),
    'EMV_SITUACION'         => encuentra("Situacion"),
    'EMV_EVENTO'            => encuentra("Evento"),
    'EMV_LATITUD'           => encuentra("Latitud"),
    'EMV_LONGITUD'          => encuentra("Longitud"),
    'EMV_VELOCIDAD'         => encuentra("Velocidad"),
    'EMV_RUMBO'             => encuentra("Rumbo"),
    'EMV_TIPO_SERVICIO'     => encuentra("TipoServicio"),
    'EMV_DIRECCION'         => encuentra("Direccion"),
    'DTE_FECHABILITACION'   => encuentra("DTE_FECHABILITACION"),   // Habilitacion vehicular
    'DTE_FECHAVIGENCIA'     => encuentra("DTE_FECHAVIGENCIA"),
    'DTE_FECRESINSCRIPCION' => encuentra("DTE_FECRESINSCRIPCION"),
    'STR_NUMRESINSCRIPCION' => encuentra("STR_NUMRESINSCRIPCION"),
);

echo json_encode($response);
/**
 * Servicio De Carga Nacional - CNG
 * Servicio De Carga Internacional –C
 * Servicio De Trabajadores Por Carretera –PNW
 * Transporte Propio Carga Internacional Extranjera – X
 * Servicio De Pasajeros Internacional Extranjero – Y
 * Servicio De Transporte Carga Extranjera – Z
 * Carga Nacional De Explosivos – CNE
 * Carga Nacional Propio – CNP
 * Carga Internacional Transporte Propio – E
 * Servicio Comunal Departamental – PDC
 * Servicio Excepcional Departamental – PDE
 * Pasajero Departamental Regional – PDR
 * Servicio Turístico Departamental – PDT
 * Pasajero Internacional Regional – PIR
 * Servicio De Auto Móviles – PNA
 * Servicio Nacional Comunal – PNC
 * Servicio Nacional Excepcional – PNE
 * Servicio Nacional Turístico – PNT
 * Servicio Nacional Regular –PNR
 * Resolución Directoral - RD
 */
