<?php
require_once("../lib/comun.php");
session_start();
if (isset($_REQUEST['accion'])) {
  switch ($_REQUEST['accion']) {
    case 1:
      # select
      $conn = conectarBD();
      reunionesInvitados ($conn);
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
    case 10:
      # delete where = ?
      $conn = conectarBD();
      saberPerfil($conn);
      break;
    case 11:
      # delete where = ?
      $conn = conectarBD();
      obtenerSecretario($conn);
      break;
    case 12:
      # delete where = ?
      $conn = conectarBD();
      obtenerposibleSecretario($conn);
      break;
    case 13:
      # delete where = ?
      $conn = conectarBD();
      cambiartporfSecretario($conn);
      break;
    case 14:
      # delete where = ?
      $conn = conectarBD();
      cambiarfportnuevoSecretario($conn);
      break;
    case 15:
      # delete where = ?
      $conn = conectarBD();
      insertarReunion($conn);
      break;
    case 16:
      # delete where = ?
      $conn = conectarBD();
      ultimaReunion($conn);
      break;
    case 17:
      # delete where = ?
      $conn = conectarBD();
      obtenerReunion($conn);
      break;
    case 18:
      # delete where = ?
      $conn = conectarBD();
      editarReunion($conn);
      break;
    case 19:
      # delete where = ?
      $conn = conectarBD();
      eliminarReunion($conn);
      break;
    case 20:
      # delete where = ?
      $conn = conectarBD();
      limpiarInvita($conn);
      break;
    case 21:
      # delete where = ?
      $conn = conectarBD();
      limpiarVotacion($conn);
      break;
    case 22:
      # delete where = ?
      $conn = conectarBD();
      limpiarTemas($conn);
      break;
    case 23:
      # delete where = ?
      $conn = conectarBD();
      insertarTema($conn);
      break;
    case 24:
      # delete where = ?
      $conn = conectarBD();
      obtenerTema($conn);
      break;
    case 25:
      # delete where = ?
      $conn = conectarBD();
      editarTema($conn);
      break;
    case 26:
      # delete where = ?
      $conn = conectarBD();
      eliminarTema($conn);
      break;
    case 27:
      # delete where = ?
      $conn = conectarBD();
      obtenerInvitados($conn);
      break;
    case 28:
      # delete where = ?
      $conn = conectarBD();
      obtenerpreviamenteInvitados($conn);
      break;
    case 29:
      # delete where = ?
      $conn = conectarBD();
      insertarInvitados($conn);
      break;
    case 30:
      # delete where = ?
      $conn = conectarBD();
      reestablecerInvitacion($conn);
      break;
    case 31:
      # delete where = ?
      $conn = conectarBD();
      historialReunion($conn);
      break;
    case 32:
      # delete where = ?
      $conn = conectarBD();
      directorReuniones($conn);
      break;
    case 33:
      # delete where = ?
      $conn = conectarBD();
      directorReunionesHistorial($conn);
      break;
    case 34:
      # delete where = ?
      $conn = conectarBD();
      saberSecretario($conn);
      break;
    case 35:
      # delete where = ?
      $conn = conectarBD();
      insertarComentarioTema($conn);
      break;
    case 36:
      # delete where = ?
      $conn = conectarBD();
      mostrarListaProfesores($conn);
      break;
    case 37:
      # delete where = ?
      $conn = conectarBD();
      insertarLista($conn);
      break;
    case 38:
      # delete where = ?
      $conn = conectarBD();
      votacionTemas($conn);
      break;
    case 39:
      # delete where = ?
      $conn = conectarBD();
      votacionTemasanteriores($conn);
      break;
    case 40:
      # delete where = ?
      $conn = conectarBD();
      insertarVotacion($conn);
      break;
    case 41:
      # delete where = ?
      $conn = conectarBD();
      editarVotacion($conn);
      break;
    case 42:
      # delete where = ?
      $conn = conectarBD();
      numInvitaciones($conn);
      break;
    case 43:
      # delete where = ?
      $conn = conectarBD();
      numreunionesAsistidas($conn);
      break;
    case 44:
      # delete where = ?
      $conn = conectarBD();
      invitarDirectorporDefecto($conn);
      break;
    case 45:
      # delete where = ?
      $conn = conectarBD();
      invitarSecretarioporDefecto($conn);
      break;
    case 46:
      # delete where = ?
      $conn = conectarBD();
      obtenerDirector($conn);
      break;
    case 47:
      # delete where = ?
      $conn = conectarBD();
      eliminarTemaVotacion($conn);
      break;
    case 48:
      # delete where = ?
      $conn = conectarBD();
      obtenerListaInvitados($conn);
      break;
    case 49:
      # delete where = ?
      $conn = conectarBD();
      votaciondelosInvitados($conn);
      break;
    case 50:
      # delete where = ?
      $conn = conectarBD();
      finalizarReunion($conn);
      break;
    case 51:
      # delete where = ?finalizarReunionInvitados($conn)
      $conn = conectarBD();
      obtenerCorreosyfecha_reunion($conn);
      break;
    case 52:
      # delete where = ?
      $conn = conectarBD();
      finalizarReunionInvitados($conn);
      break;
  }
}

