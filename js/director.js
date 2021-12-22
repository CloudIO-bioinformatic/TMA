$(function() {
  $("#container-reunion").show();
  obtenerReuniones();
});

function reunion(){
  $("#container-reunion").show();
  obtenerReuniones();
}
function asistencia(){
  $("#container-asistencia").show();
  obtenerAsistencia();
}

function director(){
  $("#container-es").hide();
}

function contrasena(){
  $("#container-profesores").hide();
  $("#container-asistencia").hide();
  $("#container-reunion").hide();
  $("#container-contrasena").show();
  document.getElementById("form-cambioContrasena").reset();
}

function perfil(){
  $("#container-profesores").hide();
  $("#container-asistencia").hide();
  $("#container-reunion").hide();
  $("#container-contrasena").hide();
  $("#container-perfil").show();
  document.getElementById("form-cambioPerfil").reset();
  //ya tengo user_name con $_SESSION, asi que ire a pedir sus datos.
  $.post("../model/director.php?accion=8", function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
        if(response.data!=''){
          $.each(response.data, function(index, value) {
            if ($("input[name='nombres']").length&&$("input[name='apellidos']").length&&$("input[name='correo']").length&&$("input[name='celular']").length&&value) {
              $("input[name='nombres']").val(response.data[index]['nombres']);
              $("input[name='apellidos']").val(response.data[index]['apellidos']);
              $("input[name='correo']").val(response.data[index]['correo']);
              $("input[name='celular']").val(response.data[index]['celular']);
            }else{}
          });

        }else{}
    }else {}
   }, 'json');
}

