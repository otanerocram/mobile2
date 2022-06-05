function startDeviceTrack(thisDeviceID) {
  logg('function: startDeviceTrack(' + thisDeviceID + ')');

  if (isStarted === true) {
    clearInterval(handleDev);
    handleDev = 0;
    isStarted = false;
  }
  var dev = '"' + thisDeviceID.toString() + '"';

  handleDev = setInterval('getDeviceTracks(' + dev + ')', refreshTimer * 1000);
  isStarted = true;
  getDeviceTracks(thisDeviceID);
}

function getDeviceTracks(thisDeviceID) {
  logg('function: getDeviceTracks(' + thisDeviceID + ')');

  $.ajax({
    url: 'system/getDeviceTracks.php',
    data: {
      accID: jsAccountID,
      devID: thisDeviceID,
    },
    beforeSend: function (xhr) {
      loading(true);
    },
    timeout: 20000,
    error: function (x, t, m) {
      if (t === 'timeout') {
        logg('Se sobrepasó el tiempo de espera');
      } else {
        logg(t);
      }
    },
    success: function (datos) {
      logg('getDeviceTracks...SUCCESS');
      clearMarkerLayer();

      var ajaxData = $.parseJSON(datos);

      var htmlList = '';
      var counter = 0;

      /** Declarando y limpiando variables **/
      var deviceID = new Array();
      var timestamp = new Array();
      var statusCode = new Array();
      var latitude = new Array();
      var longitude = new Array();
      var speedKPH = new Array();
      var heading = new Array();
      var streetAddress = new Array();
      var city = new Array();

      /** Llenando variables con la consulta SQL **/
      $.each(ajaxData, function (index, value) {
        counter++;
        jsDevices[index] = ajaxData[index].deviceID;
        //logg("["+counter+"] " + jsDevices[index]);

        deviceID[index] = ajaxData[index].deviceID;
        timestamp[index] = ajaxData[index].timestamp;
        statusCode[index] = ajaxData[index].statusCode;
        latitude[index] = ajaxData[index].latitude;
        longitude[index] = ajaxData[index].longitude;
        speedKPH[index] = parseInt(ajaxData[index].speedKPH).toFixed(0);
        heading[index] = parseInt(ajaxData[index].heading).toFixed(0);
        streetAddress[index] = ajaxData[index].streetAddress;
        city[index] = ajaxData[index].city;

        var actualEpoch = new Date().getTime() / 1000;
        var secondsOff = actualEpoch - timestamp[index];

        var alertIcon = '';
        var statusText = '';

        if (secondsOff > 18000) {
        } else {
          if (speedKPH[index] > 2) {
          } else {
          }
        }
      });

      linePoints = []; // Lineas Poligonales
      waypts = []; // Ruta
      bounds = [];
      bounds = new google.maps.LatLngBounds();

      for (var i = 0; i < counter; i++) {
        var thisTimeSMP = from_unixtime(timestamp[i], 0);
        // Coloca los pushpins
        drawRoute(
          deviceID[i],
          latitude[i],
          longitude[i],
          thisTimeSMP,
          heading[i],
          speedKPH[i]
        );
        // Añade los puntos a las las lineas
        linePoints.push(new google.maps.LatLng(latitude[i], longitude[i]));
        // Crea la ruta
        if (i > 0 && i < counter - 1) {
          waypts.push({
            location: new google.maps.LatLng(latitude[i], longitude[i]),
            stopover: true,
          });
        }
        var boundLocation = new google.maps.LatLng(latitude[i], longitude[i]);
        bounds.extend(boundLocation);
      }

      // Limpia las lineas
      if (isLinePathDrawed) {
        linePath.setMap(null);
      }
      // Limpia la ruta
      if (isRoutePathDrawed) {
        directionsDisplay.setMap(null);
      }

      // Verificar si esta activo el flip
      if (routeEnabled === true) {
        // Establece el punto A
        var fromLocation = new google.maps.LatLng(
          latitude[counter - 1],
          longitude[counter - 1]
        );
        // Establece el punto final
        var toLocation = new google.maps.LatLng(latitude[0], longitude[0]);
        // Dibuja la ruta
        calcRoute(fromLocation, toLocation);
        //
        directionsDisplay.setMap(map);
        isRoutePathDrawed = true;
      } else {
        // logg("Puntos a trazar: " + linePoints);

        // Crea el trazado de las lineas
        linePath = new google.maps.Polyline({
          path: linePoints,
          geodesic: true,
          strokeColor: '#ff0000',
          strokeOpacity: 1.0,
          strokeWeight: 2,
        });
        // Lo coloca en el mapa
        linePath.setMap(map);
        // Activa la bandera para volver a limpiarlo
        isLinePathDrawed = true;
      }

      loading(false);
      if (counter > 0) {
        if (zoomEnabled === true) {
          map.fitBounds(bounds);
        } else {
          mapToDev(latitude[0], longitude[0]);
        }
      }
    },
  });
}

