$(document).ready(function(){
	$("#Iniciar").click(function(){
		var user_name=$('#user_name').val();
		var contrasena=$("#contrasena").val();
		//console.log(Usuario,Contrasena);
		$.ajax({
			type:"POST",
			dataType:'json',
			url:'../model/login.php',
			data:{user_name:user_name,contrasena:contrasena},
			success:function(response){
				//console.log(user_name,contrasena,response.director,response.admin, response.secretario, response.nombres);
				if(response.respuesta==true){

					$("#mensaje").html(response.mensaje);
					window.location='../vista/profesor.php';
				/*	if(response.director==true){
						$("#mensaje").html(response.mensaje);
						window.location='../vista/director.php';

					}else if(response.admin==true){
						$("#mensaje").html(response.mensaje);
						window.location='../vista/admin.php';
					}else{
							$("#mensaje").html(response.mensaje);

							window.location='../vista/profesor.php';
						}*/

				}else{
					$("#mensaje").html(response.mensaje);
				}
			},error:function(){
				alert('Error general en el sistema');
			}
		});
	});
});