function reunionesInvitados ($conn) {
  $user_name=$_SESSION['user_name'];
  $sql= "select reunion.ruta_documento,reunion.id_reunion,reunion.usu_user_name,reunion.fecha_creacion,reunion.fecha_reunion,reunion.hora_reunion from invita join reunion
  on invita.id_reunion=reunion.id_reunion where invita.user_name=:user_name and aprobada=:aprobada order by fecha_creacion asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $stmt->bindValue(':aprobada', 'f');
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}


function obtenerTemas ($conn){
  $id_reunion = $_REQUEST['id_reunion'];
  $sql= "select reunion.ruta_documento,reunion.fecha_reunion,tema.id_tema,tema.id_reunion,tema.descripcion,tema.ruta_archivo,tema.comentario_tema from tema join reunion on tema.id_reunion=reunion.id_reunion where tema.id_reunion=:id_reunion order by tema.id_tema asc;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':id_reunion', $id_reunion);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function obtenerAsistencia ($conn){

  $user_name=$_SESSION['user_name'];
  $sql="select reunion.id_reunion,reunion.fecha_reunion,invita.asiste
   from invita join reunion on invita.id_reunion=reunion.id_reunion join usuario on reunion.user_name=usuario.user_name where invita.user_name=:user_name;";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_name', $user_name);
  $res = ejecutarSQL($stmt);
  echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
}