function obtenerReuniones() {

  var table = $('#dataTable_reunion').dataTable({
    "columnDefs": [
      {"title": "Secretario", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
      {"title": "Fecha creación", "targets": 1, "orderable": false, "className": "dt-body-left","visible": true},
      {"title": "Fecha reunión", "targets": 2, "orderable": false, "className": "dt-body-left"},
      {"title": "Aprobación", "targets": 3, "orderable": false, "className": "dt-body-left"},
      {"title": "Fecha aprobación", "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
      {"title": "Ver temas", "targets": 5, "orderable": false, "className": "dt-body-left","visible": true},
    ],
    "searching": true,
    "search": {
      "regex": true,
      "smart": true
    },
    "scrollX": false,
    "order": [[1, "desc"]],
    "bDestroy": true,
    "deferRender": true,
    "language": {
      "url": "../language/es.txt"
    },
    "pageLength": 10,
    "bPaginate": false,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "bAutoWidth": false
  });

  table.fnClearTable();

  $.ajax({
    url: '../model/director.php',
    data: {accion: 1},
    type: 'POST',
    dataType: 'json',
    async: true,
    success: function(response) {
      if (response.success) {
        var data = response.data;
        var no_aprobada="No aprobada";
        var si_aprobada="Aprobada";
        for(var i = 0; i < data.length; i++) {
          if(data[i]["aprobada"]==false){
            var aprobacion='Sin aprobación';
          }else{
            var aprobacion='Aprobada';
          }
          table.fnAddData([
            data[i]["usu_user_name"],
            data[i]["fecha_creacion"],
            data[i]["fecha_reunion"],
            aprobacion,
            data[i]["fecha_aprobada"],
            "<button type='button' class='btn btn-info btn-sm' onclick='verReuniones(\"" + data[i]["id_reunion"] + "\");' title='Editar'>"+
            "VER</button>&nbsp;"
          ]);
        }
      } else {
        swal('Error', response.msg[2], 'error');
      }
    }, error: function(jqXHR, textStatus, errorThrown ) {
      swal('Error', textStatus + " " + errorThrown, 'error');
    }
  });
}

function  verReuniones(id_reunion){
  //console.log("id reunion: "+id_reunion);
  var d='';
  var fecha='';
  $.post("../model/director.php?accion=2", {id_reunion: id_reunion}, function(response) {

    if (response.success) {

      $.each(response.data, function(index, value) {
        fecha=response.data[index]['fecha_creacion'];
        d+='<h3>Tema '+(index+1)+"</h3><h6></h6><br><div style='padding-left:25px;'>"+response.data[index]['descripcion']+'</div><br><br>';
      });
      $("#modal-body-reunion").append(d);

      if(response.data.length!='0'){
      $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha);
      }else{
        $("#titulo-modal-reunion").html("Esta reunión no tiene temas...");
      }

      $("#modal-reunion").modal("show");
    } else {
      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
  $("#modal-body-reunion").html("");
}



function obtenerAsistencia(){
  var table = $('#dataTable_asistencia').dataTable({
    "columnDefs": [
      {"title": "Reunión", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
      {"title": "Asistencia", "targets": 1, "orderable": false, "className": "dt-body-left", "visible": true},
      {"title": "Ver temas", "targets": 2, "orderable": false, "className": "dt-body-left","visible": true},
    ],
    "searching": true,
    "search": {
      "regex": true,
      "smart": true
    },
    "scrollX": false,
    "order": [[1, "desc"]],
    "bDestroy": true,
    "deferRender": true,
    "language": {
      "url": "../language/es.txt"
    },
    "pageLength": 10,
    "bPaginate": false,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "bAutoWidth": false
  });

  table.fnClearTable();

  $.ajax({
    url: '../model/director.php',
    data: {accion: 3},
    type: 'POST',
    dataType: 'json',
    async: true,
    success: function(response) {
      if (response.success) {
        var data = response.data;
        //console.log(response.data);
        for(var i = 0; i < data.length; i++) {
          if(data[i]["asiste"]==false){
            var asistencia='No asiste';
          }else{
            var asistencia='Asiste';
          }


          table.fnAddData([
            data[i]["fecha_creacion"],
            asistencia,
            "<button type='button' class='btn btn-info btn-sm' onclick='verReuniones(\"" + data[i]["id_reunion"] + "\");' title='Editar'>"+
            "VER</button>&nbsp;"
          ]);
        }
      } else {
        swal('Error', response.msg[2], 'error');
      }
    }, error: function(jqXHR, textStatus, errorThrown ) {
      swal('Error', textStatus + " " + errorThrown, 'error');
    }
  });
}


function cambiarContrasena() {
  var form = $("#form-cambioContrasena").serialize();
  //pide contrasena antigua
  $.post("../model/director.php?accion=6", form, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
        if(response.data!=''){
          //cambia la contrasena
          $.post("../model/director.php?accion=7", form, function(response) {
            if (response.success) {
              swal('Cambio de clave!', 'Se cambio la contraseña de forma correcta.', 'success');
              contrasena();
            } else {
              swal('Contraseñas distintas', 'Contraseñas ingresadas no son iguales', 'error');
              document.getElementById("form-cambioContrasena").reset();
            }
          }, 'json');
        }else{
          swal('Contraseña actual incorrecta', 'Ingrese correctamente su contraseña actual', 'error');
          document.getElementById("form-cambioContrasena").reset();
        }
    }else {
        swal('Error', 'No se cambio la contraseña, vuelva a intentarlo.', 'error');
        document.getElementById("form-cambioContrasena").reset();
          }
   }, 'json');

}


function cambiarPerfil() {
  //console.log("entro al cambiarPerfil");
  val = validarFormularioPerfil();
  //console.log(val);
  if (val == false) return false;
  var form = $("#form-cambioPerfil").serialize();
  //console.log("form: "+form);
   //cambios en el perfil
   $.post("../model/director.php?accion=9", form, function(response) {
    // console.log("response: "+response.data);
     if (response.success) {
       swal('Cambios de Perfil!', 'Se hicieron cambios en el perfil de forma correcta.', 'success');
       perfil();
     } else {
       //swal('Contraseñas distintas', 'Contraseñas ingresadas no son iguales', 'error');
       //document.getElementById("form-cambioContrasena").reset();
     }
   }, 'json');
}



/* valida que los datos obligatorios tengan algún valor */
function validarFormularioPerfil () {
  if ($('#nombres').val().trim().length==0) {
    swal('Atención', "Los Nombres son requeridos", 'info');
    return false;
  }
  if ($('#apellidos').val().trim().length==0) {
    swal('Atención', "Los Apellidos son requeridos", 'info');
    return false;
  }
  if ($('#correo').val().trim().length==0) {
    swal('Atención', "El Correo es requerido", 'info');
    return false;
  }
  if ($('#celular').val().trim().length==0) {
    swal('Atención', "El teléfono es requerido", 'info');
    return false;
  }
  return true;
}
