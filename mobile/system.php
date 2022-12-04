<?php
require_once('../config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no, user-scalable=no" />
    <title><?php echo $general['titulo_web']; ?></title>
    <script src="https://kit.fontawesome.com/f55cdfb362.js" crossorigin="anonymous" SameSite="None"></script>
    <link rel="shortcut icon" href="favicon.ico">
    <!-- <link rel="stylesheet" href="jqm/jquery.mobile-1.4.2.min.css" /> -->

    <!-- Bootstrap Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />

    <!-- Leaflet Geocoder-->
    <link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" />

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> -->

    <!-- Hoja de estilos del sistema -->
    <!-- <link rel="stylesheet" href="css/general.css" /> -->
    <style>
        body {
            /* min-height: 2000px; */
            padding-top: 50px;
            overflow-y: hidden;
        }

        html {
            overflow-y: hide;
        }

        .logo {
            position: absolute;
            z-index: 1000;
            top: 60px;
            right: 10px;
            width: 140px;
            opacity: .9;
        }

        .top-menu-icon {
            width: 35px;
            margin-top: 0px;
            display: inline-block !important;
            margin-right: 10px;
        }

        .header-text {
            display: inline-block;
            margin-left: 10px;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #3379b7;
            overflow-x: hidden;
            transition: 0.2s;
            /* padding-top: 60px; */
            z-index: 2000;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            left: 0;
            font-size: 36px;
            margin-left: 20px;
            color: #FFF;
        }

        #list_search_input {
            margin: 45px 10px 5px 10px;
            width: 260px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        .spinner {
            width: 200px;
            height: 200px;
            margin: -100px -100px;
            background-color: #65bc64;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
            animation: sk-scaleout 1.0s infinite ease-in-out;
            position: absolute;
            z-index: 2001;
            top: 50%;
            right: 50%;
            opacity: 0.2
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }

            100% {
                -webkit-transform: scale(1.0);
                opacity: 0;
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
                opacity: 0;
            }
        }

        .leaflet-tooltip-error {
            background-color: #7b7979;
            padding: 0 6px;
            text-transform: uppercase;
            font-size: 14px;
            color: #FFF
        }

        .leaflet-tooltip-stop {
            background-color: #d9534f;
            padding: 0 6px;
            text-transform: uppercase;
            font-size: 14px;
            color: #FFF
        }

        .leaflet-tooltip-move {
            background-color: #5cb85c;
            padding: 0 6px;
            text-transform: uppercase;
            font-size: 14px;
            color: #FFF
        }

        .leaflet-tooltip-speed {
            background-color: blue;
            padding: 0 6px;
            text-transform: uppercase;
            font-size: 14px;
        }

        .navbar-fixed-top .navbar-collapse {
            max-height: 400px;
        }

        .open-nav {
            /* font-size: 30px; */
            cursor: pointer;
            /* color: #5f87bf; */
            /* background-color: #f2efea;
            padding: 2px 7px;
            border-radius: 10px; */

            /* background-color: #f2efea; */
            padding: 5px;
            border-radius: 11px;
            border: 1px solid;

        }

        .h-60 {
            max-height: 60px;
            height: 60px;
        }

        .margin-top-5 {
            margin-top: 5px;
        }

        .device-info-count {
            background-color: #f3f3f3;
        }

        .info-counter {
            display: block;
            /* margin-left: 10px; */
        }

        .color-primary {
            color: #428bca;
        }

        .color-success {
            color: #5cb85c;
        }

        .color-error {
            color: #d9534f;
        }

        .color-default {
            color: #7b7979;
        }

        .bg-color-primary {
            background-color: #428bca;
        }

        .bg-color-success {
            background-color: #5cb85c;
        }

        .bg-color-error {
            background-color: #d9534f;
        }

        .bg-color-default {
            background-color: #7b7979;
        }

        /**/
        .font-status-color-default {
            color: #826f6f;
        }

        .font-status-color-stop {
            color: #d9534f;
        }

        .font-status-color-motion {
            color: #5cb85c;
        }

        .font-status-color-power-alert {
            color: #f0ad4e;
        }

        .font-status-color-speeding {
            color: #337ab7;
        }

        .font-status-color-engine-on {
            color: #f0ad4e;
        }

        .font-status-color-engine-off {
            color: #f0ad4e;
        }

        .font-status-color-panic-on {
            color: #f0ad4e;
        }

        /**/

        .bg-status-color-default {
            background-color: #826f6f;
        }

        .bg-status-color-stop {
            background-color: #d9534f;
        }

        .bg-status-color-motion {
            background-color: #5cb85c;
        }

        .bg-status-color-power-alert {
            background-color: #f0ad4e;
        }

        .bg-status-color-speeding {
            background-color: #337ab7;
        }

        .bg-status-color-engine-on {
            background-color: #f0ad4e;
        }

        .bg-status-color-engine-off {
            background-color: #f0ad4e;
        }

        .bg-status-color-panic-on {
            background-color: #f0ad4e;
        }

        .fleetInfo {
            position: absolute;
            bottom: 0;
            z-index: 30000;
            background-color: #FFF;
            width: 100%;
            height: 120px;
            display: block;
            text-align: center;
            max-height: 120px;
            display: block;
            text-align: center;
            overflow-y: hidden;
            overflow-x: hidden;
        }

        .autozoom {
            position: absolute;
            z-index: 400;
            top: 90px;
            left: 10px;
            padding: 8px;
            background-color: #FFF;
            border-radius: 10px;
        }

        #basemaps-wrapper {
            position: absolute;
            top: 60px;
            left: 10px;
            z-index: 400;
            /* background: white; */
            /* padding: 5px; */
        }

        #basemaps {
            margin-bottom: 5px;
            background-color: #fafafa;
            padding: 2px 5px;
        }

        .info-col div {
            display: inline-block;
        }

        .dateTimeBox {
            display: block;
        }

        .dateTimeBox span {
            display: block;
        }

        .h-55 {
            height: 55px;
            max-height: 55px;
        }

        .h-48 {
            height: 48px;
            max-height: 48px;
        }

        .topAddress {
            height: 20px;
            max-height: 20px;
            line-height: 20px;
            font-size: 12px;
            color: #fff;
            background-color: #364156;
            margin: 0 auto;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .listAddress {
            margin-bottom: 5px;
            border-bottom: 0.5px solid #d8d8d8;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .no-padding {
            padding-left: 0px;
            padding-right: 0px;
        }

        .no-margin {
            margin-left: 0px;
            margin-right: 0px;
        }

        .overlay-info {
            height: 120px;
            max-height: 120px;
            line-height: 120px;
            position: absolute;
            z-index: 99999;
            background-color: #5cb85b;
            width: 100%;
        }

        .overlay-info>div {
            color: #FFF;
            font-size: 20px;
        }

        .plate {
            color: #FFF;
            padding: 5px 0px;
            font-size: 14px;
        }

        .topBox {
            display: block;
            border-right: 2px solid #333;
            margin: 1px auto;
            padding: 4px;
            font-weight: bold;
        }

        .topBox i,
        .topBox span {
            display: block;
        }

        .info-topBox {
            font-size: 11px;
            margin-top: -5px;
        }

        .timeBox {
            font-size: 20px;
            font-weight: bold;
            color: #d9514f;
        }

        .dateBox {
            color: #7b7979;
            font-size: 13px;
            font-weight: bold;
        }

        .linkBox {
            padding-top: 10px;
        }

        .linkBox i,
        .linkBox span {
            display: block;
        }

        .pop_buble_row_one {
            text-align: center;
        }

        .pop_buble_plate {
            display: block;
            font-size: 18px;
            font-weight: bold;
        }

        .pop_buble_display_name {
            display: block;
            color: #7d7d7d;
            padding: 0 4px 5px 4px;
            text-transform: uppercase;
            font-size: 12px;
        }

        .pop_buble_row_twp {
            height: 40px;
            max-height: 40px;
            line-height: 40px;
            text-align: center;
        }

        .pop_buble_speed {
            display: inline-block;
            vertical-align: middle;
            line-height: normal;
            color: #FFF;
            padding: 0 5px;
            font-size: 14px;
        }

        .pop_buble_row_three {
            width: 200px;
            max-width: 200px;
        }

        .pop_buble_dateTime {
            margin: 5px;
            text-align: center;
            display: block;
            font-weight: bold;
            font-size: 14px;
        }

        .pop_buble_row_four {
            width: 200px;
            max-width: 200px;
            border-top: 1px solid #ececec;
        }

        .pop_buble_address {
            margin: 5px;
            text-align: center;
            display: block;
        }

        .pop_buble_row_five {
            width: 200px;
            max-width: 200px;
            border-top: 1px solid #ececec;
            padding-top: 5px;
        }

        .pop_buble_location {
            text-align: center;
            display: block;
            color: #808080;
            text-shadow: none;
            font-size: 14px;
        }

        .leaflet-popup-content-wrapper {
            padding: 1px 0;
        }

        .leaflet-popup-content {
            margin: 13px 0
        }

        .sutran-modal {
            z-index: 99999;
            overflow-y: overlay !important;
            font-size: 12px;
        }

        .modal-info-left {
            background-color: #153882;
            color: #FFF;
        }

        .cero-padding {
            padding: 0px !important;

        }

        .list-block-center>img,
        .list-block-center>span {
            display: block;
            margin: 0 auto;
        }

        .list_velocidad {
            text-align: right;
        }

        .text-12 {
            font-size: 12px;
        }

        .text-14 {
            font-size: 14px;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .d-block {
            display: block
        }

        .m-0-auto {
            margin: 0 auto;
        }

        .m-b-5 {
            margin-bottom: .5rem;
        }

        .blinking {
            animation: blinkingText 1.2s infinite;
        }

        @keyframes blinkingText {
            0% {
                color: #826f6f;
            }

            49% {
                color: #826f6f;
            }

            60% {
                color: transparent;
            }

            99% {
                color: transparent;
            }

            100% {
                color: #826f6f;
            }
        }
    </style>

</head>

<body>
    <div class="spinner"></div>
    <!-- <a href="sms:+51951983781?body=check123456">Send SMS message</a> -->

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <form>
            <div class="form-group">
                <input type="text" class="form-control" id="list_search_input" placeholder="Buscar...">
            </div>
        </form>
        <div id="deviceList" class="devScrl">

        </div>
    </div>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <span class="open-nav" onclick="openNav()"><i class="fa fa-search" aria-hidden="true"></i></span>
                    <div class="header-text" id="welcomeNavbar"><?php echo $general['titulo_web']; ?></div>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li></li>
                    <li id="fltMap" class="active"><a href="#"><img class="top-menu-icon" src="images/fleet-icon.png" alt="">Mapa de Flota Completa</a></li>
                    <!--<li id="devMap"><a href="#"><img class="top-menu-icon" src="images/tracking-icon.png" alt="">Seguimiento detallado de unidad</a></li>-->
                    <li><a id="platformLink" target="_blank" href="#"><img class="top-menu-icon" src="images/pc-icon.png" alt="">Abrir la versi&oacute;n de computadora</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a target="_blank" href="<?php echo $whatsapp_link; ?>"><img class="top-menu-icon" src="images/whatsapp-icon.png" alt="">Cont&aacute;ctenos por WhatsApp</a></li>
                    <li><a target="_blank" href="<?php echo $empresa['web_desarrollador']; ?>"><img class="top-menu-icon" src="images/web-icon.png" alt="">Visite nuestra web</a></li>
                    <li>
                        <hr>
                    </li>
                    <li><a target="_blank" href="#" id="CloseSession"><img class="top-menu-icon" src="images/exit-icon.png" alt="">Cerrar sesi&oacute;n</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <!-- Ventana Principal - MAIN -->
    <div class="main">
        <!-- Logo flotante-->
        <div><img id="logoImage" class="logo" src="images/logo.png" /></div>
        <!-- Contenedor de Mapa -->
        <div id="mapid"></div>
        <!-- Selector de Mapas -->
        <div id="basemaps-wrapper" class="">
            <select id="basemaps">
                <option value="Physical">Mapa normal</option>
                <option value="Topographic">Topogr&aacute;fico</option>
                <option value="Streets">Calles</option>
                <option value="Gray">Gris</option>
                <option value="DarkGray">Modo nocturno</option>
                <option value="Imagery">Satelital</option>
                <option value="ImageryClarity">Satelital (v2)</option>
                <option value="ShadedRelief">Relieve</option>
            </select>
        </div>
        <!-- Switch de AutoZoom -->
        <div class="pretty p-switch autozoom">
            <input type="checkbox" id="flipZoom" checked data-toggle="tooltip" data-placement="bottom" title="Activar/Desactivar Centrado Autom&aacute;tico" />
            <div class="state p-success"><label>Auto Zoom</label></div>
        </div>
        <!-- Footer de Informacion -->
        <div id="fleetInfo" class="fleetInfo">
            <div class="row no-margin">
                <!-- Panel de Informacion - IZQUIERDO -->
                <div class="col-xs-3 no-padding device-info-count">
                    <div class="row h-60">
                        <div class="col-xs-12 margin-top-5">
                            <div class="col-xs-6">
                                <i class="fa fa-cubes fa-lg color-primary" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Total de unidades monitoreadas"></i>
                                <span id="totalDevices" class="info-counter color-primary">0</span>
                            </div>
                            <div class="col-xs-6">
                                <i class="fa fa-exclamation-circle fa-lg color-default" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Unidades sin se&ntilde;al"></i>
                                <span id="totalDisconnect" class="info-counter color-default">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="row h-60">
                        <div class="col-xs-12 margin-top-5">
                            <div class="col-xs-6">
                                <i class="fa fa-car fa-lg color-error" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Unidades detenidas"></i>
                                <span id="totalStop" class="info-counter color-error">0</span>
                            </div>
                            <div class="col-xs-6">
                                <i class="fa fa-truck fa-lg color-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Unidades en movimiento"></i>
                                <span id="totalInMotion" class="info-counter color-success">0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Panel de Informacion - DERECHO -->
                <div class="col-xs-9 no-padding">
                    <!-- Overlay Panel -->
                    <div class="overlay-info">
                        <div>Haga clic en alguna unidad</div>
                    </div>

                    <!-- FILA: Placa y Codigo - Fecha y Hora - Link Waze -->
                    <div class="row h-48 no-margin">
                        <div class="col-xs-12 no-padding">
                            <div class="col-xs-4 no-padding dateTimeBox"><span id="timeBox" class="timeBox"></span><span id="dateBox" class="dateBox"></span></div>
                            <div class="col-xs-4 plateBox no-padding">
                                <div class="plate bg-color-error"></div>
                                <div id="label_displayName" class="dateBox"></div>
                            </div>
                            <div class="col-xs-4 no-padding linkBox"><i class="fa fa-map-marker fa-lg color-primary" aria-hidden="true"></i><span id="wazeLink" class="dateBox"></span></div>
                        </div>
                    </div>

                    <!-- FILA: Direccion -->
                    <div class="row no-margin topAddress">
                        <div id="description_text" class="col-xs-12 no-padding"></div>
                    </div>

                    <!-- FILA: Velocidad - Odometro - Detalle GPS - Llamar -->
                    <div class="row h-55 no-margin">
                        <div class="col-xs-12 no-padding">
                            <div class="col-xs-3 speedBox no-padding">
                                <div class="topBox"><i class="fa fa-tachometer fa-lg color-default" aria-hidden="true"></i><span id="label_speed"></span><span class="info-topBox">Kph</span></div>
                            </div>
                            <div class="col-xs-3 odometerBox no-padding">
                                <div class="topBox"><i class="fa fa-car fa-lg color-default" aria-hidden="true"></i><span id="label_odometer"></span><span class="info-topBox">Km</span></div>
                            </div>
                            <div class="col-xs-3 no-padding">
                                <div id="modalInfo" class="topBox" onclick="getModalInfo('00000')"><i class="fa fa-info-circle fa-lg color-default" aria-hidden="true"></i><span>Consulta</span><span class="info-topBox">SUTRAN</span></div>
                            </div>
                            <div class="col-xs-3 callBox no-padding">
                                <div id="modalComm" class="topBox" onclick="getDriver('00000');" style="border-color: #428bca"><i class="fa fa-broadcast-tower fa-lg color-default" aria-hidden="true"></i><span class="color-default">Conductor</span><span class="info-topBox">& GPS</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->

    <div class="modal fade sutran-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Informacion SUTRAN</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        SOAT
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body cero-padding">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="modal-info-left">Placa:</td>
                                            <td id="STR_PLACA">AUA720</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Entidad:</td>
                                            <td id="STR_ENTIDADPOLIZA">INTERSEGURO</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Nro de Motor:</td>
                                            <td id="NRO_MOTOR">KMFLA18KPHC103320</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Nº de P&oacute;liza:</td>
                                            <td id="STR_NROPOLIZA">000000000000000005641362</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Fecha de P&oacute;liza:</td>
                                            <td id="DTE_FECHAPOLIZA">05\/10\/2020</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Revisi&oacute;n T&eacute;cnica
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body cero-padding">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="modal-info-left">Entidad:</td>
                                            <td id="STR_ENTIDADCITV">SEGUCAR S.A.C.</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Nº Certificado</td>
                                            <td id="STR_NROCITV">C-2020-197-297-003584</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Fecha Vigencia:</td>
                                            <td id="DTE_FECHACITV">06/02/2021</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">A&ntilde;o de Fabricaci&oacute;n:</td>
                                            <td id="STR_ANIO_FABRICA">2016</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Transmisi&oacute;n GPS
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body cero-padding">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="modal-info-left">Nombre ETT:</td>
                                            <td id="EMV_NOMBRE_ETT">MARTINEZ ZETA ADELA DEL PILAR</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Vigencia:</td>
                                            <td id="EMV_FVIGENCIA">30\/06\/2024</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Estado:</td>
                                            <td id="EMV_ESTADO">HABILITADA</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">EMV:</td>
                                            <td id="EMV_NOMBRE_EMV">CONTROLSAT PERU E.I.R.L</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Situaci&oacute;n:</td>
                                            <td id="EMV_SITUACION">SIN TRANSMISION</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Tipo de Servicio:</td>
                                            <td id="EMV_TIPO_SERVICIO">CNG</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Fecha Transmisi&oacute;n:</td>
                                            <td id="EMV_FECHA_TRANSMISION">22\/06\/2019 19:48:21</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Evento:</td>
                                            <td id="EMV_EVENTO">PARADA</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Velocidad:</td>
                                            <td id="EMV_VELOCIDAD">0 Kph</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Rumbo:</td>
                                            <td id="EMV_RUMBO">0 Norte</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Direcci&oacute;n:</td>
                                            <td id="EMV_DIRECCION">LIMA-LIMA-PUENTE PIEDRA</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Habilitaci&oacute;n Vehicular
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body cero-padding">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="modal-info-left">Fecha de Habilitaci&oacute;n:</td>
                                            <td id="DTE_FECHABILITACION">09/10/201</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Fecha de Vigencia:</td>
                                            <td id="DTE_FECHAVIGENCIA">30/06/2024</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Nº Resoluci&oacute;n:</td>
                                            <td id="STR_NUMRESINSCRIPCION">T-265437-2017</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Fecha de Resoluci&oacute;n:</td>
                                            <td id="DTE_FECRESINSCRIPCION">09/10/2017</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div> -->
            </div>
        </div>
    </div>

    <div id="modal-comm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-comm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Comunicaciones</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-group" id="modal-comm-accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="modal-comm-tab-one">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#modal-comm-accordion" href="#modal-comm-collapse-one" aria-expanded="false" aria-controls="modal-comm-collapse-one">
                                        Conductor
                                    </a>
                                </h4>
                            </div>
                            <div id="modal-comm-collapse-one" class="panel-collapse collapse" role="tabpanel" aria-labelledby="modal-comm-tab-one">
                                <div class="panel-body cero-padding">
                                    <table class="table table-bordered">
                                        <tr class="conductor_info">
                                            <td class="modal-info-left">Nombre:</td>
                                            <td id="conductor_nombre"></td>
                                        </tr>
                                        <tr class="conductor_info">
                                            <td class="modal-info-left">DNI:</td>
                                            <td id="conductor_dni"></td>
                                        </tr>
                                        <tr class="conductor_info">
                                            <td class="modal-info-left">Categor&iacute;a:</td>
                                            <td id="conductor_licencia_tipo"></td>
                                        </tr>
                                        <tr class="conductor_info">
                                            <td class="modal-info-left">Vencimiento:</td>
                                            <td id="conductor_licencia_vencimiento"></td>
                                        </tr>
                                        <tr class="conductor_info">
                                            <td class="modal-info-left">M&oacute;vil:</td>
                                            <td id="conductor_movil"></td>
                                        </tr>
                                        <tr class="conductor_info">
                                            <td colspan="2" style="text-align:center;">
                                                <div class="btn-group" role="group" aria-label="...">
                                                    <a id="conductor-llamar" class="btn btn-primary" href="tel:123" target="_blank"><i class='fa fa-phone-alt' aria-hidden='true'></i> Llamar</a>
                                                    <a id="conductor-whatsapp" class="btn btn-success" href="https://api.whatsapp.com/send?phone=51123&text=Hola" target="_blank"><i class='fa fa-whatsapp' aria-hidden='true'></i> WhatsApp</a>
                                                    <a id="conductor-sms" class="btn btn-warning" href="sms:444?body=hola" target="_blank"><i class='fa fa-comment-dots' aria-hidden='true'></i> SMS</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="conductor_info_alert">
                                            <td colspan="2" style="text-align:center;">
                                                <p class="bg-danger">No hay informaci&oacute;n del conductor, consulte con su operador para activar esta casilla</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="modal-comm-tab-two">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#modal-comm-accordion" href="#modal-comm-collapse-two" aria-expanded="false" aria-controls="modal-comm-collapse-two">
                                        Dispositivo GPS
                                    </a>
                                </h4>
                            </div>
                            <div id="modal-comm-collapse-two" class="panel-collapse collapse" role="tabpanel" aria-labelledby="modal-comm-tab-two">
                                <div class="panel-body cero-padding">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="modal-info-left">Nº Simcard GPS:</td>
                                            <td id="modal-comm-gps-numero">000</td>
                                        </tr>
                                        <tr>
                                            <td class="modal-info-left">Protocolo:</td>
                                            <td id="modal-comm-gps-protocolo">000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align:center;">
                                                <div class="btn-group" role="group" aria-label="...">
                                                    <div id="btn-motor-control" class="btn-group">
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class='fa fa-car' aria-hidden='true'></i> Motor <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a id="modal-comm-gps-off" href="sms:444?body=hola" target="_blank"><i class='fa fa-plug' aria-hidden='true'></i> Desactivar Encendido</a></li>
                                                            <li><a id="modal-comm-gps-on" href="sms:444?body=hola" target="_blank"><i class='fa fa-power-off' aria-hidden='true'></i> Activar Encendido</a></li>
                                                        </ul>
                                                    </div>
                                                    <a id="modal-comm-gps-llamar" class="btn btn-primary" href="tel:123" target="_blank"><i class='fa fa-phone-alt' aria-hidden='true'></i> Llamar</a>
                                                    <a id="modal-comm-gps-sms" class="btn btn-warning" href="sms:444?body=hola" target="_blank"><i class='fa fa-comment-dots' aria-hidden='true'></i> SMS</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align:center;">
                                                <div class="btn-group" role="group" aria-label="...">


                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div> -->
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.3.3/dist/esri-leaflet.js" integrity="sha512-cMQ5e58BDuu1pr9BQ/eGRn6HaR6Olh0ofcHFWe5XesdCITVuSBiBZZbhCijBe5ya238f/zMMRYIMIIg1jxv4sQ==" crossorigin=""></script>

    <script type="text/javascript" src="js/database.js"></script>
    <script type="text/javascript" src="js/global.js"></script>

    <script type="text/javascript">
        var storageKey = "<?php echo $general['llave_sitio']; ?>";
        var bannerLink = "<?php echo $general['enlace_banners']; ?>";
        var googleKey = "<?php echo $general['api_google_maps']; ?>";
        var plataformaLink = "<?php echo $general['enlace_plataforma']; ?>";
        var country_code = "<?php echo $general['country_code']; ?>";

        var leafletMap, searchControl, results, markerGroup;

        var layer;
        var layerLabels;

        document
            .querySelector('#basemaps')
            .addEventListener('change', function(e) {
                var basemap = e.target.value;
                setBasemap(basemap);
            });

        var grupoMarcadores;

        var jsDevices = new Array;
        var directionsDisplay;
        var directionsService = null;
        var map = null;
        var markers = [];
        var trafficLayer = null;
        var handleFleet = null;
        var handleDev = null;
        var linePoints = [];

        var routeEnabled = false;
        var linePath;
        var isLinePathDrawed = false;

        var isRoutePathDrawed = false;
        var waypts = [];

        var isStarted = false;

        var mapHeight;
        var mapWidth;

        var zoomEnabled = true;

        var refreshTimer = 30;

        function setBasemap(bmap) {
            if (layer) {
                leafletMap.removeLayer(layer);
            }

            layer = L.esri.basemapLayer(bmap);

            leafletMap.addLayer(layer);

            if (layerLabels) {
                leafletMap.removeLayer(layerLabels);
            }

            if (bmap === 'ShadedRelief' || bmap === 'Oceans' || bmap === 'Gray' || bmap === 'DarkGray' || bmap === 'Terrain') {
                layerLabels = L.esri.basemapLayer(bmap + 'Labels');
                leafletMap.addLayer(layerLabels);
            } else if (bmap.includes('Imagery')) {
                layerLabels = L.esri.basemapLayer('ImageryLabels');
                leafletMap.addLayer(layerLabels);
            }
        }

        function openNav() {
            document.getElementById("mySidenav").style.width = "280px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        function getHeadingPushpin(heading, speed) {
            var pushpin = 'images/pp_stop.png';

            if (speed > 0) {
                if (heading >= 338 && heading <= 360) {
                    pushpin = 'images/pp_n.png';
                } else if (heading >= 0 && heading < 24) {
                    pushpin = 'images/pp_n.png';
                } else if (heading >= 24 && heading < 68) {
                    pushpin = 'images/pp_ne.png';
                } else if (heading >= 68 && heading < 113) {
                    pushpin = 'images/pp_e.png';
                } else if (heading >= 113 && heading < 158) {
                    pushpin = 'images/pp_se.png';
                } else if (heading >= 158 && heading < 203) {
                    pushpin = 'images/pp_s.png';
                } else if (heading >= 203 && heading < 248) {
                    pushpin = 'images/pp_so.png';
                } else if (heading >= 248 && heading < 293) {
                    pushpin = 'images/pp_o.png';
                } else if (heading >= 293 && heading < 338) {
                    pushpin = 'images/pp_no.png';
                }
            }

            return pushpin
        };

        function clearMarkerLayer() {
            leafletMap.removeLayer(markerGroup);
            markerGroup = L.layerGroup().addTo(leafletMap);
            grupoMarcadores = new L.featureGroup();
        }

        function createMarkerLayer() {
            grupoMarcadores = new L.featureGroup();
            markerGroup = L.layerGroup().addTo(leafletMap);
        }

        function getStatusClass(statusCode) {
            var response_status_color = "default";

            switch (statusCode) {
                case 61715: // Detenido
                    response_status_color = "stop";
                    break;
                case 61714: // Movimiento
                    response_status_color = "motion";
                    break;
                case 64787: // Falla de Energia
                    response_status_color = "power-alert";
                    break;
                case 61722: // Exceso de Veloicdad
                    response_status_color = "speeding";
                    break;
                case 62476: // Motor Encendido
                    response_status_color = "engine-on";
                    break;
                case 62477: // Motor Apagado
                    response_status_color = "engine-off";
                    break;
                case 63553: // Emergencia
                    response_status_color = "panic-on";
                    break;
                case 62467: // Motor Apagado
                    response_status_color = "engine-off";
                    break;
            }

            return response_status_color;
        }

        function getStatusText(statusCode) {
            var response_status_text = statusCode;

            switch (statusCode) {
                case 61715:
                    response_status_text = "Detenido";
                    break;
                case 61714:
                    response_status_text = "En movimiento";
                    break;
                case 64787:
                    response_status_text = "Falla Energía";
                    break;
                case 61722:
                    response_status_text = "Exc. Velocidad";
                    break;
                case 62476:
                    response_status_text = "Motor Encendido";
                    break;
                case 62477:
                    response_status_text = "Motor Apagado";
                    break;
                case 63553:
                    response_status_text = "Emergencia";
                    break;
                case 62467:
                    response_status_text = "Motor Apagado";
                    break;
            }

            return response_status_text;
        }

        function placeMarkerLF(lat, lon, licPlat, desc, simPhNmb, GpsTime, head, spd, streetAddress, secondsDiff,
            odoKM, dName, statusCode, address, geozoneID, devID, driverID, deviceCode) {

            odoKM = odoKM.toFixed(0);

            var urlIcon = getHeadingPushpin(head, spd);

            var greenIcon = L.icon({
                iconUrl: urlIcon,
                iconSize: [40, 40], // size of the icon
                iconAnchor: [22, 35], // point of the icon which will correspond to marker's location
                popupAnchor: [0, -24], // point from which the popup should open relative to the iconAnchor
                className: "pushpin-" + devID,
            });

            var latlng = L.latLng(lat, lon);

            var tooltip_class = "leaflet-tooltip-error";
            var plate_bg_class = "bg-color-default";
            var status_text = "Sin transmisi&oacute;n";
            var popup_plate_class = "default";

            if (secondsDiff <= 18000) {
                status_text = getStatusText(statusCode);
                popup_plate_class = getStatusClass(statusCode);
                if (spd > 90) {
                    tooltip_class = "leaflet-tooltip-speed";
                    plate_bg_class = "bg-color-default";
                } else if (spd > 3) {
                    tooltip_class = "leaflet-tooltip-move";
                    plate_bg_class = "bg-color-success";
                } else if (spd < 3) {
                    tooltip_class = "leaflet-tooltip-stop";
                    plate_bg_class = "bg-color-error";
                } else {
                    // Do Nothing
                }
            }

            var bind_popup = "<div class='pop_buble'>";
            bind_popup += "<div class='pop_buble_row_one'>";
            bind_popup += "<span class='pop_buble_plate'>" + licPlat + "</span>";
            if (dName != "") {
                bind_popup += "<span class='pop_buble_display_name'>" + dName + "</span>"
            }
            bind_popup += "</div>";

            bind_popup += "<div class='pop_buble_row_twp bg-status-color-" + popup_plate_class + "'>";
            bind_popup += "<span class='pop_buble_speed'>" + status_text + " " + ((spd > 2) ? spd + "Kph" : "") + "</span>";
            bind_popup += "</div>"; // Fin row two

            bind_popup += "<div class='pop_buble_row_three'>";
            bind_popup += "<span class='pop_buble_dateTime'>" + GpsTime + "</span>";
            bind_popup += "</div>"; // Fin row four

            bind_popup += "<div class='pop_buble_row_four'>";
            bind_popup += "<span class='pop_buble_address'>";

            if (geozoneID == "") {
                bind_popup += streetAddress;
            } else {
                bind_popup += address;
                bind_popup += " <span class='badge bg-color-success''>" + geozoneID + "</span>";
            }

            bind_popup += "</span>";

            bind_popup += "</div>"; // Fin row four
            bind_popup += "</div>";

            bind_popup += "<div class='pop_buble_row_five'>";
            bind_popup += "<span class='pop_buble_location'>";
            // bind_popup += "<a target='_blank' class='btn btn-link' href='http://waze.to/?ll=" + (latlng.lat).toFixed(6) + "," + (latlng.lng).toFixed(6) + "&amp;navigate=yes'>Ir con Waze</a>";
            bind_popup += (latlng.lat).toFixed(6) + "," + (latlng.lng).toFixed(6);
            bind_popup += "</span>";
            bind_popup += "</div>"; // Fin row four
            bind_popup += "</div>";

            var iconmarker = L.marker(latlng, {
                    icon: greenIcon
                }).bindTooltip(licPlat, {
                    permanent: true,
                    direction: 'bottom',
                    className: tooltip_class
                }).bindPopup(bind_popup)
                .addTo(markerGroup).on('click', function(e) {
                    $(".overlay-info").hide();
                    var date_and_time = GpsTime.split(" ");

                    $(".plate").html(licPlat);
                    $('.plate').removeClass('bg-color-error').removeClass('bg-color-default').removeClass('bg-color-success').addClass(plate_bg_class);
                    $("#label_speed").html(spd);
                    // if (geozoneID == "") {
                    //     $(".topAddress").html(streetAddress);
                    // } else {
                    //     $(".topAddress").html(address + " [" + geozoneID + "]");
                    // }
                    $("#description_text").html(desc);
                    $("#label_odometer").html(odoKM);
                    $("#timeBox").html(date_and_time[0]);
                    $("#dateBox").html(date_and_time[1]);
                    $("#label_displayName").html(dName);
                    $("#wazeLink").html("<a target='_blank' class='' href='http://waze.to/?ll=" + (latlng.lat).toFixed(6) + "," + (latlng.lng).toFixed(6) + "&amp;navigate=yes'>Ir con Waze</a>");
                    $("#modalInfo").attr("onclick", "getModalInfo('" + licPlat + "')");
                    $("#modalComm").attr("onclick", "getDriver('" + driverID + "','" + deviceCode + "')");

                    $("#modal-comm-gps-numero").html(simPhNmb);
                    $("#modal-comm-gps-protocolo").html(deviceCode);

                    $("#modal-comm-gps-llamar").attr("href", "tel:+" + country_code + "" + simPhNmb);
                    $("#modal-comm-gps-sms").attr("href", "sms:+" + country_code + "" + simPhNmb + "?body=...");

                    var powerCmd = getPowerCommand(deviceCode, 1);
                    if (powerCmd == "no") {
                        $("#btn-motor-control").hide();
                    } else {
                        $("#btn-motor-control").show();
                        $("#modal-comm-gps-off").attr("href", "sms:+" + country_code + "" + simPhNmb + "?body=" + getPowerCommand(deviceCode, 0) + "");
                        $("#modal-comm-gps-on").attr("href", "sms:+" + country_code + "" + simPhNmb + "?body=" + getPowerCommand(deviceCode, 1) + "");
                    }
                });

            grupoMarcadores.addLayer(iconmarker);

        }

        function getPowerCommand(deviceCode, command) {
            console.log("devCode: " + deviceCode + " command:" + command);
            var response = "";

            switch (deviceCode) {
                case "gps103b": // Detenido
                    response = command ? "resume123456" : "stop123456";
                    break;
                case "gt06": // Movimiento
                    response = command ? "RELE,0" : "RELE,1";
                    break;
                default:
                    response = "no";
                    break;
            }

            return response;

        }

        function placeMarker(lat, lon, licPlat, desc, simPhNmbr, GpsTime, head, spd) {
            var location = new google.maps.LatLng(lat, lon);
            var pushpin = getHeadingPushpin(head, spd);

            var newMarker = {
                url: pushpin,
                scaledSize: new google.maps.Size(48, 48),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0),
                labelOrigin: new google.maps.Point(24, 52),
            }

            var markerLabel = licPlat;
            var marker = new google.maps.Marker({
                position: location,
                center: location,
                map: map,
                clickable: true,
                icon: newMarker,
                label: {
                    text: markerLabel,
                    color: "#003366",
                    fontSize: "12px",
                    fontWeight: "bold"
                }
            });

            marker.info = new google.maps.InfoWindow({
                content: '<div class="deviceTitle"><b>[' + licPlat + ']</b>&nbsp;' +
                    '<span><b>' + desc + '</b></span><br soft/>' +
                    '<span><b>Última transmisión:&nbsp</b>' + GpsTime + '</span><br soft/>' +
                    '<span><b>Velocidad:&nbsp</b>' + spd + 'KPH&nbsp;&nbsp;<span><b>Simcard:&nbsp</b>' + simPhNmbr + '</span><br>' +
                    '<span><a target="_blank" class="btn btn-success" href="http://waze.to/?ll=' + lat + ',' + lon + '&amp;navigate=yes">Ir con Waze</a></span>' + '</div>'

            });

            markers.push(marker);
            //marker.info.open(map,marker);
            google.maps.event.addListener(marker, 'click', function() {
                closeAllInfowindows();
                marker.info.open(map, marker);
            });
        };

        function drawRoute(dev, lat, lon, GpsTime, head, spd) {
            var location = new google.maps.LatLng(lat, lon);
            var pushpin = getHeadingPushpin(head, spd);

            //logg("function(drawRoute): Geopoint: "+ location + " Heading/Speed: " + head + "/" + spd);

            var marker = new google.maps.Marker({
                position: location,
                center: location,
                map: map,
                clickable: true,
                icon: pushpin
            });

            var statusText = "Detenido";
            if (spd > 0) {
                statusText = "En Movimiento"
            }

            marker.info = new google.maps.InfoWindow({
                content: '<div class="deviceTitle">' +
                    '<span>[' + dev + ']&nbsp;' + GpsTime + '</span><br soft/>' +
                    '<span>' + statusText + '&nbsp;&nbsp;' + spd + 'kph</div>'
            });

            markers.push(marker);
            //marker.info.open(map,marker);
            google.maps.event.addListener(marker, 'click', function() {
                closeAllInfowindows();
                marker.info.open(map, marker);
            });

        };

        function mapToDev(lat, lon, devID) {
            leafletMap.setView([lat, lon], 17);
            closeNav();
            var ppID = ".pushpin-" + devID;
            console.log(ppID);
            $(ppID).trigger("click");
        }

        function closeAllInfowindows() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].info.close();
            }
        };

        function logg(msj) {
            var d = new Date();
            var thisTime = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
            console.log(thisTime + "  -> " + msj);
        };

        function loading(OnOff) {
            // var $this = $(this),
            //     theme = $this.jqmData("theme") || $.mobile.loader.prototype.options.theme,
            //     msgText = $this.jqmData("msgtext") || $.mobile.loader.prototype.options.text,
            //     textVisible = $this.jqmData("textvisible") || $.mobile.loader.prototype.options.textVisible,
            //     textonly = !!$this.jqmData("textonly");
            // html = $this.jqmData("html") || "";

            if (OnOff == true) {
                $(".spinner").show();
            } else {
                $(".spinner").hide();
            }

        };

        function clear_info_modal() {
            $("#STR_PLACA").html("Espere...");
            $("#NRO_MOTOR").html("Espere...");
            $("#STR_NROPOLIZA").html("Espere...");
            $("#STR_ENTIDADPOLIZA").html("Espere...");
            $("#DTE_FECHAPOLIZA").html("Espere...");
            $("#STR_ENTIDADCITV").html("Espere...");
            $("#STR_NROCITV").html("Espere...");
            $("#DTE_FECHACITV").html("Espere...");
            $("#STR_ANIO_FABRICA").html("Espere...");
            $("#EMV_CODIGOV").html("Espere...");
            $("#EMV_NOMBRE_ETT").html("Espere...");
            $("#EMV_FVIGENCIA").html("Espere...");
            $("#EMV_ESTADO").html("Espere...");
            $("#EMV_NOMBRE_EMV").html("Espere...");
            $("#EMV_FECHA").html("Espere...");
            $("#EMV_FECHA_TRANSMISION").html("Espere...");
            $("#EMV_SITUACION").html("Espere...");
            $("#EMV_EVENTO").html("Espere...");
            $("#EMV_LATITUD").html("Espere...");
            $("#EMV_LONGITUD").html("Espere...");
            $("#EMV_VELOCIDAD").html("Espere...");
            $("#EMV_RUMBO").html("Espere...");
            $("#EMV_TIPO_SERVICIO").html("Espere...");
            $("#EMV_DIRECCION").html("Espere...");
            $("#DTE_FECHABILITACION").html("Espere...");
            $("#DTE_FECHAVIGENCIA").html("Espere...");
            $("#DTE_FECRESINSCRIPCION").html("Espere...");
            $("#STR_NUMRESINSCRIPCION").html("Espere...");
        }

        function cargaFlota() {
            getFleetDevices(storageData.accountID, storageData.groupID);
        };

        // function adjustMapSize() {
        //     mapHeight = $("html").height();
        //     $("#map").css("height", mapHeight - 42);
        //     mapWidth = $("html").width() - 300;

        //     $(".devScrl").css({
        //         "height": mapHeight
        //     });
        // }

        $(document).ready(function() {

            // $(".overlay-info").hide();
            loading(false);

            /* Ajustar la altura del mapa*/
            var thisH = $(window).height();

            $(window).resize(function() {
                thisH = this.window.innerHeight;
                console.log("Size: " + thisH);
                $('#mapid').css({
                    "height": ((thisH - 170))
                });
                $('.sidenav').css({
                    "height": ((thisH - 120))
                });
            });

            $('#mapid').css({
                "height": ((thisH - 170))
            });

            $('.sidenav').css({
                "height": ((thisH - 120))
            })
            /* ---------------------------- */

            /* Rutina para verificar que el usuario exista en el teléfono */
            storageData = JSON.parse(localStorage.getItem(storageKey));

            if (storageData === null) {
                window.setTimeout(function() {
                    location.href = "index.php";
                }, 0);
            }

            // var imgLogo = "images/logo.png";
            // $("#logoImage").attr("src", imgLogo);

            console.log("Variables de sesion: " + storageData.accountID + "/" + storageData.userID + "/" + storageData.password + " " + storageData.description + "/" + storageData.groupID);

            // $(".popphoto").attr("src", bannerLink + "/" + storageData.accountID + ".jpg");

            // $("#welcomeNavbar").html(storageData.description);
            // $("#welcomeNavbar").html("<?php echo $general['titulo_web']; ?>");

            // $("#deviceList ul").click(function() {
            //     $("#list-panel").panel("close");
            // });

            // $("#menuList ul").click(function() {
            //     $("#nav-panel").panel("close");
            // });

            // $("#flipRoute").change(function() {
            //     var flipSts2 = $("#flipRoute").val();
            //     if (flipSts2 == "on") {
            //         routeEnabled = true;
            //         logg(routeEnabled);
            //     } else if (flipSts2 == "off") {
            //         routeEnabled = false;
            //         logg(routeEnabled);
            //     }
            // });

            // $("#flipZoom").change(function() {
            //     var flipSts3 = $("#flipZoom").val();
            //     if (flipSts3 == "on") {
            //         zoomEnabled = true;

            //     } else if (flipSts3 == "off") {
            //         zoomEnabled = false;

            //     }
            // });

            $('#flipZoom').on('click', function() {
                if ($(this).is(':checked')) {
                    // Hacer algo si el checkbox ha sido seleccionado
                    // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
                    zoomEnabled = true;
                } else {
                    // Hacer algo si el checkbox ha sido deseleccionado
                    // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
                    zoomEnabled = false;
                }
            });

            $("#devMap").click(function() {
                clearInterval(handleFleet);
                // Detenemos el timer de flotas 
                // [ handleFleet = setInterval("cargaFlota();", refreshTimer * 1000); ]
                handleFleet = 0; // Lo reseteamos a 0 por si las dudas
                logg("Mapa de flota cancelado");
                deleteMarkers();
                if (isLinePathDrawed) {
                    linePath.setMap(null);
                }
                getDeviceList(storageData.accountID, storageData.groupID);
                startDeviceTrack(jsDevices[0]);

            });

            $("#fltMap").click(function() {
                clearInterval(handleDev);
                handleDev = 0;
                //isStarted = false;
                if (isLinePathDrawed) {
                    linePath.setMap(null);
                }
                cargaFlota();
                handleFleet = setInterval("getFleetDevices(storageData.accountID,storageData.groupID)", 50000);
                logg("Mapa de flota reiniciado");
            });

            $("#CloseSession").click(function(e) {
                e.preventDefault();

                localStorage.removeItem(storageKey);
                location.reload();

            });

            $("#platformLink").click(function(e) {
                e.preventDefault();

                var url = plataformaLink + "account=" + storageData.accountID + "&user=" + storageData.userID + "&password=" + storageData.password;

                window.open(url, '_blank');
            });

            // Instanciar mapa 'leafletMap'
            leafletMap = L.map('mapid', {
                center: [-12.006571, -77.057929],
                zoom: 7,
            });

            layer = L.esri.basemapLayer('Physical').addTo(leafletMap);
            leafletMap.zoomControl.setPosition('bottomleft');

            // Agregar escala al mapa y ocultarlo
            L.control.scale().addTo(leafletMap);
            $('.leaflet-control-scale').hide();

            // Agregar Copyright y ocultarlo
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap);
            $('.leaflet-control-attribution').hide();

            // Instanciar capa de marcadores
            createMarkerLayer();

            // Cargar mapa de flota por defecto
            cargaFlota();

            // Instanciar rastreo automático
            handleFleet = setInterval("cargaFlota();", refreshTimer * 1000);

            // Activar tootltips de Bootstrap
            $('[data-toggle="tooltip"]').tooltip();

            $("#list_search_input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#deviceList li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        });

        function getDriver(driverID, deviceCode) {
            $.ajax({
                type: "GET",
                url: "system/getDriver.php",
                data: {
                    accountID: storageData.accountID,
                    driverID: driverID,
                },
                beforeSend: function(xhr) {
                    loading(true);
                    $("#modal-comm").modal("show");
                    $(".conductor_info_alert").hide();
                    $("#conductor_nombre").html("");
                    $("#conductor_dni").html("");
                    $("#conductor_licencia_tipo").html("");
                    $("#conductor_licencia_vencimiento").html("");
                    $("#conductor_movil").html("");
                },
                timeout: 20000,
                error: function(x, t, m) {
                    if (t === "timeout") {
                        alert("Error: Se sobrepasó el tiempo de espera");
                    } else {
                        console.log(t);
                    }
                    loading(false);
                },
                success: function(datos) {
                    loading(false);

                    var ajaxData = $.parseJSON(datos);

                    var contactName = ajaxData[0].description;

                    if (contactName == "-") {
                        $(".conductor_info_alert").show();
                        $(".conductor_info").hide();
                    } else {
                        $(".conductor_info_alert").hide();
                        $(".conductor_info").show();

                        var phoneNumber = ajaxData[0].contactPhone;
                        var vencimiento = from_unixtime(dayNumberToUnixtime(ajaxData[0].licenseExpire), 1);

                        $("#conductor_nombre").html(contactName);
                        $("#conductor_dni").html(driverID);
                        $("#conductor_licencia_tipo").html(ajaxData[0].licenseType);
                        $("#conductor_licencia_vencimiento").html(vencimiento);
                        $("#conductor_movil").html(phoneNumber);

                        $("#conductor-llamar").attr("href", "tel:+" + country_code + "" + phoneNumber);
                        $("#conductor-whatsapp").attr("href", "https://api.whatsapp.com/send?phone=" + country_code + "" + phoneNumber + "&text=Hola");
                        $("#conductor-sms").attr("href", "sms:+" + country_code + "" + phoneNumber + "?body=Hola");
                    }

                },
            });
        }

        function getFleetDevices(accID, fleetID) {
            logg("function: getFleetDevices(" + accID + "," + fleetID + ")");
            $.ajax({
                url: "system/getFleetDevices.php",
                data: {
                    accID: accID,
                    fleetID: fleetID
                },
                beforeSend: function(xhr) {
                    loading(true);
                },
                timeout: 30000,
                error: function(x, t, m) {
                    if (t === "timeout") {
                        logg("Error: Se sobrepasó el tiempo de espera");
                    } else {
                        logg(t);
                    }
                    loading(false);
                },
                success: function(datos) {
                    var ajaxData = $.parseJSON(datos);

                    clearMarkerLayer();

                    var htmlList = '';
                    var counter = 0;

                    var totalInMotion = 0;
                    var totalStop = 0;
                    var totalDisconnect = 0;

                    /** Declarando y limpiando variables **/
                    var deviceID = new Array;
                    var uniqueID = new Array;
                    var description = new Array;
                    var licensePlate = new Array;
                    var simPhoneNumber = new Array;
                    var timestamp = new Array;
                    var statusCode = new Array;
                    var latitude = new Array;
                    var longitude = new Array;
                    var speedKPH = new Array;
                    var heading = new Array;
                    var streetAddress = new Array;
                    var city = new Array;
                    var odometerKM = new Array;
                    var displayName = new Array;
                    var address = new Array;
                    var geozoneID = new Array;
                    var driverID = new Array;
                    var deviceCode = new Array;

                    var secondsDiff = new Array;

                    htmlList += "<ul class='list-group'>";
                    htmlList += "";

                    /** Llenando variables con la consulta SQL **/
                    $.each(ajaxData, function(index, value) {
                        counter++;
                        jsDevices[index] = ajaxData[index].deviceID;
                        deviceID[index] = ajaxData[index].deviceID;
                        uniqueID[index] = ajaxData[index].uniqueID;
                        description[index] = ajaxData[index].description;
                        licensePlate[index] = ajaxData[index].licensePlate;
                        simPhoneNumber[index] = ajaxData[index].simPhoneNumber;
                        timestamp[index] = ajaxData[index].timestamp;
                        statusCode[index] = parseInt(ajaxData[index].statusCode);
                        latitude[index] = ajaxData[index].latitude;
                        longitude[index] = ajaxData[index].longitude;
                        speedKPH[index] = parseFloat(ajaxData[index].speedKPH).toFixed(2);
                        heading[index] = ajaxData[index].heading;
                        streetAddress[index] = ajaxData[index].streetAddress;
                        city[index] = ajaxData[index].city;
                        odometerKM[index] = parseFloat(ajaxData[index].odometerKM);
                        displayName[index] = ajaxData[index].displayName;
                        address[index] = ajaxData[index].address;
                        geozoneID[index] = ajaxData[index].geozoneID;
                        driverID[index] = ajaxData[index].driverID;
                        deviceCode[index] = ajaxData[index].deviceCode;

                        var actualEpoch = (new Date().getTime()) / 1000;
                        var secondsOff = actualEpoch - timestamp[index];

                        secondsDiff[index] = secondsOff;

                        var alert_icon = "";
                        var statusText = "";
                        var speed_label_color = "default";
                        var tachometer_icon = "<i class='fa fa-tachometer font-status-color-default' aria-hidden='true'></i>";
                        var timestamp_text = from_unixtime(timestamp[index], 0);

                        if (simPhoneNumber[index] === "") {
                            simPhoneNumber[index] = "999";
                        }

                        if (secondsOff > 18000) {
                            totalDisconnect++;
                            alert_icon = "<i class='fa fa-exclamation-triangle blinking' aria-hidden='true'></i>";
                            statusText = "Sin transmisi&oacute;n";
                        } else {
                            totalInMotion = (speedKPH[index] > 2) ? totalInMotion + 1 : totalInMotion;
                            statusText = getStatusText(statusCode[index]);
                            speed_label_color = getStatusClass(statusCode[index]);
                        }

                        var mapClick = "onclick='mapToDev(" + latitude[index] + "," + longitude[index] + ",\"" + deviceID[index] + "\");return false;'";

                        var car_icon_url = getHeadingPushpin(heading[index], speedKPH[index]);
                        var car_icon = "<img class='d-block m-0-auto' src='" + car_icon_url + "'>";

                        var car_plate_html = "<span class='label bg-status-color-" + speed_label_color + " text-14 d-block'>" + licensePlate[index] + "</span>";
                        var car_display_html = "<span class='text-12 d-block text-truncate'>" +
                            displayName[index] + "</span>";

                        htmlList += "<li " + mapClick + "class='list-group-item'>";
                        htmlList += "   <div class='row'>";
                        htmlList += "       <div class='col-xs-12 text-left'>";
                        htmlList += "           <span class='text-12 d-block listAddress'>";
                        htmlList += (geozoneID[index] == "") ? (streetAddress[index] + ", " + city[index]) : address[index];
                        htmlList += "           </span>";
                        htmlList += "       </div>";
                        htmlList += "   </div>";

                        htmlList += "   <div class='row'>";
                        htmlList += "       <div class='col-xs-5 text-center'>";

                        htmlList += car_icon;
                        if (secondsOff > 18000) {
                            htmlList += "           <div class='d-block'>" + alert_icon + " No Tx</div>";
                        } else {
                            htmlList += "           <div class='d-block '>" + tachometer_icon + "<span class='font-status-color-default'>&nbsp;" + parseFloat(speedKPH[index]).toFixed(0) + "&nbsp;Kph</span></div>";
                        }

                        htmlList += "       </div>";
                        htmlList += "       <div class='col-xs-7 text-center'>";
                        htmlList += car_plate_html;
                        htmlList += "           <span class='font-status-color-" + speed_label_color + " text-14 d-block font-weight-bold'>" + statusText + "</span>";
                        htmlList += "           <span class='text-12 d-block font-weight-bold font-status-color-default'>" + timestamp_text + "</span>";
                        htmlList += "       </div>";
                        htmlList += "   </div>";
                        htmlList += "</li>";

                    });

                    htmlList += "</ul>";


                    for (var i = 0; i < counter; i++) {
                        var timestamp_text = from_unixtime(timestamp[i], 0);
                        var street = streetAddress[i] + ", " + city[i];

                        placeMarkerLF(latitude[i], longitude[i], licensePlate[i], description[i], simPhoneNumber[i], timestamp_text, heading[i],
                            speedKPH[i], street, secondsDiff[i], odometerKM[i], displayName[i], statusCode[i], address[i], geozoneID[i],
                            deviceID[i], driverID[i], deviceCode[i]);
                    }

                    $('#deviceList').html("");
                    $("#deviceList").append(htmlList);

                    totalStop = counter - totalInMotion - totalDisconnect;

                    $('#totalDevices').html(counter);
                    $('#totalDisconnect').html(totalDisconnect);
                    $('#totalInMotion').html(totalInMotion);
                    $('#totalStop').html(totalStop);

                    if (zoomEnabled === true) {
                        leafletMap.fitBounds(grupoMarcadores.getBounds());
                        // leafletMap.setZoom(leafletMap.getZoom() - 1);
                    } else {
                        //mapToDev(latitude[0],longitude[0]);		
                    }

                    // if (!isStarted){
                    // 	isStarted = true;
                    // 	map.fitBounds(bounds);
                    // }

                    loading(false);

                }
            });
        }
    </script>

</body>

</html>