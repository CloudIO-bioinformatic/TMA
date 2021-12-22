// Shorthand for $( document ).ready()
$(function() {
  $("#container-profesores").show();
  obtenerProfesores();
});

function profesores(){
  $("#container-profesores").show();
  obtenerProfesores();
}

function director(){
  $("#container-profesores").hide();
  $("#container-director").show();
  obtenerDirector();
}
function admin(){
  $("#container-profesores").hide();
  $("#container-director").hide();
  $("#container-admin").show();
  obtenerAdmin();
}
/*function contrasena(){
  $("#container-profesores").hide();
  $("#container-director").hide();
  $("#container-contrasena").show();
  document.getElementById("form-cambioContrasena").reset();
}*/

function obtenerProfesores() {
  var accion_agregar = "<button type='button' class='btn btn-success btn-block' " +
                        "onclick='agregarProfesores();' title='Agregar'><i class='fas fa-plus-square'></i></button>";

  var table = $('#dataTable_profesor').dataTable({
    "columnDefs": [
      {"title": "Username", "targets": 0, "orderable": true, "className": "dt-body-left", "visible": true},
      {"title": "Nombres", "targets": 1, "orderable": true, "className": "dt-body-left","visible": true},
      {"title": "Apellidos", "targets": 2, "orderable": true, "className": "dt-body-left"},
      {"title": "Correo", "targets": 3, "orderable": false, "className": "dt-body-left"},
      {"title": "Celular", "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
      {"title": "Director", "targets": 5, "orderable": true, "className": "dt-body-left","visible": true},
      {"title": "Secretario", "targets": 6, "orderable": true, "className": "dt-body-left"},
      {"title": accion_agregar, "targets": 7, "orderable": false, "className": "dt-nowrap dt-right"},
    ],
    "searching": true,
    "search": {
      "regex": true,
      "smart": true
    },
    "scrollX": false,
    "order": [[1, "asc"]],
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
    url: '../model/admin.php',
    data: {accion: 1},
    type: 'POST',
    dataType: 'json',
    async: true,
    success: function(response) {
      if (response.success) {
        var data = response.data;

        for(var i = 0; i < data.length; i++) {
          table.fnAddData([
            data[i]["user_name"],
            data[i]["nombres"],
            data[i]["apellidos"],
            data[i]["correo"],
            data[i]["celular"],
            data[i]["director"],
            data[i]["secretario"],
            "<button type='button' class='btn btn-warning btn-sm' onclick='editarProfesores(\"" + data[i]["user_name"] + "\");' title='Editar'>"+
            "<i class='far fa-edit'></i></button>&nbsp;" +
            "<button type='button' class='btn btn-danger btn-sm' onclick='eliminarProfesores(\"" + data[i]["user_name"] + "\");' title='Eliminar'>"+
            "<i class='fas fa-trash-alt'></i></button>&nbsp;&nbsp;"+
            "<button type='button' class='btn btn-info btn-sm' onclick='reestablecerContrasena(\"" + data[i]["user_name"] + "\");' title='Reestablecer contraseña'>"+
            "<i class='fas fa-sync-alt'></i></button>"
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

function reestablecerContrasena(user_name){
  swal({
    title: "¿Estás seguro de esta acción?",
    text: "Una vez reestablecida la contraseña, no se podrá recuperar!",
    icon: "warning",
    buttons: true,
    dangerMode: false,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.post("../model/admin.php?accion=12", {user_name: user_name}, function(response) {
        if (response.success) {
          swal('Contraseña Reestablecida', 'Se reestablecio la contraseña de forma correcta', 'success');
        } else {
          swal('Error', response.msg[2], 'error');
        }
      }, 'json');
    } else {
      swal("Los datos están seguros!");
    }
  });


}


/* levanta el modal para ingresar datos */
function agregarProfesores() {
  $("#titulo-modal-profesor").html("Agregar un nuevo profesor.");
  document.getElementById("form-profesor").reset();
  $("#btn-aceptar-profesor").attr("onClick", "agregarBDProfesores()");
  $("#modal-profesor").modal("show");
}

/* agrega un registro a la base de datos */
function agregarBDProfesores() {
  val = validarFormularioProfesores();
  if (val == false) return false;

  /* convierte el formulario en un string de parámetros */
  var form = $("#form-profesor").serialize();

  $.ajax({
    dataType: 'json',
    async: true,
    url: '../model/admin.php?accion=2',
    data: form,
    success: function (response) {
      if (response.success) {
        $("#modal-profesor").modal("hide");
        swal('Inserción Completa!', '', 'success');
        obtenerProfesores();

      } else {
        swal('Error', 'Ya existe ese Username, por favor asignar uno diferente', 'error');
      }
    }, error: function (e) {
      swal('Error', e.responseText, 'error');
    }
  });
}

/* obtiene datos de un profesor y los muestra en el modal */
function editarProfesores(user_name) {
  document.getElementById("form-profesor-editar").reset();
  $.post("../model/admin.php?accion=3", {user_name: user_name}, function(response) {
  	//console.log("response=",response.success);
    var user_name_old=user_name;
    if (response.success) {
      $.each(response.data, function(index, value) {
        if ($("input[name="+index+"]").length && value) {
          $("input[name="+index+"]").val(value);
        } else if ($("select[name="+index+"]").length && value){
          $("select[name="+index+"]").val(value);
        }
      });
      $("#titulo-modal-profesor-editar").html("Editar informacion de profesor.");
      $("#btn-aceptar-profesor-editar").attr("onClick", "editarBDProfesores(\"" + user_name + "\",\"" + user_name_old + "\")");
      $("#modal-profesor-editar").modal("show");
    } else {
      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
}

/* actualiza los datos en la base de datos */
function editarBDProfesores(user_name, user_name_old) {
  val = validarFormularioProfesores();
  if (val == false) return false;
  var form = $("#form-profesor-editar").serialize();
  //console.log("form",form);
  $.post("../model/admin.php?accion=4&user_name=" + user_name+"&user_name_old="+user_name_old, form, function(response) {
  	//console.log("response=",response.success);
    if (response.success) {
      $("#modal-profesor-editar").modal("hide");
      swal('Edición Completa!', 'Se editó profesor de forma correcta.', 'success');
      obtenerProfesores();
    } else {
      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
}

/* elimina un registro de la base de datos */
function eliminarProfesores(user_name) {
  swal({
    title: "¿Estás seguro de esta acción?",
    text: "Una vez eliminado, no se podrá recuperar!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      //###### ###################################ANTES ELIMINAR FOREIGNKEY DE TABLA INVITA Y VOTACION Y REUNIOn
      //limpiando invita
      $.post("../model/admin.php?accion=13", {user_name: user_name}, function(response) {
        if (response.success) {
          //limpiando votacion
          $.post("../model/admin.php?accion=14", {user_name: user_name}, function(response) {
            if (response.success) {
              //obtener director
              $.post("../model/admin.php?accion=6", function(response) {
                if (response.success) {
                  var user_name_director=response.data[0]['user_name'];
                  //limpiar reunion, cambiando usu_user_name por el user_name del director
                  $.post("../model/admin.php?accion=15", {user_name: user_name, user_name_director: user_name_director }, function(response) {
                    if (response.success) {
                      $.ajax({
                        dataType: 'json',
                        async: true,
                        url: '../model/admin.php',
                        data: {accion: 5, user_name: user_name},
                        success: function (response) {
                          if (response.success) {
                            swal("Se ha eliminado un profesor de forma correcta", {
                              icon: "success",
                            });
                              obtenerProfesores();
                          } else {
                            swal('Error', 'error 1'+response.msg[2], 'error');
                          }
                        }, error: function (e) {
                          swal('Error', 'error 2'+e.responseText, 'error');
                        }
                      });
                    } else {
                      swal('Error', 'error 3'+response.msg[2], 'error');
                    }
                  }, 'json');
                } else {
                  swal('Error', 'error 3'+response.msg[2], 'error');
                }
              }, 'json');
            } else {
              swal('Error', 'error 3'+response.msg[2], 'error');
            }
          }, 'json');
        } else {
          swal('Error', 'error 4 '+response.msg[2], 'error');
        }
      }, 'json');

    } else {
      swal("Los datos están seguros!");
    }
  });
}



function obtenerAdmin(){

  var d='';
  $.post("../model/admin.php?accion=16", {}, function(response) {
    if (response.success!=undefined) {
      if(response.data!=''){
        d+="<h4>Información del administrador: </h4><br>";
        d+="Username: "+response.data[0]['user_name']+"<br>";
        d+="Nombres: "+response.data[0]['nombres']+"<br>";
        d+="Apellidos: "+response.data[0]['apellidos']+"<br>";
        d+="Correo: "+response.data[0]['correo']+"<br>";
        d+="Teléfono: "+response.data[0]['celular']+"<br>";
        d+="<button type='button' class='btn btn-warning btn-sm' onclick='mostrarposibleAdmin(\"" + response.data[0]["user_name"] + "\");' title='Editar'>"+
        "Ceder Admin</button>&nbsp;";

        $("#panel-body-admin").append(d);
      }else{

      }
    } else {

      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
  $("#panel-body-admin").html("");
}

function mostrarposibleAdmin(user_name){
  //console.log("entramos");
  //console.log("viene el old: "+user_name);
  var table2 = $('#dataTable_posibleadmin').dataTable({
    "columnDefs": [
      {"title": "Username", "targets": 0, "orderable": true, "className": "dt-body-left", "visible": true},
      {"title": "Nombres", "targets": 1, "orderable": true, "className": "dt-body-left","visible": true},
      {"title": "Apellidos", "targets": 2, "orderable": true, "className": "dt-body-left"},
      {"title": "Correo", "targets": 3, "orderable": false, "className": "dt-body-left"},
      {"title": "Celular", "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
      {"title": "Opción", "targets": 5, "orderable": false, "className": "dt-nowrap dt-right"},
    ],
    "searching": true,
    "search": {
      "regex": true,
      "smart": true
    },
    "scrollX": false,
    "order": [[1, "asc"]],
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

  table2.fnClearTable();

  $.ajax({
    url: '../model/admin.php',
    data: {accion: 17},
    type: 'POST',
    dataType: 'json',
    async: true,
    success: function(response) {
      if (response.success) {
        var data = response.data;
        for(var i = 0; i < data.length; i++) {
          table2.fnAddData([
            data[i]["user_name"],
            data[i]["nombres"],
            data[i]["apellidos"],
            data[i]["correo"],
            data[i]["celular"],
            "<button type='button' class='btn btn-dark btn-sm' onclick='cambioAdmin(\"" + data[i]["user_name"] + "\",\"" + user_name + "\");' title='Editar'>Asignar</button>&nbsp;"
          ]);
        }
        $("#titulo-modal-admin").html("Asignar un nuevo administrador");
        $("#modal-admin").modal("show");
      } else {
        swal('Error', response.msg[2], 'error');
      }
    }, error: function(jqXHR, textStatus, errorThrown ) {
      swal('Error', textStatus + " " + errorThrown, 'error');
    }
  });
}

function cambioAdmin(user_name,user_name_old){
  //console.log("nuevo: "+user_name);
  //console.log("viejo: "+user_name_old);
  if(user_name_old!=''){
      swal({
        title: "¿Estás seguro de esta acción?",
        text: "Perderás tu perfil de administrador!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          //editar columna director cambiar t por f
          $.post("../model/admin.php?accion=18&user_name=" + user_name_old, function(response) {
            if (response.success) {
              //console.log("se cambio t por f en director: "+user_name_old+" exitosamente");
                      //ahora cambiamos f por t al nuevo director
                    $.post("../model/admin.php?accion=19&user_name=" + user_name, function(response) {
                      if (response.success) {
                        //console.log("se cambio f por t en nuevo director: "+user_name+" exitosamente");
                        swal('Aceptado', 'Se ha asignado un nuevo Director de forma correcta!!.', 'success');
                        $("#modal-admin").modal("hide");
                        obtenerAdmin();

                      } else {
                        swal('Error', response.msg[2], 'error');
                      }
                    }, 'json');
            } else {
              swal('Error', response.msg[2], 'error');
            }
          }, 'json');

        } else {
          swal("Los datos están seguros!");
        }
      });
 }else{
   //ahora cambiamos f por t al nuevo director
 $.post("../model/admin.php?accion=9&user_name=" + user_name, function(response) {
   if (response.success) {
     //console.log("se cambio f por t en nuevo director: "+user_name+" exitosamente");
     swal('Aceptado', 'Se ha asignado un nuevo Director de forma correcta!!.', 'success');
     $("#modal-admin").modal("hide");
     obtenerAdmin();

   } else {
     swal('Error', response.msg[2], 'error');
   }
 }, 'json');
 }
}

function obtenerDirector(){

  var d='';
  $.post("../model/admin.php?accion=6", {}, function(response) {
    if (response.success!=undefined) {
      if(response.data!=''){
        d+="<h4>Información del director: </h4><br>";
        d+="Username: "+response.data[0]['user_name']+"<br>";
        d+="Nombres: "+response.data[0]['nombres']+"<br>";
        d+="Apellidos: "+response.data[0]['apellidos']+"<br>";
        d+="Correo: "+response.data[0]['correo']+"<br>";
        d+="Teléfono: "+response.data[0]['celular']+"<br>";
        d+="<button type='button' class='btn btn-warning btn-sm' onclick='mostrarposibleDirector(\"" + response.data[0]["user_name"] + "\");' title='Editar'>"+
        "Cambiar de Director</button>&nbsp;";
        d+="<button type='button' class='btn btn-danger btn-sm' onclick='eliminarDirector(\"" + response.data[0]["user_name"] + "\");' title='Editar'>"+
        "<i class='fas fa-trash-alt'></i></button>&nbsp;";
        $("#panel-body-director").append(d);
      }else{
        var user_name='';
        d+="<h3>No existe director actualmente.</h3><button type='button' class='btn btn-success btn-sm' onclick='mostrarposibleDirector(\"" + user_name + "\");' title='nuevo director'>Asignar un Director</button>&nbsp;";
        $("#panel-body-director").append(d);
      }
    } else {

      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
  $("#panel-body-director").html("");
}


function mostrarposibleDirector(user_name){
  //console.log("entramos");
  //console.log("viene el old: "+user_name);
  var table2 = $('#dataTable_posibledirector').dataTable({
    "columnDefs": [
      {"title": "Username", "targets": 0, "orderable": true, "className": "dt-body-left", "visible": true},
      {"title": "Nombres", "targets": 1, "orderable": true, "className": "dt-body-left","visible": true},
      {"title": "Apellidos", "targets": 2, "orderable": true, "className": "dt-body-left"},
      {"title": "Correo", "targets": 3, "orderable": false, "className": "dt-body-left"},
      {"title": "Celular", "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
      {"title": "Opción", "targets": 5, "orderable": false, "className": "dt-nowrap dt-right"},
    ],
    "searching": true,
    "search": {
      "regex": true,
      "smart": true
    },
    "scrollX": false,
    "order": [[1, "asc"]],
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

  table2.fnClearTable();

  $.ajax({
    url: '../model/admin.php',
    data: {accion: 7},
    type: 'POST',
    dataType: 'json',
    async: true,
    success: function(response) {
      if (response.success) {
        var data = response.data;
        for(var i = 0; i < data.length; i++) {
          table2.fnAddData([
            data[i]["user_name"],
            data[i]["nombres"],
            data[i]["apellidos"],
            data[i]["correo"],
            data[i]["celular"],
            "<button type='button' class='btn btn-dark btn-sm' onclick='cambioDirector(\"" + data[i]["user_name"] + "\",\"" + user_name + "\");' title='Editar'>Asignar</button>&nbsp;"
          ]);
        }
        $("#titulo-modal-director").html("Asignar un nuevo director");
        $("#modal-director").modal("show");
      } else {
        swal('Error', response.msg[2], 'error');
      }
    }, error: function(jqXHR, textStatus, errorThrown ) {
      swal('Error', textStatus + " " + errorThrown, 'error');
    }
  });
}


function cambioDirector(user_name,user_name_old){
  //console.log("nuevo: "+user_name);
  //console.log("viejo: "+user_name_old);
  if(user_name_old!=''){
      swal({
        title: "¿Estás seguro de esta acción?",
        text: "Hará cambio de Director en el sistema!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          //editar columna director cambiar t por f
          $.post("../model/admin.php?accion=8&user_name=" + user_name_old, function(response) {
            if (response.success) {
              //console.log("se cambio t por f en director: "+user_name_old+" exitosamente");
                      //ahora cambiamos f por t al nuevo director
                    $.post("../model/admin.php?accion=9&user_name=" + user_name, function(response) {
                      if (response.success) {
                        //console.log("se cambio f por t en nuevo director: "+user_name+" exitosamente");
                        swal('Aceptado', 'Se ha asignado un nuevo Director de forma correcta!!.', 'success');
                        $("#modal-director").modal("hide");
                        obtenerDirector();

                      } else {
                        swal('Error', response.msg[2], 'error');
                      }
                    }, 'json');
            } else {
              swal('Error', response.msg[2], 'error');
            }
          }, 'json');

        } else {
          swal("Los datos están seguros!");
        }
      });
 }else{
   //ahora cambiamos f por t al nuevo director
 $.post("../model/admin.php?accion=9&user_name=" + user_name, function(response) {
   if (response.success) {
     //console.log("se cambio f por t en nuevo director: "+user_name+" exitosamente");
     swal('Aceptado', 'Se ha asignado un nuevo Director de forma correcta!!.', 'success');
     $("#modal-director").modal("hide");
     obtenerDirector();

   } else {
     swal('Error', response.msg[2], 'error');
   }
 }, 'json');
 }
}

function eliminarDirector(user_name){
  swal({
    title: "¿Estás seguro de esta acción?",
    text: "No habrá ningun Director en el sistema!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      //editar columna director cambiar t por f
      $.post("../model/admin.php?accion=8&user_name=" + user_name, function(response) {
        if (response.success) {
          //console.log("se cambio t por f en director: "+user_name+" exitosamente");
              obtenerDirector();
        } else {
          swal('Error', response.msg[2], 'error');
        }
      }, 'json');

    } else {
      swal("Los datos están seguros!");
    }
  });
}

/* valida que los datos obligatorios tengan algún valor */
function validarFormularioProfesores () {
  if ($('#user_name_profesores').val().trim().length==0) {
    swal('Atención', "El Username es requerido", 'info');
    return false;
  }
  if ($('#nombres_profesores').val().trim().length==0) {
    swal('Atención', "Los Nombres son requeridos", 'info');
    //console.log("aca en validarFormularioProfesores ");
    return false;
  }
  if ($('#apellidos_profesores').val().trim().length==0) {
    swal('Atención', "Los Apellidos son requeridos", 'info');
    return false;
  }
  if ($('#correo_profesores').val().trim().length==0) {
    swal('Atención', "El Correo es requerido", 'info');
    return false;
  }
  if ($('#celular_profesores').val().trim().length==0) {
    swal('Atención', "El teléfono es requerido", 'info');
    return false;
  }
  return true;
}

/*function cambiarContrasena() {
  var form = $("#form-cambioContrasena").serialize();
  //pide contrasena antigua
  $.post("../model/admin.php?accion=10", form, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
        if(response.data!=''){
          //cambia la contrasena
          $.post("../model/admin.php?accion=11", form, function(response) {
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

}*/