function revisarclaveAntigua ($conn){
  $contrasena_antigua=$_REQUEST['contrasena_antigua'];
  //$clave_encriptada=encriptar($clave_antigua);
  $user_name=$_SESSION['user_name'];
  $clave_encriptada_antigua=encriptar($contrasena_antigua);
  $sql="select nombres from usuario where user_name=:user_name AND contrasena=:contrasena_antigua;";
  $stmt = $conn->prepare($sql);
  //$stmt->bindValue(':clave_antigua', $clave_encriptada);
  $stmt->bindValue(':contrasena_antigua', $clave_encriptada_antigua);
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

  function saberPerfil($conn){
    $user_name=$_SESSION['user_name'];
    $sql="select director from usuario where user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function obtenerSecretario($conn){
    $sql= "select * from usuario where secretario=:secretario order by user_name asc;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':secretario', 't');
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function obtenerposibleSecretario($conn){
    $sql= "select * from usuario where secretario=:secretario and admin=:admin and director=:director order by user_name asc;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':secretario', 'f');
    $stmt->bindValue(':admin', 'f');
    $stmt->bindValue(':director', 'f');
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }

  function cambiartporfSecretario($conn){
    $user_name = $_REQUEST['user_name'];
    $sql= "update usuario set secretario=:secretario where user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':secretario', 'f');
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
  }

  function cambiarfportnuevoSecretario($conn){
    $user_name = $_REQUEST['user_name'];
    $sql= "update usuario set secretario=:secretario where user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':secretario', 't');
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
  }

  function insertarReunion($conn){
    //$currentDir = getcwd();
    $uploadDirectory = "../uploads/";
    $msg = [];
    $fileExtensions = ['jpeg','jpg','png','pdf','zip','odt','ods']; // Get all the file extensions

    $fileName = $_FILES['documento']['name'];
    $fileSize = $_FILES['documento']['size'];
    $fileTmpName  = $_FILES['documento']['tmp_name'];
    $fileType = $_FILES['documento']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $hoy=date("Y-m-d");
    if(empty($fileName)){
      $uploadPath ="";
    }else{
      $uploadPath = $uploadDirectory.$hoy."_".basename($fileName);
    }
    //$uploadPath = $uploadDirectory.$hoy."_".basename($fileName);
    if (! in_array($fileExtension,$fileExtensions)) {
        $msg[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 20000000) {
        $msg[] = "This file is more than 20MB. Sorry, it has to be less than or equal to 20MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        $msg[] = "Estamos ok!";
    }
    $user_name_secretario = $_REQUEST['user_name'];
    $user_name=$_SESSION['user_name'];
    $fecha_reunion=$_REQUEST['fecha_reunion'];
    $hora_reunion=$_REQUEST['hora_reunion'];
    //$documento=$_REQUEST['documento'];

    $sql= "insert into reunion(user_name,usu_user_name,fecha_creacion,aprobada,fecha_reunion,hora_reunion,ruta_documento)values(:user_name,:user_name_secretario,:hoy,:aprobada,:fecha_reunion,:hora_reunion,:ruta_documento);";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_name', $user_name);
    $stmt->bindValue(':user_name_secretario', $user_name_secretario);
    $stmt->bindValue(':hoy', $hoy);
    $stmt->bindValue(':aprobada', 'f');
    $stmt->bindValue(':fecha_reunion', $fecha_reunion);
    $stmt->bindValue(':hora_reunion', $hora_reunion);
    $stmt->bindValue(':ruta_documento', $uploadPath);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
  }
  function ultimaReunion($conn){
    $sql= "select max(id_reunion) as ultima from reunion;";
    $stmt = $conn->prepare($sql);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }

  function obtenerReunion($conn){
    $url_vieja=$_REQUEST['url_vieja'];
    unlink($url_vieja);
    $id_reunion=$_REQUEST['id_reunion'];
    $sql= "select * from reunion where id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function editarReunion($conn){
    $uploadDirectory = "../uploads/";
    $msg = [];
    $fileExtensions = ['jpeg','jpg','png','pdf','zip','odt','ods']; // Get all the file extensions

    $fileName = $_FILES['documento']['name'];
    $fileSize = $_FILES['documento']['size'];
    $fileTmpName  = $_FILES['documento']['tmp_name'];
    $fileType = $_FILES['documento']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $hoy=date("Y-m-d");
    if(empty($fileName)){
      $uploadPath ="";
    }else{
      $uploadPath = $uploadDirectory.$hoy."_".basename($fileName);
    }

    if (! in_array($fileExtension,$fileExtensions)) {
        $msg[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 20000000) {
        $msg[] = "This file is more than 20MB. Sorry, it has to be less than or equal to 20MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        $msg[] = "Estamos ok!";
    }

    $id_reunion = $_REQUEST['id_reunion'];
    $fecha_reunion = $_REQUEST['fecha_reunion'];
    $hora_reunion=$_REQUEST['hora_reunion'];
    $sql= "update reunion set fecha_reunion=:fecha_reunion, hora_reunion=:hora_reunion,ruta_documento=:ruta_documento where id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':fecha_reunion', $fecha_reunion);
    $stmt->bindValue(':hora_reunion', $hora_reunion);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':ruta_documento', $uploadPath);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
  }
  function eliminarReunion($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $sql= "delete from reunion where id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function limpiarInvita($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $sql= "delete from invita where id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function  limpiarVotacion($conn){
    $id_tema=$_REQUEST['id_tema'];
    $sql= "delete from votacion where id_tema=:id_tema;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_tema', $id_tema);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function limpiarTemas($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $sql= "delete from tema where id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function insertarTema($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $descripcion=$_REQUEST['descripcion'];
    $sql= "insert into tema(id_reunion,descripcion)values(:id_reunion,:descripcion);";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':descripcion', $descripcion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function obtenerTema($conn){
    $id_tema=$_REQUEST['id_tema'];
    $sql= "select * from tema where id_tema=:id_tema;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_tema', $id_tema);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function editarTema($conn){
    $id_tema = $_REQUEST['id_tema'];
    $descripcion=$_REQUEST['descripcion'];
    $sql= "update tema set descripcion=:descripcion where id_tema=:id_tema;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':descripcion', $descripcion);
    $stmt->bindValue(':id_tema', $id_tema);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"][0]));
  }
  function eliminarTema($conn){
    $id_tema=$_REQUEST['id_tema'];
    $sql= "delete from tema where id_tema=:id_tema;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_tema', $id_tema);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function obtenerInvitados($conn){
    $sql= "select * from usuario where director=:director and secretario=:secretario order by user_name asc;";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':director', 'f');
    $stmt->bindValue(':secretario', 'f');
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function obtenerpreviamenteInvitados($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $sql= "select * from invita join usuario on invita.user_name=usuario.user_name where invita.id_reunion=:id_reunion and usuario.director=:director and usuario.secretario=:secretario order by invita.user_name asc;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':director', 'f');
    $stmt->bindValue(':secretario', 'f');
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function insertarInvitados($conn){
    $user_name=$_SESSION['user_name'];
    $nombres=$_SESSION['nombres'];
    $apellidos=$_SESSION['apellidos'];
    $id_reunion=$_REQUEST['id_reunion'];
    $user_name_invitado=$_REQUEST['user_name'];
    $fecha_reunion=$_REQUEST['fecha_reunion'];
    $correo=$_REQUEST['correo'];
    correoInvitacion($user_name_invitado,$user_name,$nombres,$apellidos,$fecha_reunion,$correo);
    $sql= "insert into invita(user_name,id_reunion)values(:user_name,:id_reunion);";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':user_name', $user_name_invitado);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function reestablecerInvitacion($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $sql= "delete from invita where id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function historialReunion($conn){
    $user_name=$_SESSION['user_name'];
    $sql= "select reunion.id_reunion,reunion.usu_user_name,reunion.fecha_creacion,reunion.fecha_reunion,reunion.hora_reunion from invita join reunion
    on invita.id_reunion=reunion.id_reunion where invita.user_name=:user_name and aprobada=:aprobada order by fecha_creacion asc;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_name', $user_name);
    $stmt->bindValue(':aprobada', 't');
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function directorReuniones($conn){
    $sql= "select * from reunion where aprobada=:aprobada order by fecha_creacion asc;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':aprobada', 'f');
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function directorReunionesHistorial($conn){
    $sql= "select * from reunion where aprobada=:aprobada order by fecha_creacion asc;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':aprobada', 't');
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function saberSecretario($conn){
    $user_name=$_SESSION['user_name'];
    $sql= "select secretario from usuario where user_name=:user_name order by user_name asc;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function insertarComentarioTema($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $id_tema=$_REQUEST['id_tema'];
    $comentario_tema=$_REQUEST['comentario_tema'];
    $sql= "update tema set comentario_tema=:comentario_tema where id_tema=:id_tema and id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':comentario_tema', $comentario_tema);
    $stmt->bindValue(':id_tema', $id_tema);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function mostrarListaProfesores($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $sql= "select usuario.user_name,usuario.nombres,usuario.apellidos,invita.asiste from invita join usuario on invita.user_name=usuario.user_name  where invita.id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function insertarLista($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $user_name_invitado=$_REQUEST['user_name'];
    $asiste=$_REQUEST['asiste'];
    $sql= "update invita set asiste=:asiste where user_name=:user_name and id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':user_name', $user_name_invitado);
    $stmt->bindValue(':asiste', $asiste);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function votacionTemas($conn){
    $id_tema=$_REQUEST['id_tema'];
    $sql= "select * from votacion where id_tema=:id_tema order by id_tema asc;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_tema', $id_tema);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function votacionTemasanteriores($conn){
  //$id_tema=$_REQUEST['id_tema'];
    $id_reunion=$_REQUEST['id_reunion'];
    $user_name=$_SESSION['user_name'];
    //$sql="select votacion.voto,votacion.comentario,votacion.id_tema,votacion.user_name from reunion join tema on reunion.id_reunion=tema.id_reunion join votacion on tema.id_tema=votacion.id_tema where votacion.id_tema=:id_tema and votacion.user_name=:user_name;";
    $sql="select votacion.voto,votacion.comentario,tema.comentario_tema,tema.descripcion,tema.id_tema,reunion.fecha_reunion,reunion.ruta_documento from reunion join
    tema on reunion.id_reunion=tema.id_reunion join votacion on tema.id_tema=votacion.id_tema where reunion.id_reunion=:id_reunion and votacion.user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    //$stmt->bindValue(':id_tema', $id_tema);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function insertarVotacion($conn){
    $user_name=$_SESSION['user_name'];
    $id_tema=$_REQUEST['id_tema'];
    $voto=$_REQUEST['voto'];
    $comentario=$_REQUEST['comentario'];
    $hoy=date("Y-m-d");
    $sql= "insert into votacion(user_name,id_tema,voto,fecha_creacion,comentario)values(:user_name,:id_tema,:voto,:fecha_creacion,:comentario);";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_name', $user_name);
    $stmt->bindValue(':id_tema', $id_tema);
    $stmt->bindValue(':voto', $voto);
    $stmt->bindValue(':fecha_creacion', $hoy);
    $stmt->bindValue(':comentario', $comentario);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function editarVotacion($conn){
    $voto=$_REQUEST['voto'];
    $hoy=date("Y-m-d");
    $user_name=$_SESSION['user_name'];
    $id_tema=$_REQUEST['id_tema'];
    $comentario=$_REQUEST['comentario'];
    $sql= "update votacion set voto=:voto,fecha_creacion=:fecha_creacion,comentario=:comentario where user_name=:user_name and id_tema=:id_tema;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':voto', $voto);
    $stmt->bindValue(':fecha_creacion', $hoy);
    $stmt->bindValue(':comentario', $comentario);
    $stmt->bindValue(':user_name', $user_name);
    $stmt->bindValue(':id_tema', $id_tema);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function numInvitaciones($conn){
    $user_name=$_SESSION['user_name'];
    $sql="select count(user_name) as num_reuniones from invita where user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }

  function numreunionesAsistidas($conn){
    $user_name=$_SESSION['user_name'];
    $sql="select count(user_name)as num_asistencias from invita where user_name=:user_name and asiste=:asiste;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_name', $user_name);
    $stmt->bindValue(':asiste', 't');
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function invitarDirectorporDefecto($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $user_name=$_SESSION['user_name'];
    $sql= "insert into invita(user_name,id_reunion)values(:user_name,:id_reunion);";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function invitarSecretarioporDefecto($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $user_name=$_REQUEST['user_name_secretario'];
    $sql= "insert into invita(user_name,id_reunion)values(:user_name,:id_reunion);";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function obtenerDirector($conn){
    $user_name=$_SESSION['user_name'];
    $sql="select director from usuario where user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function eliminarTemaVotacion($conn){
    $id_tema=$_REQUEST['id_tema'];
    $sql="delete from votacion where id_tema=:id_tema;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_tema', $id_tema);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function obtenerListaInvitados($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $sql="select usuario.user_name,usuario.nombres,usuario.apellidos from usuario join invita on usuario.user_name=invita.user_name where invita.id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function votaciondelosInvitados($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $user_name=$_REQUEST['user_name'];
    //$sql="select votacion.voto,votacion.comentario,votacion.id_tema,votacion.user_name from reunion join tema on reunion.id_reunion=tema.id_reunion join votacion on tema.id_tema=votacion.id_tema where votacion.id_tema=:id_tema and votacion.user_name=:user_name;";
    $sql="select votacion.voto,votacion.comentario,tema.id_tema from reunion join
    tema on reunion.id_reunion=tema.id_reunion join votacion on tema.id_tema=votacion.id_tema where reunion.id_reunion=:id_reunion and votacion.user_name=:user_name;";
    $stmt = $conn->prepare($sql);
    //$stmt->bindValue(':id_tema', $id_tema);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $stmt->bindValue(':user_name', $user_name);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function finalizarReunion($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $user_name=$_SESSION['user_name'];
    $hoy=date("Y-m-d");
    $sql="update reunion set aprobada=:aprobada, fecha_aprobada=:fecha_aprobada where id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':aprobada', 't');
    $stmt->bindValue(':fecha_aprobada', $hoy);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function obtenerCorreosyfecha_reunion($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $sql= "select usuario.correo,reunion.fecha_reunion from usuario join invita on usuario.user_name=invita.user_name join reunion on invita.id_reunion=invita.id_reunion where invita.id_reunion=:id_reunion and reunion.id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_reunion', $id_reunion);

    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
  function finalizarReunionInvitados($conn){
    $id_reunion=$_REQUEST['id_reunion'];
    $user_name=$_SESSION['user_name'];
    $correo=$_REQUEST['correo'];
    $fecha_reunion=$_REQUEST['fecha_reunion'];
    $hoy=date("Y-m-d");
    correoFinalizarReunion($user_name,$fecha_reunion,$correo,$hoy);
    $sql="update reunion set aprobada=:aprobada, fecha_aprobada=:fecha_aprobada where id_reunion=:id_reunion;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':aprobada', 't');
    $stmt->bindValue(':fecha_aprobada', $hoy);
    $stmt->bindValue(':id_reunion', $id_reunion);
    $res = ejecutarSQL($stmt);
    echo json_encode(array("success"=>$res["success"], "msg"=>$res["msg"], "data"=>$res["data"]));
  }
?>
