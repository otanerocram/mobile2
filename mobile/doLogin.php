<?php

  include('../config.php');

  $conexion = @new mysqli($database['hostname'], $database['username'], $database['password'], $database['database'], $database['port']);
  
  if ($conexion->connect_errno) {
    echo "Lo sentimos, este sitio web está experimentando problemas.<br>";
    echo "Fallo al conectarse a MySQL debido a: <br>";
    echo "Error #: " . $conexion->connect_errno . "<br>";
    echo "Detalle: " . $conexion->connect_error . "<br>";
    exit;
  }

  $loginData    = array();

  $cuenta     = $_GET['cuenta'];
  $usuario    = $_GET['usuario'];
  $password   = $_GET['password'];

  $consulta="SELECT U.`accountID`, U.`userID`, U.`password`, U.`description`, U.`isActive`, G.`groupID` 
  FROM User U
  LEFT JOIN GroupList G
  ON U.`accountID`=G.`accountID` and U.`userID`=G.`userID`
  WHERE U.`accountID`='$cuenta' AND U.`userID`='$usuario' AND U.`password`='$password' LIMIT 1;";
  //SELECT u.`accountID`, u.`userID`, u.`password`, u.`description`, u.`isActive`, g.`groupID` FROM User u, GroupList g WHERE u.`accountID`=g.`accountID` AND u.`userID`=g.`userID` AND u.`accountID`='$cuenta' AND u.`userID`='$usuario' AND u.`password`='$password' LIMIT 1;";

  $resultados = $conexion->query($consulta);
  $idGrupo="";
  
  if ($resultados->num_rows > 0){
    
    while($row = $resultados->fetch_array(MYSQLI_ASSOC)){
      
      if($row['groupID']==null){
        $idGrupo='isAdmin';
      }else{
        $idGrupo=utf8_encode($row['groupID']);
      }

      $loginData[] = array(
        'accountID'       => utf8_encode($row['accountID']),
        'userID'          => utf8_encode($row['userID']),
        'password'        => utf8_encode($row['password']),
        'description'     => utf8_encode($row['description']),
        'isActive'        => utf8_encode($row['isActive']),
        'groupID'         => $idGrupo,
        
      );
    } // Fin de While "llenar $track"

    //echo json_encode($loginData,JSON_UNESCAPED_UNICODE);
    echo json_encode($loginData);

  }else{
    $loginData[] = array(
        'accountID'       => "",
        'userID'          => "",
        'password'        => "",
        'description'     => "",
        'isActive'        => "",
        'groupID'         => "",
      );
	  echo json_encode($loginData);

  }
  // $conexion->close();
  mysqli_close($conexion);
?>