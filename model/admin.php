<?php
require_once("../lib/comun.php");
session_start();
if (isset($_REQUEST['accion'])) {
  switch ($_REQUEST['accion']) {
    case 1:
      # select
      $conn = conectarBD();
      seleccionar ($conn);
      break;
    case 2:
      # insert
      $conn = conectarBD();
      insertar ($conn);
      break;
    case 3:
      # select where = ?
      $conn = conectarBD();
      seleccionarUno ($conn);
      break;
    case 4:
      # update where = ?
      $conn = conectarBD();
      actualizar ($conn);
      break;
    case 5:
      # delete where = ?
      $conn = conectarBD();
      eliminar ($conn);
      break;
    case 6:
      # delete where = ?
      $conn = conectarBD();
      obtenerDirector ($conn);
      break;
    case 7:
      # delete where = ?
      $conn = conectarBD();
      obtenerposibleDirector ($conn);
      break;
    case 8:
      # delete where = ?
      $conn = conectarBD();
      cambiartporfDirector($conn);
      break;
    case 9:
      # delete where = ?
      $conn = conectarBD();
      cambiarfportnuevoDirector($conn);
      break;
    case 10:
      # delete where = ?
      $conn = conectarBD();
      revisarclaveAntigua($conn);
      break;
    case 11:
      # delete where = ?
      $conn = conectarBD();
      cambiarContrasena($conn);
      break;
    case 12:
      # delete where = ?
      $conn = conectarBD();
      reestablecerContrasena($conn);
      break;
    case 13:
      # delete where = ?
      $conn = conectarBD();
      limpiartablaInvita($conn);
      break;
    case 14:
      # delete where = ?
      $conn = conectarBD();
      limpiartablaVotacion($conn);
      break;
    case 15:
      # delete where = ?
      $conn = conectarBD();
      limpiartablaReunion($conn);
      break;
    case 16:
      # delete where = ?
      $conn = conectarBD();
      obtenerAdmin ($conn);
      break;
    case 17:
      # delete where = ?
      $conn = conectarBD();
      obtenerposibleAdmin($conn);
      break;
    case 18:
      # delete where = ?
      $conn = conectarBD();
      cambiartporfAdmin($conn);
      break;
    case 19:
      # delete where = ?
      $conn = conectarBD();
      cambiarfportnuevoAdmin($conn);
      break;


  }
}

function seleccionar ($conn) {
  $sql= "select * from usuario where admin=:admin order by user_name asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':admin', 'f');
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}


function insertar ($conn) {
  $user_name = $_REQUEST['user_name'];
  $nombres = $_REQUEST['nombres'];
  $apellidos = $_REQUEST['apellidos'];
  $correo = $_REQUEST['correo'];
  $celular = $_REQUEST['celular'];
  $contrasena = "password";
  correoNuevoProfesor($user_name,$nombres,$apellidos,$correo,$celular,$contrasena);

  $clave_encriptada=encriptar($contrasena);
  $sql= "insert into usuario(user_name,nombres,apellidos,correo,celular,contrasena,director,admin,secretario)values
  (:user_name,:nombres,:apellidos,:correo,:celular,:contrasena,:director,:admin,:secretario);";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $stmt->bindValue(':nombres', $nombres);
  $stmt->bindValue(':apellidos', $apellidos);
  $stmt->bindValue(':correo', $correo);
  $stmt->bindValue(':celular', $celular);
  $stmt->bindValue(':contrasena', $clave_encriptada);
  $stmt->bindValue(':director', 'f');
  $stmt->bindValue(':admin', 'f');
  $stmt->bindValue(':secretario', 'f');
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
}

function seleccionarUno ($conn) {
  $user_name = $_REQUEST['user_name'];
  $sql= "select * from usuario where user_name = :user_name order by user_name asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
}

