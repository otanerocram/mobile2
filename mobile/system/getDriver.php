<?php

include('../../config.php');

$conexion = @new mysqli($database['hostname'], $database['username'], $database['password'], $database['database'], $database['port']);

if ($conexion->connect_errno) {
  echo "Lo sentimos, este sitio web está experimentando problemas.<br>";
  echo "Fallo al conectarse a MySQL debido a: <br>";
  echo "Error #: " . $conexion->connect_errno . "<br>";
  echo "Detalle: " . $conexion->connect_error . "<br>";
  exit;
}

$loginData    = array();

$accountID    = $_GET['accountID'];
$driverID     = $_GET['driverID'];

$consulta = "SELECT `contactPhone`, `description`,`licenseType`,`licenseExpire` FROM Driver WHERE `accountID`='$accountID' AND `driverID`='$driverID' LIMIT 1;";

$resultados = $conexion->query($consulta);

if ($resultados->num_rows > 0) {

  while ($row = $resultados->fetch_array(MYSQLI_ASSOC)) {
    $loginData[] = array(
      'contactPhone'    => utf8_encode($row['contactPhone']),
      'description'     => utf8_encode($row['description']),
      'licenseType'     => utf8_encode($row['licenseType']),
      'licenseExpire'   => utf8_encode($row['licenseExpire']),
    );
  } // Fin de While "llenar $track"

  //echo json_encode($loginData,JSON_UNESCAPED_UNICODE);
  echo json_encode($loginData);
} else {
  $loginData[] = array(
    'contactPhone'    => "-",
    'description'     => "-",
    'licenseType'     => "-",
    'licenseExpire'   => 0,
  );
  echo json_encode($loginData);
}
// $conexion->close();
mysqli_close($conexion);
