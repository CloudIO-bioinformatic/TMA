<?php
	require_once("../lib/comun.php");
	$mensajeOk=false;
	$mensajeError='El sistema no se encuentra disponible';
	$conexion=conectarBD();
	if(isset($_POST['user_name'],$_POST['contrasena'])):
		if($_POST['user_name']!=""):
			if($_POST['contrasena']!=""):
				$user_name=$_POST['user_name'];
				$contrasena=$_POST['contrasena'];
				$clave_encriptada=encriptar($contrasena);
				$consulta=$conexion->prepare("Select * from usuario where user_name=:user_name and contrasena=:contrasena");
				//para poder hacer la consulta
				$consulta->bindValue(':user_name', $user_name);
				$consulta->bindValue(':contrasena', $clave_encriptada);
				//ejecutar la consulta
				$consulta->execute();
				//extraer los datos a variables
				foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
					$director = $row['director'];
					$admin = $row['admin'];
					$secretario = $row['secretario'];
					$nombres = $row['nombres'];
					$apellidos = $row['apellidos'];
					$correo = $row['correo'];
				}
				if($nombres):
					$mensajeOk=true;
					session_start();
					//datos en general
					//$_SESSION['existe']=1;
					if($director==true){$_SESSION['director']='t';}else{$_SESSION['director']='f';}
					if($admin==true){$_SESSION['admin']='t';}else{$_SESSION['admin']='f';}
					if($secretario==true){$_SESSION['secretario']='t';}else{$_SESSION['secretario']='f';}
					$_SESSION['nombres']=$nombres;
					$_SESSION['apellidos']=$apellidos;
					$_SESSION['correo']=$correo;
					$_SESSION['user_name']=$user_name;
					$_SESSION['existe']='t';
					$mensajeError='Se ha iniciado correctamente la sesión.';
				else:
					$mensajeError='Usuario o contraseña incorrecta.';
				endif;
			else:
				$mensajeError='Contraseña incorrecta.';
			endif;
		else:
			$mensajeError='Usuario no existe.';
		endif;
	else:
		$mensajeError='Todos los datos son requeridos.';
	endif;
	$salidaJson=array('respuesta' => $mensajeOk, 'mensaje' =>$mensajeError, 'director' => $director, 'admin' => $admin, 'secretario'=> $secretario, 'nombres' => $nombres);
	echo json_encode($salidaJson);
?>
