<?php
include "config.php";
include "conexion.php";

// En ste ejeplo servicio REST se considera la insercion de los datos (metodo post), 
// con la generacion de contraseñas seguras con password_hash() y un salt aleatorio y un costo 12 ;
// y la consulta que es lo que se solicitó , (metodo GET) 
// las pruebas las hice en Postman 
$dbConn =  connect($db);// CONEXION CON LA BASE DE DATOS

// METODO GET
// Busca el registro ingresado (conparametros password y user)
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['password'])) {
    $name = $_GET['user'];
    $pass = $_GET['password'];
    $con = 0;
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbConn->prepare("SELECT * FROM Users where user=:user");
    $sql->execute(array(':user' => $name));

    while ($registro = $sql->fetch(PDO::FETCH_ASSOC)) {
      if (password_verify($pass, $registro['password'])) {
        $full = $registro['fullName'];
        $con++;
      }
    }

    if ($con > 0) {
      $fullName['nombrecompleto'] = $full;
    } else {
      $fullName['nombrecompleto'] = "no existe";
    }
    header("HTTP/1.1 200 OK");
    echo json_encode($fullName['nombrecompleto']);
    exit();
  } else {
    $sql = $dbConn->prepare("SELECT * FROM Users");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetchAll());
    exit();
  }
}

// METODO POST :
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $user = $_POST['user'];
  $full = $_POST['fullName'];

  $contraseña = $_POST['password'];
  $jo = ['user' => $user, 'password' => $contraseña, 'fullName' => $full];
  $opciones = [
    'cost' => 12,
    'salt' => random_bytes(22), // generamos el salt aleatoriamente (tamaño =5)
    // es mas seguro que la salt se genere aleatoriamente recomendado
  ];

  $pass_encrypt = password_hash($contraseña, PASSWORD_BCRYPT, $opciones);
  $sql = "INSERT INTO Users
          (user, password, fullName) VALUES  (:user, :password, :fullName)";

  $statement = $dbConn->prepare($sql);
  $statement->bindValue(':user', $user, PDO::PARAM_STR);
  $statement->bindValue(':password', $pass_encrypt, PDO::PARAM_STR);
  $statement->bindValue(':fullName', $full, PDO::PARAM_STR);
  
  $statement->execute();
  $postId = $dbConn->lastInsertId();
  if ($postId) {
    $input['id'] = $postId;
    header("HTTP/1.1 200 OK");
    echo json_encode($input);
    exit();
  }
}

//En mi caso tengo 2 metodo POST y GET , en caso de no elegir ninguna devuelve:
header("HTTP/1.1 400 Bad Request");

?>