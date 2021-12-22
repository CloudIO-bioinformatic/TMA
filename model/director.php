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
      obtenerTemas($conn);
      break;
    case 3:
      # select where = ?
      $conn = conectarBD();
      obtenerAsistencia ($conn);
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
      revisarclaveAntigua($conn);
      break;
    case 7:
      # delete where = ?
      $conn = conectarBD();
      cambiarContrasena($conn);
      break;
    case 8:
      # delete where = ?
      $conn = conectarBD();
      mostrarPerfil($conn);
      break;
    case 9:
      # delete where = ?
      $conn = conectarBD();
      cambiarPerfil($conn);
      break;
  }
}

function seleccionar ($conn) {
  $sql= "select * from reunion order by fecha_creacion asc;";
  $stmt = $conn->prepare($sql);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}


function obtenerTemas ($conn){
  $id_reunion = $_REQUEST['id_reunion'];
  $sql= "select tema.id_tema,tema.id_reunion,tema.descripcion,ruta_archivo,reunion.fecha_creacion from tema join reunion on tema.id_reunion=reunion.id_reunion where tema.id_reunion=:id_reunion order by tema.id_tema asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':id_reunion', $id_reunion);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function obtenerAsistencia ($conn){

  $user_name=$_SESSION['user_name'];
  $sql="select reunion.id_reunion,reunion.fecha_creacion,invita.asiste
   from invita join reunion on invita.id_reunion=reunion.id_reunion join usuario on reunion.user_name=usuario.user_name where invita.user_name=:user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function revisarclaveAntigua ($conn){
  $contrasena_antigua=$_REQUEST['contrasena_antigua'];
  $clave_encriptada=encriptar($contrasena_antigua);
  $user_name=$_SESSION['user_name'];
  $sql="select nombres from usuario where user_name=:user_name AND contrasena=:contrasena_antigua;";
  $stmt = $conn->prepare($sql);
  //$stmt->bindValue(':clave_antigua', $clave_encriptada);
  $stmt->bindValue(':contrasena_antigua', $clave_encriptada);
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


 function mostrarPerfil($conn){
   $user_name=$_SESSION['user_name'];
   $sql="select * from usuario where user_name=:user_name;";
   $stmt = $conn->prepare($sql);
   $stmt->bindValue(':user_name', $user_name);
   $res = ejecutarSQL($stmt);
   echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}


  function cambiarPerfil($conn){
    $user_name=$_SESSION['user_name'];
    $nombres=$_REQUEST['nombres'];
    $apellidos=$_REQUEST['apellidos'];
    $correo=$_REQUEST['correo'];
    $celular=$_REQUEST['celular'];
    $sql="update usuario set nombres=:nombres,apellidos=:apellidos,correo=:correo,celular=:celular where user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nombres', $nombres);
    $stmt->bindValue(':apellidos', $apellidos);
    $stmt->bindValue(':correo', $correo);
    $stmt->bindValue(':celular', $celular);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}
?>
