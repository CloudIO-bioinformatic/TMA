<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
//use PHPMailer\PHPMailer;
//use PHPMailer\Exception;
//require("PHPMailer/PHPMailer.php");
//require("PHPMailer/Exception.php");
//require("PHPMailer/SMTP.php");
//Load Composer's autoloader
//require 'vendor/autoload.php';
require("PHPMailer/PHPMailerAutoload.php");

function conectarBD () {
  $host = "localhost";
  $port = "5432";
  $db = "reunion";
  $user = "reunion";
  $password = "1234";

  // conectar a la base de datos
  try {
    $conn = new PDO('pgsql:host='.$host.';port='.$port.';dbname='.$db.';user='.$user.';password='.$password);
    return $conn;

  } catch (PDOException $e) {
    //echo $e->getMessage();

    return false;
  }

}

function ejecutarSQL ($stmt) {
  $res = array();
  $res["success"] = false;
  $res["msg"] = "Error SQL";
  $res["data"] = null;

  try {
    if ($stmt->execute()) {
      $res["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $res["msg"] = "éxito";
      $res["success"] = true;
    } else {
      //http://php.net/manual/en/pdostatement.errorinfo.php
      $res["msg"] = $stmt->errorInfo();
      //$res["msg"] = "Error SQL";
    }

  } catch (PDOException $e) {
    $res["msg"] = $e->getMessage();
  }

  return $res;
}

function encriptar($string){
    $key = 'MIKEY';
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted;
}

function desencriptar($string){
    $key = 'MIKEY';
    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))),"\0");
    return $decrypted;
}