function calcRoute(startLocation, endLocation) {
  var request = {
    origin: startLocation,
    destination: endLocation,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING,
  };

  directionsService.route(request, function (response, status) {
    logg('OK ROUTE!');
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);

      /*

		waypoints: waypts,
	  	optimizeWaypoints: true,
	  	var route = response.routes[0];
	      var summaryPanel = document.getElementById('directions_panel');
	      summaryPanel.innerHTML = '';
	      // For each route, display summary information.
	      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
    */
    }
  });
}

function getDeviceList(accID, fleetID) {
  logg('function: getDeviceList(' + accID + ',' + fleetID + ')');
  $.ajax({
    url: 'system/getDeviceList.php',
    data: {
      accID: accID,
      fleetID: fleetID,
    },
    beforeSend: function (xhr) {
      loading(true);
    },
    success: function (datos) {
      logg('getDeviceList...SUCCESS');

      var ajaxData = $.parseJSON(datos);

      var htmlList = '';
      var counter = 0;

      var totalInMotion = 0;
      var totalStop = 0;
      var totalDisconnect = 0;

      /** Declarando y limpiando variables **/
      var deviceID = new Array();
      var licensePlate = new Array();
      var description = new Array();

      /** Llenando variables con la consulta SQL **/
      $.each(ajaxData, function (index, value) {
        counter++;
        deviceID[index] = ajaxData[index].deviceID;
        licensePlate[index] = ajaxData[index].licensePlate;
        description[index] = ajaxData[index].description;

        var dev = '"' + deviceID[index].toString() + '"';

        htmlList += "<li data-icon='false'>";
        htmlList +=
          "<table width='100%'><tr onclick='startDeviceTrack(" +
          dev +
          ");'><td align='left'><span class='listaTitulo'>" +
          licensePlate[index] +
          "</span></td><td align='right'><span>&nbsp;" +
          deviceID[index] +
          '</span></td></tr></table>\n';
        htmlList += "<p class='txtDirections'>" + description[index] + '</p>';
        htmlList += '</li>\n';
      });

      //htmlList += "<li data-icon='false'><a href='#my-header' data-rel='close'>Close panel</a></li>\n";
      $('#deviceList ul').html('');
      $('#deviceList ul').append(htmlList).listview('refresh');

      loading(false);
    },
  });
}

function sendSMS(num, msg) {
  logg('function: sms(' + num + ',' + msg + ')');

  if (num == '999') {
    return false;
  } else {
    $.ajax({
      url: 'http://smsgateway.me/api/v3/messages/send',
      data: {
        email: sms.user,
        password: sms.pass,
        device: sms.device,
        number: num,
        message: msg,
      },
      beforeSend: function (xhr) {
        loading(true);
      },
      type: 'POST',
      contentType: 'application/json',
      dataType: 'jsonp',
      crossDomain: true,
      timeout: 20000,
      jsonpCallback: 'consulta',
      error: function (x, t, m) {
        if (t === 'timeout') {
          alert('Se sobrepasó el tiempo de espera');
        } else {
          console.log('Err: ' + t.toString);
          alert('Comando Enviado!');
        }
        loading(false);
      },
      success: consulta,
    });
  }
}

function consulta() {
  logg('done...');
}

