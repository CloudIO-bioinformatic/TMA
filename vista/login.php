<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Iniciar Sesión</title>
	<!-- IMPORTAMOS LOS ESTILOS DEL FRAMEWORK DE BOOTSTRAP -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="icono" />



	<p style="position:relative;margin-top:0px;" align="left"><a  target="_blank" href="http://icb.utalca.cl/">ICB Web</a>/<a  target="_blank" href="http://lms.educandus.cl/">Educandus</a>
		/<a  target="_blank" href="http://www.utalca.cl/link.cgi/#/link.cgi/">UTAL</a>/<a  target="_blank" href="../Manual-de-usuario-reuniones.pdf">Help</a><p>

	<div class="row">
	 <img style="position:static;margin-top:-40px;" src="banner.jpeg" class="col-xs-12 col-sm-12 col-md-12 offset-0">
	</div>

	<section class="row justify-content-center">
		<section class="col-12 col-sm-6 col-md-3">
			<section class="container" style="margin-top:30px; border-radius: 10px; padding:30px; box-shadow: 0px 0px 10px 0px;" >
				<h1 align=center span style="color:#0080FF" ><b>Login</b></h1>
					<form action="" name="f1" method="post">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" id="user_name" name="user_name" class="form-control">
						</div><br/>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" id="contrasena" name="contrasena" class="form-control">
						</div><br/>
						<div class="container" align="center">
							<button  type="button" class="btn btn-primary" id="Iniciar">Ingresar</button>
						</div>
					</form>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="mensaje"></div>
			</section>
		</section>
	</section>


	<br><br><br><br>
	<footer align="center" class="footer-distributed">
				<div class="container">
			<div class="footer-right">
				<div class="row">
						<p>2018 UNIVERSIDAD DE TALCA | 2 NORTE 685 TALCA - CHILE | TELÉFONO (56-71) 200200</p>
					<div class="col-md-3">

						<a href="http://maps.utalca.cl" target="_blank"><img src="comollegar.png" height="30" ></a>
					</div>
				</div>

			</div>

		</div>	</footer>

<!-- IMPORTAMOS LOS ARCHIVOS JAVASCRIPT -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/login.js"></script>
</body>
</html>