function correoNuevoProfesor($user_name,$nombres,$apellidos,$correo,$celular,$contrasena){

  //datos del profesor
  $user_name=$user_name;
  $nombres=$nombres;
  $apellidos=$apellidos;
  $correo=$correo;
  $celular=$celular;
  $contrasena=$contrasena;
  //se junta todo
  $body = "<h3>¡Bienvenido, usted ha sido registrado en la página Reuniones de la Escuela de Ingeniería Civil en Bioinformática, ahora puede acceder como profesor!.</h3>"
  ."Sus datos son los siguientes:<br>"
  ."Username: " . $user_name."<br>"
  ."Nombres: " . $nombres."<br>"
  ."Apellidos: " . $apellidos."<br>"
  ."Correo: " . $correo."<br>"
  ."Teléfono: " . $celular."<br>"
  ."Contraseña: " . $contrasena."<br><br>"
  ."<h3>Se recomienda que vaya a la página <a href='pagina.php'>pagina_reuniones_icb</a> y cambie su contraseña de forma inmediata, debido a que esta se genera de forma automática.</h3>"
  ."<h2>No responda este mensaje, es un mensaje automático y no es necesario responder.</h2>";
  //Crear instancia
  $mail = new PHPMailer(true);
  $mail -> CharSet = "UTF-8";
  //definir que usaremos SMTP y las configuraciones por defecto
  $mail->isSMTP();
  $mail->isHTML(true);
  //$mail->Host = 'smtp.office365.com';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = '587';
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth   = true;
  //datos para iniciar sesion smtp
	$mail->Username   = 'no.reply.reunion.icb@gmail.com';
	$mail->Password   = 'reunionesicb12';
  //datos de quien lo envia, en este caso un BOT de las practicas
  $mail->setFrom('no-reply-reuniones-icb@outlook.com', 'Reuniones Ing. Civil en Bioinformática');
  $mail->addAddress($correo, 'Profesor');
  //Definimos el tema del email
  $mail->Subject = 'Reuniones Ing. Civil en Bioinformática';
  $mail->Body  = $body;
  //La funcion altbody es para cuando se envia texto plano en caso de que no acepte un html maqueteado;
  $mail->AltBody =$body;
  //Enviamos el correo
  $mail->send();
  }


  function correoInvitacion($user_name_invitado,$user_name,$nombres,$apellidos,$fecha_reunion,$correo){

    //datos del profesor
    $user_name_invitado=$user_name_invitado;
    //datos director
    $user_name=$user_name;
    $nombres=$nombres;
    $apellidos=$apellidos;
    $fecha_reunion=$fecha_reunion;
    //se junta todo
    $body = "<h3>Hola ". $user_name_invitado ." , usted ha sido invitado por ". $nombres . " " . $apellidos . " a una reunión de profesores en la Escuela de Ingeniería Civil en Bioinformática, que se realizará en la fecha ".$fecha_reunion.".</h3>"
    ."<h3>Si desea mas información, puede enviar un correo a " . $user_name."@utalca.cl con sus dudas.</h3>"
    ."<h2>No responda este mensaje, es un mensaje automático y no es necesario responder.</h2>";
    //Crear instancia
    $mail = new PHPMailer(true);
    $mail -> CharSet = "UTF-8";
    //definir que usaremos SMTP y las configuraciones por defecto
    $mail->isSMTP();
    $mail->isHTML(true);
    //$mail->Host = 'smtp.office365.com';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth   = true;
    //datos para iniciar sesion smtp
  	$mail->Username   = 'no.reply.reunion.icb@gmail.com';
  	$mail->Password   = 'reunionesicb12';
    //datos de quien lo envia, en este caso un BOT de las practicas
    $mail->setFrom('no-reply-reuniones-icb@outlook.com', 'Reuniones Ing. Civil en Bioinformática');
    $mail->addAddress($correo, 'Profesor');
    //Definimos el tema del email
    $mail->Subject = 'Reuniones Ing. Civil en Bioinformática';
    $mail->Body  = $body;
    //La funcion altbody es para cuando se envia texto plano en caso de que no acepte un html maqueteado;
    $mail->AltBody =$body;
    //Enviamos el correo
    $mail->send();
    }

    function correoFinalizarReunion($user_name,$fecha_reunion,$correo,$hoy){

      //datos del profesor
      $user_name_invitado=$user_name_invitado;
      //datos director
      $user_name=$user_name;
      $nombres=$nombres;
      $apellidos=$apellidos;
      $fecha_reunion=$fecha_reunion;
      //se junta todo
      $body = "<h3>Se le informa que hoy ". $hoy ." la reunión llevada acabo en la fecha ". $fecha_reunion . " se ha concluido, puede volver a ver los temas que se trataron en esa reunión en su historial.</h3>"
      ."<h3>Si desea mas información, puede enviar un correo a " . $user_name."@utalca.cl con sus dudas.</h3>"
      ."<h3>No responda este mensaje, es un mensaje automático y no es necesario responder.</h3>";
      //Crear instancia
      $mail = new PHPMailer(true);
      $mail -> CharSet = "UTF-8";
      //definir que usaremos SMTP y las configuraciones por defecto
      $mail->isSMTP();
      $mail->isHTML(true);
      //$mail->Host = 'smtp.office365.com';
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = '587';
      $mail->SMTPSecure = 'tls';
      $mail->SMTPAuth   = true;
      //datos para iniciar sesion smtp
    	$mail->Username   = 'no.reply.reunion.icb@gmail.com';
    	$mail->Password   = 'reunionesicb12';
      //datos de quien lo envia, en este caso un BOT de las practicas
      $mail->setFrom('no-reply-reuniones-icb@outlook.com', 'Reuniones Ing. Civil en Bioinformática');
      $mail->addAddress($correo, 'Profesor');
      //Definimos el tema del email
      $mail->Subject = 'Reuniones Ing. Civil en Bioinformática';
      $mail->Body  = $body;
      //La funcion altbody es para cuando se envia texto plano en caso de que no acepte un html maqueteado;
      $mail->AltBody =$body;
      //Enviamos el correo
      $mail->send();
    }



?>
