<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no, user-scalable=no"/>
    <title>GPS Mobile Version</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="jqm/jquery.mobile-1.4.2.min.css" />
    <link rel="stylesheet" href="css/general.css" /> 
    
</head>	

<body>

    <div data-role="page">
        <div data-role="header" style="overflow:hidden;">
            <div id="welcomeNavbar"></div>
            <a href="#nav-panel" data-icon="bars" data-iconpos="notext"></a><!--Menu-->
            <a href="#list-panel" data-icon="bullets" data-iconpos="notext" ></a><!--DeviceList-->
        </div><!-- /header -->

        <div data-role="main">
            <div class="googleMap">
                <div id="map"></div>
            </div><!-- googleMap-->

        </div><!-- main -->

        <div data-role="panel" data-position="left" data-position-fixed="true" data-display="overlay" data-theme="a" id="nav-panel" class="noPadding2">
            <div class="devScrl">
                <div id="menuList">
                    <img id="logoImage" style="padding:10px" src=""/>
                    <ul data-role='listview' data-theme"b" data-filter="false">
                        <li data-role="list-divider">Total de Vehículos: <span id="totalDevices" class="ui-li-count blueBg">0</span></li>
                        <li data-role="list-divider">En movimiento: <span id="totalInMotion" class="ui-li-count greenBg">0</span></li>
                        <li data-role="list-divider">Detenidos: <span id="totalStop" class="ui-li-count redBg">0</span></li>
                        <li data-role="list-divider">Sin conexión: <span id="totalDisconnect" class="ui-li-count grayBg">0</span></li>
                        <li data-role="list-divider">
                            <table width="100%">
                                <tr>
                                    <td align="left">
                                        <span>Ver Trafico</span>
                                    </td>
                                    <td align="right">
                                        <select id="flipTraffic" data-role="flipswitch" data-mini="true">
                                            <option value="off">Off</option>
                                            <option value="on">On</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">
                                        <span>Mostrar como Ruta</span>
                                    </td>
                                    <td align="right">
                                        <select id="flipRoute" data-role="flipswitch" data-mini="true">
                                            <option value="off">Off</option>
                                            <option value="on">On</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">
                                        <span>Auto Zoom</span>
                                    </td>
                                    <td align="right">
                                        <select id="flipZoom" data-role="flipswitch" data-mini="true">
                                            <option value="off">Off</option>
                                            <option value="on">On</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <li id="devMap" data-icon='grid'><a class='txtClientName' href='#'>Mapa Unidad</a></li>
                        <li id="fltMap" data-icon='location'><a class='txtClientName' href='#'>Mapa Flota</a></li>
                        <li data-role="list-divider"></li>
                        <li data-icon='comment'>
                            <a class='btn btn-danger' target="_blank" href="https://wa.me/51951983781?text=Hola,%20quiero%20hacerle%20una%20consulta">Contáctenos</a>
                        </li>
                        <li>
                             <a id="platformLink" class='btn btn-danger' target="_blank" href="#">Versión PC</a>
                        </li>
                        <li data-role="list-divider"></li>
                        <li data-icon='delete'><a id="CloseSession" class='txtClientName' href='#'>Salir</a></li>

                        <a id="banner" href="#popupBanner" data-rel="popup" data-position-to="window" data-transition="fade" style="display:none;">link</a>

                        <div data-role="popup" id="popupBanner" data-overlay-theme="b" data-theme="b" data-corners="false">
                            <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                            <img class="popphoto" src="images/banner.png" style="max-height:600px;" alt="Publicidad">
                        </div>

                    </ul>
                </div>
            </div>
        </div><!-- /panel -->

        <div data-role="panel" data-position="right" data-position-fixed="true" data-display="overlay" data-theme="a" id="list-panel" class="noPadding">
            <div class="devScrl">
                <div class="deviceTitleList">Unidades</div>
                <div id="deviceList" class="ui-body-d ui-content" style="padding: 0.5em !important;">
                    <ul data-role='listview' data-filter="true" data-filter-placeholder="Buscar..."></ul>
                </div>
            </div>
        </div><!-- /panel Device List-->


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </div><!-- /page -->

    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="jqm/jquery.mobile-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/database.js"></script>
    <script type="text/javascript" src="js/global.js"></script>

    <script type="text/javascript">
    var jsAccountID = "";
    var jsUserID    = "";
    var jsPassword  = "";
    var jsUsrDesc   = "";
    var jsGroupID   = "";
    var jsDevices   = new Array;
    var smsEnabled  = false;

    var directionsDisplay;
    var directionsService = null;
    var map             = null;
    var markers         = [];
    var trafficLayer    = null;
    var handleFleet     = null;
    var handleDev       = null;
    var linePoints      = [];

    var routeEnabled    = false;
    var linePath;
    var isLinePathDrawed= false;

    var isRoutePathDrawed=false;
    var waypts          = [];

    var isStarted       = false;
    
    var mapHeight;
    var mapWidth;

    var bounds          = null;
    var zoomEnabled     = false;

    var refreshTimer    = 30;

    var sms     = {
        user:   "email@gmail.com",
        pass:   "pass",
        device: "devid" 
    }

    function loadScript() {
        logg("cargando GoogleMaps...");
        var script      = document.createElement('script');
        var apiURL      = 'http://maps.google.com/maps/api/js?v=3';
        var opts        = '&libraries=places&oe=utf-8&hl=es';
        script.type     = 'text/javascript';
        script.src      = apiURL + opts + '&key='+googleKey + '&callback=initializeMap'; 
        // Inicializar el Mapa al terminar la carga del API de Google.
        document.body.appendChild(script);
    }


    function initializeMap() {
        
        geocoder = new google.maps.Geocoder();

        var mapOptions = {
            zoom: 13,
            center: new google.maps.LatLng(-12.00000,-77.060198),
            disableDefaultUI: false,
            panControl: false,
            rotateControl: true,
            zoomControl: true,
            scaleControl: true
        };

        map = new google.maps.Map($("#map").get(0), mapOptions);

        trafficLayer = new google.maps.TrafficLayer();

        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsService = new google.maps.DirectionsService();

        directionsDisplay.setMap(map);

        reloadFleet();
        
        handleFleet = setInterval("reloadFleet();", refreshTimer * 1000);

    };

    function getHeadingPushpin(heading, speed){
        var pushpin = 'images/pp_stop.png';

        if (speed > 0){
            if (heading >= 338 && heading <=360){
                pushpin = 'images/pp_n.png';
            } else if (heading >= 0 && heading <24){
                pushpin = 'images/pp_n.png';
            } else if (heading>= 24 && heading <68){
                pushpin = 'images/pp_ne.png';
            } else if (heading>= 68 && heading <113){
                pushpin = 'images/pp_e.png';
            } else if (heading>= 113 && heading <158){
                pushpin = 'images/pp_se.png';
            } else if (heading>= 158 && heading <203){
                pushpin = 'images/pp_s.png';
            } else if (heading>= 203 && heading <248){
                pushpin = 'images/pp_so.png';
            } else if (heading>= 248 && heading <293){
                pushpin = 'images/pp_o.png';
            } else if (heading>= 293 && heading <338){
                pushpin = 'images/pp_no.png';
            }
        }

        return pushpin
    };

    function placeMarker(lat,lon,licPlat,desc,simPhNmbr,GpsTime,head,spd){
        var location = new google.maps.LatLng(lat,lon);
        var pushpin = getHeadingPushpin(head,spd);

        var newMarker   = {
            url:    pushpin,
            scaledSize: new google.maps.Size(48, 48),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(32,65),
            labelOrigin:  new google.maps.Point(24,48),
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
            content: '<div class="deviceTitle"><b>['+licPlat+']</b>&nbsp;'+
            '<span><b>'+desc+'</b></span><br soft/>'+
            '<span><b>Última transmisión:&nbsp</b>'+ GpsTime +'</span><br soft/>'+
            '<span><b>Velocidad:&nbsp</b>'+ spd +'KPH&nbsp;&nbsp;<span><b>Simcard:&nbsp</b>'+ simPhNmbr +'</span><br>'+
            '<span><a target="_blank" class="btn btn-success" href="http://waze.to/?ll='+lat+','+lon+'&amp;navigate=yes">Ir con Waze</a></span>'+'</div>'

        });

        markers.push(marker);
        //marker.info.open(map,marker);
        google.maps.event.addListener(marker, 'click', function() {
            closeAllInfowindows();
            marker.info.open(map, marker);
        });
    };

    function drawRoute(dev,lat,lon,GpsTime,head,spd){
        var location = new google.maps.LatLng(lat,lon);
        var pushpin = getHeadingPushpin(head,spd);

        //logg("function(drawRoute): Geopoint: "+ location + " Heading/Speed: " + head + "/" + spd);

        var marker = new google.maps.Marker({
            position: location,
            center: location,
            map: map,
            clickable: true,
            icon: pushpin
        });

        var statusText = "Detenido";
        if (spd > 0){
            statusText = "En Movimiento"
        }

        marker.info = new google.maps.InfoWindow({
            content:    '<div class="deviceTitle">'+
                        '<span>['+dev+']&nbsp;'+ GpsTime +'</span><br soft/>'+
                        '<span>'+statusText+'&nbsp;&nbsp;'+ spd +'kph</div>'
        });

        markers.push(marker);
        //marker.info.open(map,marker);
        google.maps.event.addListener(marker, 'click', function() {
            closeAllInfowindows();
            marker.info.open(map, marker);
        });        

    };

    function mapToDev(lat,lon){
        var location = new google.maps.LatLng(lat,lon);
        map.panTo(location);
        map.setZoom(16);
    }

    function deleteMarkers(){
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    };

    function closeAllInfowindows(){
        for (var i = 0; i < markers.length; i++) {
            markers[i].info.close();
        }
    };

    function logg(msj){
        var d = new Date();
        var thisTime = d.getHours() + ":"+d.getMinutes()+":"+d.getSeconds();
        console.log(thisTime + "  -> " + msj);
    };

    function loading(OnOff){
        var $this = $( this ),
        theme = $this.jqmData( "theme" ) || $.mobile.loader.prototype.options.theme,
        msgText = $this.jqmData( "msgtext" ) || $.mobile.loader.prototype.options.text,
        textVisible = $this.jqmData( "textvisible" ) || $.mobile.loader.prototype.options.textVisible,
        textonly = !!$this.jqmData( "textonly" );
        html = $this.jqmData( "html" ) || "";

        if (OnOff==true){
            $.mobile.loading( "show", {
                text: msgText,
                textVisible: textVisible,
                theme: theme,
                textonly: textonly,
                html: html
            });
        }else{
            $.mobile.loading( "hide" );
        }

    };

    function reloadFleet(){
        getFleetDevices(jsAccountID,jsGroupID);
    };

    $(window).resize(adjustMapSize);

    function adjustMapSize(){
        mapHeight = $("html").height();
        $("#map").css("height", mapHeight-42);
        mapWidth   = $("html").width() - 300;
        
        $(".devScrl").css({"height": mapHeight});
    }

    $(document).ready(function() {

        /* Rutina para verificar que el usuario exista en el teléfono */
        storageData = JSON.parse(localStorage.getItem(storageKey));
        
        if (storageData === null){
            window.setTimeout(function() {location.href = "index.php";}, 0);

        } else {
            
            jsAccountID     = storageData.accountID;
            jsUserID        = storageData.userID;
            jsPassword      = storageData.password;
            jsUsrDesc       = storageData.description;
            jsGroupID       = storageData.groupID;
        
        };

        var imgLogo = "images/logo.png";
        $("#logoImage").attr("src",imgLogo);

        console.log("Variables de sesion: " + jsAccountID + "/" + jsUserID + "/" + jsPassword + " " + jsUsrDesc + "/" + jsGroupID);
        $(".popphoto").attr("src",bannerLink+"/"+jsAccountID+".jpg");

        $("#welcomeNavbar").html(jsUsrDesc);    

        $("#deviceList ul").click(function(){
            //alert("hoas");
            $( "#list-panel" ).panel( "close" );
        });

        $("#menuList ul").click(function(){
            //alert("hoas");
            $( "#nav-panel" ).panel( "close" );
        });

        $("#flipTraffic").change(function(){
            var flipSts = $("#flipTraffic").val();
            if (flipSts=="on"){
                trafficLayer.setMap(map);
            } else if (flipSts=="off"){
                trafficLayer.setMap(null);
            }
        });

        $("#flipRoute").change(function(){
            var flipSts2 = $("#flipRoute").val();
            if (flipSts2=="on"){
                routeEnabled    = true;
                logg(routeEnabled);
            } else if (flipSts2=="off"){
                routeEnabled    = false;
                logg(routeEnabled);
            }
        });

        $("#flipZoom").change(function(){
            var flipSts3 = $("#flipZoom").val();
            if (flipSts3=="on"){
                zoomEnabled    = true;
                
            } else if (flipSts3=="off"){
                zoomEnabled    = false;
                
            }
        });

        $("#devMap").click(function(){
            clearInterval(handleFleet);     
            // Detenemos el timer de flotas 
            // [ handleFleet = setInterval("reloadFleet();", refreshTimer * 1000); ]
            handleFleet = 0;                    // Lo reseteamos a 0 por si las dudas
            logg("Mapa de flota cancelado");
            deleteMarkers();
            if (isLinePathDrawed){linePath.setMap(null);}
            getDeviceList(jsAccountID,jsGroupID);
            startDeviceTrack(jsDevices[0]);

        });

        $("#fltMap").click(function(){
            clearInterval(handleDev);
            handleDev = 0;
            //isStarted = false;
            if (isLinePathDrawed){linePath.setMap(null);}
            reloadFleet();
            handleFleet = setInterval("getFleetDevices(jsAccountID,jsGroupID)", 50000);
            logg("Mapa de flota reiniciado");
        });

        loadScript();
        adjustMapSize();

        $("#CloseSession").click(function(e){
            e.preventDefault();

            localStorage.removeItem(storageKey);
            location.reload();

        });

        $("#platformLink").click(function(e){
            e.preventDefault();

            var url = plataformaLink+"account="+jsAccountID+"&user="+jsUserID+"&password="+jsPassword;

            window.open(url,'_blank');
        });


        window.setTimeout(function() {
            $( "#banner" ).trigger( "click" );

        }, 3000);

    });

    
    </script>

</body>
</html>