function from_unixtime(epoch, format) {
  var epochTime = epoch;
  var devDt = new Date(epochTime * 1000);
  var horas = devDt.getHours();
  var minutos = devDt.getMinutes();
  var segundos = devDt.getSeconds();
  var dia = devDt.getDate();
  var mes = devDt.getMonth() + 1;
  var year = devDt.getFullYear();

  dia = dia < 10 ? '0' + dia : dia;
  mes = mes < 10 ? '0' + mes : mes;
  horas = horas < 10 ? '0' + horas : horas;
  minutos = minutos < 10 ? '0' + minutos : minutos;
  segundos = segundos < 10 ? '0' + segundos : segundos;

  var deviceDate = '';
  switch (format) {
    case 0:
      deviceDate =
        horas +
        ':' +
        minutos +
        ':' +
        segundos +
        ' ' +
        dia +
        '/' +
        mes +
        '/' +
        year;
      break;
    case 1:
      deviceDate = dia + '/' + mes + '/' + year;
      break;
  }

  return deviceDate;
}

function dayNumberToUnixtime(dayNumber) {
            
  var a = dayNumber * 86400;  // numero de dias por cantidad de segundos
  var b = a - 12219274308;    // al resultado le restamos el epoch 0
  return b;
}

function getModalInfo(placa) {
  $.ajax({
    type: 'GET',
    url: 'sutran.php',
    data: {
      placa: placa,
    },
    beforeSend: function (xhr) {
      loading(true);
      clear_info_modal();
      $('.sutran-modal').modal('show');
    },
    timeout: 20000,
    error: function (x, t, m) {
      if (t === 'timeout') {
        alert('Error: Se sobrepasó el tiempo de espera');
      } else {
        console.log(t);
      }
      loading(false);
    },
    success: function (datos) {
      loading(false);

      var ajaxData = $.parseJSON(datos);

      $('#STR_PLACA').html(ajaxData[0].STR_PLACA);
      $('#NRO_MOTOR').html(ajaxData[0].NRO_MOTOR);
      $('#STR_NROPOLIZA').html(ajaxData[0].STR_NROPOLIZA);
      $('#STR_ENTIDADPOLIZA').html(ajaxData[0].STR_ENTIDADPOLIZA);
      $('#DTE_FECHAPOLIZA').html(ajaxData[0].DTE_FECHAPOLIZA);
      $('#STR_ENTIDADCITV').html(ajaxData[0].STR_ENTIDADCITV);
      $('#STR_NROCITV').html(ajaxData[0].STR_NROCITV);
      $('#DTE_FECHACITV').html(ajaxData[0].DTE_FECHACITV);
      $('#STR_ANIO_FABRICA').html(ajaxData[0].STR_ANIO_FABRICA);
      $('#EMV_CODIGOV').html(ajaxData[0].EMV_CODIGOV);
      $('#EMV_NOMBRE_ETT').html(ajaxData[0].EMV_NOMBRE_ETT);
      $('#EMV_FVIGENCIA').html(ajaxData[0].EMV_FVIGENCIA);
      $('#EMV_ESTADO').html(ajaxData[0].EMV_ESTADO);
      $('#EMV_NOMBRE_EMV').html(ajaxData[0].EMV_NOMBRE_EMV);
      $('#EMV_FECHA').html(ajaxData[0].EMV_FECHA);
      $('#EMV_FECHA_TRANSMISION').html(ajaxData[0].EMV_FECHA_TRANSMISION);
      $('#EMV_SITUACION').html(ajaxData[0].EMV_SITUACION);
      $('#EMV_EVENTO').html(ajaxData[0].EMV_EVENTO);
      $('#EMV_LATITUD').html(ajaxData[0].EMV_LATITUD);
      $('#EMV_LONGITUD').html(ajaxData[0].EMV_LONGITUD);
      $('#EMV_VELOCIDAD').html(ajaxData[0].EMV_VELOCIDAD + 'Kph');
      $('#EMV_RUMBO').html(ajaxData[0].EMV_RUMBO);
      $('#EMV_TIPO_SERVICIO').html(ajaxData[0].EMV_TIPO_SERVICIO);
      $('#EMV_DIRECCION').html(ajaxData[0].EMV_DIRECCION);
      $('#DTE_FECHABILITACION').html(ajaxData[0].DTE_FECHABILITACION);
      $('#DTE_FECHAVIGENCIA').html(ajaxData[0].DTE_FECHAVIGENCIA);
      $('#DTE_FECRESINSCRIPCION').html(ajaxData[0].DTE_FECRESINSCRIPCION);
      $('#STR_NUMRESINSCRIPCION').html(ajaxData[0].STR_NUMRESINSCRIPCION);
    },
  });
}