function actualizar ($conn) {
  $user_name = $_REQUEST['user_name'];
  $user_name_old = $_REQUEST['user_name_old'];
  $nombres = $_REQUEST['nombres'];
  $apellidos = $_REQUEST['apellidos'];
  //$clave_encriptada=encriptar($clave);
  $correo = $_REQUEST['correo'];
  $celular = $_REQUEST['celular'];
  $sql= "update usuario set nombres=:nombres,apellidos=:apellidos,
  correo=:correo,celular=:celular where user_name=:user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $stmt->bindValue(':nombres', $nombres);
  $stmt->bindValue(':apellidos', $apellidos);
  $stmt->bindValue(':correo', $correo);
  $stmt->bindValue(':celular', $celular);
  $stmt->bindValue(':user_name_old', $user_name_old);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
}

function eliminar ($conn) {
  $user_name = $_REQUEST['user_name'];
  $sql= "delete from usuario where user_name = :user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function obtenerDirector($conn){
  $sql= "select * from usuario where director=:director order by user_name asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':director', 't');
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function obtenerposibleDirector($conn){
  $sql= "select * from usuario where director=:director and admin=:admin order by user_name asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':director', 'f');
  $stmt->bindValue(':admin', 'f');
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function cambiartporfDirector($conn){
  $user_name = $_REQUEST['user_name'];
  $sql= "update usuario set director=:director where user_name=:user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':director', 'f');
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
}

function cambiarfportnuevoDirector($conn){
  $user_name = $_REQUEST['user_name'];
  $sql= "update usuario set director=:director where user_name=:user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':director', 't');
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
}


function revisarclaveAntigua ($conn){
  $contrasena_antigua=$_REQUEST['contrasena_antigua'];
  //$clave_encriptada=encriptar($clave_antigua);
  $user_name=$_SESSION['user_name'];
  //$clave_encriptada=encriptar($contrasena_antigua);
  $sql="select nombres from usuario where user_name=:user_name AND contrasena=:contrasena_antigua;";
  $stmt = $conn->prepare($sql);
  //$stmt->bindValue(':clave_antigua', $clave_encriptada);
  $stmt->bindValue(':contrasena_antigua', $contrasena_antigua);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function cambiarContrasena($conn){
  $contrasena_nueva=$_REQUEST['contrasena_nueva'];
  $contrasena_nueva2=$_REQUEST['contrasena_nueva2'];
  $user_name=$_SESSION['user_name'];
  if($contrasena_nueva==$contrasena_nueva2){
    $clave_encriptada=encriptar($contrasena_nueva);
    //$clave_encriptada=encriptar($clave_nueva);
    $sql="update usuario set contrasena=:contrasena_nueva where user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':contrasena_nueva', $clave_encriptada);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }else {
    $sql="update usuario set clave=:clave_nueva where rut=:rut;";
    $stmt = $conn->prepare($sql);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
}

function reestablecerContrasena($conn){
  $user_name=$_REQUEST['user_name'];
  $sql="update usuario set contrasena=:contrasena_reestablecida where user_name=:user_name;";
  $clave_encriptada=encriptar('password');
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':contrasena_reestablecida', $clave_encriptada);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function limpiartablaInvita($conn){
  $user_name = $_REQUEST['user_name'];
  $sql= "delete from invita where user_name = :user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}
function limpiartablaVotacion($conn){
  $user_name = $_REQUEST['user_name'];
  $sql= "delete from votacion where user_name = :user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function limpiartablaReunion($conn){
  $user_name=$_REQUEST['user_name'];
  $user_name_director=$_REQUEST['user_name_director'];
  $sql="update reunion set usu_user_name=:user_name_director where usu_user_name=:user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name_director', $user_name_director);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));

}

function obtenerAdmin($conn){
  $sql= "select * from usuario where admin=:admin order by user_name asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':admin', 't');
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function obtenerposibleAdmin($conn){
  $sql= "select * from usuario where admin=:admin order by user_name asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':admin', 'f');
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function cambiartporfAdmin($conn){
  $user_name = $_REQUEST['user_name'];
  $sql= "update usuario set admin=:admin where user_name=:user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':admin', 'f');
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
}

function cambiarfportnuevoAdmin($conn){
  $user_name = $_REQUEST['user_name'];
  $sql= "update usuario set admin=:admin where user_name=:user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':admin', 't');
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
}
?>
