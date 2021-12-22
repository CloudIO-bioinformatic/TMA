$(function() {
  $("#container-reunion").show();
  obtenerReuniones();
});

function reunion(){
  $("#container-reunion").show();
  obtenerReuniones();
}
function reunion_historial(){
  $("#container-reunion-historial").show();
  obtenerReunionesHistorial();
}
function asistencia(){
  $("#container-asistencia").show();
  obtenerAsistencia();
}

function director(){
  $("#container-profesores").hide();
}

function contrasena(){
  $("#container-profesores").hide();
  $("#container-asistencia").hide();
  $("#container-reunion").hide();
  $("#container-contrasena").show();
  document.getElementById("form-cambioContrasena").reset();
}

function secretario(){
  $("#container-profesores").hide();
  $("#container-asignar-secretario").show();
  obtenerSecretario();
}



function obtenerReuniones() {
//saber perfil
var accion_agregar="";

  $.post("../model/profesor.php?accion=10", function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
        if(response.data[0]['director']==true){
        //console.log("es director");
        accion_agregar = "<button type='button' class='btn btn-success btn-block' " +
                              "onclick='nuevaReunion();' title='Agregar'><i class='fas fa-plus-square'></button>";

        var table = $('#dataTable_reunion').dataTable({
          "columnDefs": [
            {"title": "Secretario", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
            {"title": "Fecha creación", "targets": 1, "orderable": false, "className": "dt-body-left","visible": true},
            {"title": "Fecha reunión", "targets": 2, "orderable": false, "className": "dt-body-left"},
            {"title": "Hora reunión", "targets": 3, "orderable": false, "className": "dt-body-left"},
            {"title": accion_agregar, "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
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
          url: '../model/profesor.php',
          data: {accion: 32},
          type: 'POST',
          dataType: 'json',
          async: true,
          success: function(response) {
            if (response.success) {
              var data = response.data;

              for(var i = 0; i < data.length; i++) {

                table.fnAddData([
                  data[i]["usu_user_name"],
                  data[i]["fecha_creacion"],
                  data[i]["fecha_reunion"],
                  data[i]["hora_reunion"],
                  "<button type='button' class='btn btn-secondary btn-sm' onclick='verReuniones(\"" + data[i]["id_reunion"] + "\");' title='acuerdos'>"+
                  "<i class='fas fa-file-contract'></i></button>&nbsp;"+
                  "<button type='button' class='btn btn-warning btn-sm' onclick='editarReunion(\"" + data[i]["id_reunion"] + "\");' title='Editar'>"+
                  "<i class='far fa-edit'></i></button>&nbsp;"+
                  "<button type='button' class='btn btn-danger btn-sm' onclick='eliminarReunion(\"" + data[i]["id_reunion"] + "\");' title='eliminar'>"+
                  "<i class='fas fa-trash-alt'></i></button>&nbsp;"+
                  "<button type='button' class='btn btn-dark btn-sm' onclick='editarTemas(\"" + data[i]["id_reunion"] + "\");' title='ver temas'>"+
                  "<i class='fas fa-align-justify'></i></button>&nbsp;"+
                  "<button type='button' class='btn btn-primary btn-sm' onclick='invitadosReunion(\"" + data[i]["id_reunion"] + "\",\"" + data[i]["fecha_reunion"] + "\");' title='ver invitados'>"+
                  "<i class='fas fa-users'></i></button>&nbsp;"
                ]);
              }
            } else {
              swal('Error', response.msg[2], 'error');
            }
          }, error: function(jqXHR, textStatus, errorThrown ) {
            swal('Error', textStatus + " " + errorThrown, 'error');
          }
        });
      }else{//ELSE########################################################################################################
        //###############################################################################################################
        //pregntar si es secretario o no
        $.post("../model/profesor.php?accion=34", function(response) {
          if(response.data[0]['secretario']==true){
            accion_agregar = "Ver Temas";
            var table = $('#dataTable_reunion').dataTable({
              "columnDefs": [
                {"title": "Secretario", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
                {"title": "Fecha creación", "targets": 1, "orderable": false, "className": "dt-body-left","visible": true},
                {"title": "Fecha reunión", "targets": 2, "orderable": false, "className": "dt-body-left"},
                {"title": "hora reunión", "targets": 3, "orderable": false, "className": "dt-body-left"},
                {"title": accion_agregar, "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
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
              url: '../model/profesor.php',
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

                    table.fnAddData([
                      data[i]["usu_user_name"],
                      data[i]["fecha_creacion"],
                      data[i]["fecha_reunion"],
                      data[i]["hora_reunion"],
                      "<button type='button' class='btn btn-secondary btn-sm' onclick='verReuniones(\"" + data[i]["id_reunion"] + "\");' title='acuerdos'>"+
                      "<i class='fas fa-file-contract'></i></button>&nbsp;"+
                      "<button type='button' class='btn btn-info btn-sm' onclick='verReunionesSecretario(\"" + data[i]["id_reunion"] + "\");' title='comentar acta'>"+
                      "<i class='far fa-comments'></i></button>&nbsp;"+
                      "<button type='button' class='btn btn-dark btn-sm' onclick='pasarLista(\"" + data[i]["id_reunion"] + "\");' title='pasar lista'>"+
                      "<i class='fas fa-list-ol'></i></button>&nbsp;"
                    ]);
                  }
                } else {
                  swal('Error', response.msg[2], 'error');
                }
              }, error: function(jqXHR, textStatus, errorThrown ) {
                swal('Error', textStatus + " " + errorThrown, 'error');
              }
            });
          }else{
            accion_agregar = "Ver Temas";
            var table = $('#dataTable_reunion').dataTable({
              "columnDefs": [
                {"title": "Secretario", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
                {"title": "Fecha creación", "targets": 1, "orderable": false, "className": "dt-body-left","visible": true},
                {"title": "Fecha reunión", "targets": 2, "orderable": false, "className": "dt-body-left"},
                {"title": "hora reunión", "targets": 3, "orderable": false, "className": "dt-body-left"},
                {"title": accion_agregar, "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
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
              url: '../model/profesor.php',
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

                    table.fnAddData([
                      data[i]["usu_user_name"],
                      data[i]["fecha_creacion"],
                      data[i]["fecha_reunion"],
                      data[i]["hora_reunion"],
                      "<button type='button' class='btn btn-info btn-sm' onclick='verReuniones(\"" + data[i]["id_reunion"] + "\");' title='acuerdos'>"+
                      "<i class='fas fa-file-contract'></i></button>&nbsp;"
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
        }, 'json');


        }
    }else {}
   }, 'json');
}

function verReunionesSecretario(id_reunion){

  var d='';
  var fecha='';
  $.post("../model/profesor.php?accion=2", {id_reunion: id_reunion}, function(response) {
    if (response.success) {
      $.each(response.data, function(index, value) {
        //console.log("id_tema: "+response.data[index]['id_tema']);
        fecha=response.data[index]['fecha_reunion'];
        if(response.data[index]['ruta_documento']){
          $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha+"&nbsp;&nbsp;<a type='button' class='btn btn-dark btn-md' target='_blank' href='"+response.data[index]['ruta_documento']+"'><i class='fas fa-file-pdf'></i></a>");
        }else{
          $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha);
        }

        d+='<h3>Tema '+(index+1)+"</h3><h6></h6><br><div style='padding-left:25px;'>"+response.data[index]['descripcion']+'</div><br>';
        d+="<label for='comentario_tema'> Comentario: </label>";
        //console.log("comentario tema: "+response.data[index]['comentario_tema']);
        if(response.data[index]['comentario_tema']==null){
            d+="<p><textarea rows='1' cols='10' class='form-control' id='comentario_tema' name='"+response.data[index]['id_tema']+"' placeholer='Añadir comentario...'></textarea><p>";
        }else{
            d+="<p><textarea rows='1' cols='10' class='form-control' id='comentario_tema' name='"+response.data[index]['id_tema']+"' placeholer='Añadir comentario...'>"+response.data[index]['comentario_tema']+"</textarea><p>";
        }


      });
      $("#form-reunion-secretario").append(d);
      if(response.data.length!='0'){
      $("#titulo-modal-reunion-secretario").html("Temas de la reunión de la fecha: "+fecha);
      }else{
        $("#titulo-modal-reunion-secretario").html("Esta reunión no tiene temas...");
      }
      $("#modal-reunion-secretario").modal("show");
      $("#btn-aceptar-reunion-secretario").attr("onClick", "agregarComentariosTema(\"" + id_reunion + "\")");

    } else {
      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
  $("#form-reunion-secretario").html("");
}

function agregarComentariosTema(id_reunion){
  var form = $("#form-reunion-secretario").serializeArray();
  var id_tema='';
  var comentario_tema='';
  //extraer el user name del secretario
  $.each(form, function(index,field) {
    //console.log("recorriendo form: "+field.value);
    id_tema=Number(field.name);
    comentario_tema=field.value;
    $.post("../model/profesor.php?accion=35&&id_tema="+id_tema+"&&id_reunion="+id_reunion+"&&comentario_tema="+comentario_tema, function(response) {
      //console.log("response: "+response.success);
      if (response.success) {
        $("#modal-reunion-secretario").modal("hide");
      }else {
          //swal('Error', 'No se agrego el comentario, vuelva a intentarlo.', 'error');
          swal('Error', response.msg[2], 'error');
            }
     }, 'json');
  });

}


function  verReuniones(id_reunion){
  //console.log("id reunion: "+id_reunion);
  var d='';
  var z='';
  var fecha='';
  var id_tema='';
  //ver si es el director el que esta logeado
  $.post("../model/profesor.php?accion=46", function(response) {
    //console.log("response: "+response.success);
    if (response.success) {
      //console.log("es el director?: "+response.data[0]['director']);
      if(response.data[0]['director']==true){var director=response.data[0]['director'];}

      //Cuando tienen comentarios previos hechos votacion hecha
      $.post("../model/profesor.php?accion=39", {id_reunion: id_reunion}, function(response) {
        if (response.success) {
          if(response.data==''){
            //console.log("data vacia, por que no hay votacion hecha");
           $.post("../model/profesor.php?accion=2", {id_reunion: id_reunion}, function(response) {
              if (response.success) {
                $.each(response.data, function(index, value) {
                  fecha=response.data[index]['fecha_reunion'];
                  //console.log("ruta 1: "+response.data[index]['ruta_documento']);
                  if(response.data[index]['ruta_documento']){
                    $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha+"&nbsp;&nbsp;<a type='button' class='btn btn-dark btn-md' target='_blank' href='"+response.data[index]['ruta_documento']+"'><i class='fas fa-file-pdf'></i></a>");
                  }else{
                    $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha);
                  }

                  var data=response.data;
                  d+="<h3>Tema "+(index+1)+"</h3><br><div style='padding-left:25px;'>"+response.data[index]['descripcion']+"</div><br>";
                  if(response.data[index]['comentario_tema']==null){var comentario_tema="Sin comentarios...";}else{var comentario_tema=response.data[index]['comentario_tema'];}
                  d+="<div style='padding-left:25px;'>&nbsp;&nbsp;Comentarios: "+comentario_tema+"</div>";
                  d+="<label class='form-check-label' for='deacuerdo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A favor <input type='radio'  id='"+data[index]['id_tema']+"' name='"+data[index]['id_tema']+"' value='t'>";
                  d+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En contra <input type='radio'  id='"+data[index]['id_tema']+"' name='"+data[index]['id_tema']+"' value='f'>";
                  d+="<label for='comentario'></label>";
                  d+="<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                  d+="¿Por qué? <br>&nbsp;&nbsp;&nbsp;";
                  d+="<textarea style='margin-left:120px;' rows='3' cols='15'  id='comentario' name='"+data[index]['id_tema']+"' placeholer='Añadir comentario...'></textarea><p><br>";
                });
                $("#form-reunion-votacion").append(d);
                if(response.data==''){$("#titulo-modal-reunion").html("Esta reunión no tiene temas...");}
                $("#btn-aceptar-reunion").attr("onClick", "agregarVotacion()");
              } else {
              swal('Error', response.msg[2], 'error');
              }
            }, 'json');
          }else{
            //editar votacion
            $.each(response.data, function(index, value) {
              fecha=response.data[index]['fecha_reunion'];
              var data=response.data;
              id_tema=response.data[index]['id_tema'];
              d+="<h3>Tema "+(index+1)+"</h3><br><div style='padding-left:25px;'>"+response.data[index]['descripcion']+"</div><br>";
              if(response.data[index]['comentario_tema']==null){var comentario_tema="Sin comentarios...";}else{var comentario_tema=response.data[index]['comentario_tema'];}
              d+="<div style='padding-left:25px;'>&nbsp;&nbsp;Comentarios: "+comentario_tema+"</div>";
                    //console.log("ruta 2: "+response.data[index]['ruta_documento']);

                    if(response.data[index]['ruta_documento']){

                      $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha+"&nbsp;&nbsp;<a type='button' class='btn btn-dark btn-md' target='_blank' href='"+response.data[index]['ruta_documento']+"'><i class='fas fa-file-pdf'></i></a>");

                    }else{
                      $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha);
                    }

                    if(response.data[index]['voto']==true){
                      //console.log("voto?: "+response.data[index]['voto']);
                      d+="<label class='form-check-label' for='deacuerdo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A favor <input type='radio'  id='"+response.data[index]['id_tema']+"' name='"+response.data[index]['id_tema']+"' value='t' checked>";
                      d+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En contra <input type='radio'  id='"+response.data[index]['id_tema']+"' name='"+response.data[index]['id_tema']+"' value='f'>";
                      d+="<label for='comentario'></label>";
                      d+="<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                      d+="¿Por qué? <br>&nbsp;&nbsp;&nbsp;";
                      d+="<textarea style='margin-left:120px;' rows='3' cols='15'  id='comentario' name='"+response.data[index]['id_tema']+"' placeholer='Añadir comentario...'>"+response.data[index]["comentario"]+"</textarea><p><br>";
                    }else{
                        //console.log("voto? deberia ser false: "+response.data[index]['voto']);
                        d+="<label class='form-check-label' for='deacuerdo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A favor <input type='radio'  id='"+response.data[index]['id_tema']+"' name='"+response.data[index]['id_tema']+"' value='t'>";
                        d+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En contra <input type='radio'  id='"+response.data[index]['id_tema']+"' name='"+response.data[index]['id_tema']+"' value='f' checked>";
                        d+="<label for='comentario'></label>";
                        d+="<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        d+="¿Por qué? <br>&nbsp;&nbsp;&nbsp;";
                        d+="<textarea style='margin-left:120px;' rows='3' cols='15'  id='comentario' name='comentario' placeholer='Añadir comentario...'>"+response.data[index]["comentario"]+"</textarea><p><br>";
                      }
            });
          }


          if(director==true){
            $("#btn-finalizar-reunion").show();
            $("#btn-finalizar-reunion").attr("onClick", "finalizarReunion(\"" + id_reunion + "\")");
          }else{
            $("#btn-finalizar-reunion").hide();
          }

          $("#form-reunion-votacion").append(d);
          $("#btn-aceptar-reunion").attr("onClick", "editarVotacion()");

          if(response.success==true){
          //$("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha);
          }else{
            $("#titulo-modal-reunion").html("Esta reunión no tiene temas...");
          }
        } else {
          swal('Error', response.msg[2], 'error');
        }
      }, 'json');

    }else {swal('Error', response.msg[2], 'error');}
   }, 'json');


  $("#modal-reunion").modal("show");
  $("#form-reunion-votacion").html("");
}
function finalizarReunion(id_reunion){
  $("#btn-aceptar-finalizar-reunion").attr("onClick", "finalizarReunion_DB(\"" + id_reunion + "\")");
  $("#modal-reunion").modal("hide");
  $("#modal-finalizar-reunion").modal("show");
  finalizarReunion2(id_reunion);
}
function finalizarReunion2(id_reunion){

  console.log("entro a finalizar");
  //primero ver que respondieron y sus comentarios, despues pasar a la bd a cambiar aprobada=t
  accion_agregar = "Ver Comentarios";

  var table_fin = $('#dataTable_finalizarReunion').dataTable({
    "columnDefs": [
      {"title": "Username", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
      {"title": "Nombres", "targets": 1, "orderable": false, "className": "dt-body-left","visible": true},
      {"title": "Apellidos", "targets": 2, "orderable": false, "className": "dt-body-left"},
      {"title": accion_agregar, "targets": 3, "orderable": false, "className": "dt-body-left","visible": true},
    ],
    "searching": true,
    "search": {
      "regex": true,
      "smart": true
    },
    "scrollX": false,
    "order": [[3, "desc"]],
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

  table_fin.fnClearTable();

  $.ajax({
    url: '../model/profesor.php',
    data: {accion: 48,id_reunion:id_reunion},
    type: 'POST',
    dataType: 'json',
    async: true,
    success: function(response) {
      if (response.success) {
        var data = response.data;
        //console.log("data: "+data);
        for(var i = 0; i < data.length; i++) {

          table_fin.fnAddData([
            data[i]["user_name"],
            data[i]["nombres"],
            data[i]["apellidos"],
            "<button type='button' class='btn btn-info btn-sm' onclick='mostrarVotaciones(\"" + id_reunion + "\",\"" + data[i]["user_name"] + "\");' title='ver votaciones'>"+
            "<i class='far fa-eye'></i></button>&nbsp;"
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

function mostrarVotaciones(id_reunion,user_name){
  var d='';
  $.post("../model/profesor.php?accion=49&&id_reunion="+id_reunion+"&&user_name="+user_name, function(response) {
    //console.log("response: "+response.success);
    if (response.success) {
      //console.log("success: "+response.data);
      if(response.data!=''){
        $.each(response.data, function(index, value) {
          //console.log("datos: "+response.data);
          //console.log("dato("+(index+1)+") voto :"+response.data[index]['voto']);
          //console.log("dato("+(index+1)+") comentario :"+response.data[index]['comentario']);
          if(response.data[index]['voto']==true){var voto="A favor";}else{var voto="En contra";}
          d+="<h4>Tema "+(index+1)+" :</h4>";
          d+="Voto: "+voto+"<br>";
          d+="Comentarios: "+response.data[index]['comentario']+"<br><br>";
        });
        $("#modal-body-invitados-votaciones").append(d);
        //$("#modal-finalizar-reunion").modal("hide");
        $("#modal-invitados-votaciones").modal("show");
      }else{
        swal('Este profesor no ha hecho su votación','','info');
      }
    }else {
        swal('Error', response.msg[2], 'error');
          }
   }, 'json');
$("#modal-body-invitados-votaciones").html("");
$("#btn-aceptar-finalizar-reunion").attr("onClick", "finalizarReunion_DB(\"" + id_reunion + "\")");
}

//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
function finalizarReunion_DB(id_reunion){
  //console.log("finalizando");
  //obtener lista de invitados  y correos, ademas de la fecha de la reunion
  $.post("../model/profesor.php?accion=51&&id_reunion="+id_reunion, function(response) {

    if (response.data=='') {
      //console.log("data vacia, no hay invitados");
      $.post("../model/profesor.php?accion=50&&id_reunion="+id_reunion, function(response) {
        //console.log("response: "+response.success);
        if (response.success) {
          swal('Listo!','Reunión finalizada correctamente','success');
          $("#modal-reunion").modal("hide");
          $("#modal-invitados-votaciones").modal("hide");
          $("#modal-finalizar-reunion").modal("hide");
          obtenerReuniones();
        }else {
            //swal('Error', 'No se agrego el comentario, vuelva a intentarlo.', 'error');
            swal('Error', response.msg[2], 'error');
              }
       }, 'json');
    }else {

      $.each(response.data, function(index, value) {
        //console.log("correo: "+response.data[index]['correo']);
        var correo=response.data[index]['correo'];
        var fecha_reunion=response.data[index]['fecha_reunion'];
        $.post("../model/profesor.php?accion=52&&id_reunion="+id_reunion+"&&correo="+correo+"&&fecha_reunion="+fecha_reunion, function(response) {
          //console.log("response: "+response.success);
          if (response.success) {

          }else {
              //swal('Error', 'No se agrego el comentario, vuelva a intentarlo.', 'error');
              swal('Error', response.msg[2], 'error');
                }
         }, 'json');

         swal('Listo!','Reunión finalizada correctamente','success');
         $("#modal-reunion").modal("hide");
         $("#modal-invitados-votaciones").modal("hide");
         $("#modal-finalizar-reunion").modal("hide");
         obtenerReuniones();
      });

        //swal('Error', 'No se agrego el comentario, vuelva a intentarlo.', 'error');
        //swal('Error', response.msg[2], 'error');
          }
   }, 'json');

}
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################
//###################################################################################################



function editarVotacion(){
  //console.log("entro a editar");
  val = validarVotacion();
  if (val == false) return false;
  var form = $("#form-reunion-votacion").serializeArray();
  //console.log("form: "+form);

  for(i=0;i<form.length;i=i+2){
    //console.log("voto: "+form[i].value);
    //console.log("comentario: "+form[i+1].value);
    //console.log("id_tema: "+form[i+1].name);
    var id_tema=form[i].name;
    var voto=form[i].value;
    var comentario=form[i+1].value;
    $.post("../model/profesor.php?accion=41&&id_tema="+id_tema+"&&voto="+voto+"&&comentario="+comentario, function(response) {
      //console.log("response: "+response.success);
      if (response.success) {
        swal('Listo!','','success');
        $("#modal-reunion").modal("hide");
      }else {
          //swal('Error', 'No se agrego el comentario, vuelva a intentarlo.', 'error');
          swal('Error', response.msg[2], 'error');
            }
     }, 'json');
  }

}



function agregarVotacion(){
  val = validarVotacion();
  if (val == false) return false;
  //console.log("entro a editar");
  var form = $("#form-reunion-votacion").serializeArray();
    //console.log("form: "+form);
  for(i=0;i<form.length;i=i+2){
    //console.log("voto: "+form[i].value);
    //console.log("comentario: "+form[i+1].value);
    //console.log("id_tema: "+form[i+1].name);
    var id_tema=form[i].name;
    var voto=form[i].value;
    var comentario=form[i+1].value;
    $.post("../model/profesor.php?accion=40&&id_tema="+id_tema+"&&voto="+voto+"&&comentario="+comentario, function(response) {
      //console.log("response: "+response.success);
      if (response.success) {
        swal('Listo!','','success');
        $("#modal-reunion").modal("hide");
      }else {
          //swal('Error', 'No se agrego el comentario, vuelva a intentarlo.', 'error');
          swal('Error', response.msg[2], 'error');
            }
     }, 'json');
  }
}

function validarVotacion () {
  var form = $("#form-reunion-votacion").serializeArray();
    //console.log("form: "+form);
  for(i=0;i<form.length;i=i+2){
    //console.log("asdasdsa: "+form[i].value);
    //if ($('#'+form[i].name).val().trim().length==0) {
    if(form[i].value==''){
      swal('Atención', "Para poder guardar su votación, debe marcar todas las opciones, ninguna debe quedar vacia(excepto los comentarios, no son obligatorios.)", 'info');
      return false;
    }
  }
}

function nuevaReunion(){
  $('#documento-subido').html("");
  document.getElementById("form-nueva-reunion").reset();
  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  $( "#fecha_reunion" ).datepicker({format:'yyyy-mm-dd',minDate: today, uiLibrary: 'bootstrap4'});
  $('#hora_reunion').timepicker({uiLibrary: 'bootstrap4'});
  $("#modal-nueva-reunion").modal("show");
  $("#btn-aceptar-nueva-reunion").attr("onClick", "agregarReunion()");

}

function agregarReunion(){
  val = validarReunion();
  if (val == false) return false;
  var form = $("#form-nueva-reunion").serialize();
  //console.log("form: "+form);
  //extraer el user name del secretario
  $.post("../model/profesor.php?accion=11", function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
      if(response.data==''){

      swal('Atención!','Es obligación tener a un secretario, para poder crear una reunión','warning');
    }else{
      var secretario=response.data[0]['user_name'];
      //crear reunion

      var documento = $('#documento').prop('files')[0];
      var form_data = new FormData();
      form_data.append('documento', documento);
      $.ajax({
          url: '../model/profesor.php?accion=15&&user_name='+secretario+"&&"+form,
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'POST',
          success: function(response){
            //console.log("respuesta: "+response);

            $("#modal-nueva-reunion").modal("hide");
            swal('Atención', 'Se ha creado la Reunión, pero debe asignarle los temas.', 'warning');
            obtenerReuniones();

            }
       });
    }


    }else {

          }
   }, 'json');
}


function editarReunion(id_reunion){
  document.getElementById("form-nueva-reunion").reset();
  $( "#fecha_reunion" ).datepicker({format:'yyyy-mm-dd',minDate: 0, uiLibrary: 'bootstrap4'});
  $('#hora_reunion').timepicker({uiLibrary: 'bootstrap4'});
  //ya tengo user_name con $_SESSION, asi que ire a pedir sus datos.
  $.post("../model/profesor.php?accion=17&&id_reunion="+id_reunion, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
        if(response.data!=''){
          $.each(response.data, function(index, value) {
            if ($("input[name='fecha_reunion']").length&&$("input[name='hora_reunion']").length) {
              $("input[name='fecha_reunion']").val(response.data[index]['fecha_reunion']);
              $("input[name='hora_reunion']").val(response.data[index]['hora_reunion']);
            }else{}
          });
          //console.log(response.data[0]['ruta_documento']);
          $("#documento-subido").html("<object data='"+response.data[0]['ruta_documento']+"' width='600' height='780' style='border: none;'></object>");
          //$("#documento-subido").html("<iframe src='"+response.data[0]['ruta_documento']+"' width='600' height='780' style='border: none;'></iframe>");
          //$("#documento-subido").html("<iframe src='../uploads/2018-08-12_Descripción_Informe2_Grupo7_1.pdf'></iframe>");
          $("#titulo-modal-nueva-reunion").html("Editando Reunión");
          $("#modal-nueva-reunion").modal("show");
          $("#btn-aceptar-nueva-reunion").attr("onClick", "editarReunion_BD(\"" + id_reunion + "\",\"" + response.data[0]['ruta_documento'] + "\")");
        }else{}
    }else {}
   }, 'json');
   $("#documento-subido").html("");
}

function editarReunion_BD(id_reunion,url_vieja){
  val = validarReunion();
  if (val == false) return false;
  var form = $("#form-nueva-reunion").serialize();
  //editar reunion

  var documento = $('#documento').prop('files')[0];
  var form_data = new FormData();
  form_data.append('documento', documento);
  $.ajax({
      url: '../model/profesor.php?accion=18&&id_reunion='+id_reunion+"&&url_vieja="+url_vieja+"&&"+form,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'POST',
      success: function(response){
        //console.log("respuesta: "+response);
        $("#modal-nueva-reunion").modal("hide");
        swal('Atención', 'Se ha modificado la Reunión.', 'success');
        obtenerReuniones();
        }
   });

}

function editarTemas(id_reunion){
  accion_agregar = "<button type='button' class='btn btn-success btn-sm' " +
                        "onclick='agregarTema(\"" + id_reunion + "\");' title='Agregar'><i class='fas fa-plus-square'></button>";

  var table = $('#dataTable_asignarTemas').dataTable({
    "columnDefs": [
      {"title": "Descripción", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
      {"title": accion_agregar, "targets": 1, "orderable": false, "className": "dt-body-left","visible": true},
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
    url: '../model/profesor.php',
    data: {accion: 2,id_reunion:id_reunion},
    type: 'POST',
    dataType: 'json',
    async: true,
    success: function(response) {
      if (response.success) {
        var data = response.data;

        for(var i = 0; i < data.length; i++) {

          var descripcion= data[i]["descripcion"].substring(0,50)+"...";;
          table.fnAddData([
            descripcion,
            "<button type='button' class='btn btn-warning btn-sm' onclick='editarTema(\"" + data[i]["id_tema"] + "\",\"" + id_reunion + "\");' title='Editar'>"+
            "<i class='far fa-edit'></i></button>&nbsp;"+
            "<button type='button' class='btn btn-danger btn-sm' onclick='eliminarTema(\"" + data[i]["id_tema"] + "\",\"" + id_reunion + "\");' title='eliminar'>"+
            "<i class='fas fa-trash-alt'></i></button>&nbsp;"
          ]);
        }
      } else {
        swal('Error', response.msg[2], 'error');
      }
    }, error: function(jqXHR, textStatus, errorThrown ) {
      swal('Error', textStatus + " " + errorThrown, 'error');
    }
  });
  $("#modal-asignar-temas").modal("show");
}

function agregarTema(id_reunion){
  document.getElementById("form-asignar-tema").reset();
  $("#modal-asignar-temas").modal("hide");
  $("#modal-asignar-tema").modal("show");
  $("#btn-aceptar-asignar-tema").attr("onClick", "agregarTema_BD(\"" + id_reunion + "\")");
}
function agregarTema_BD(id_reunion){
  val = validarTema();
  if (val == false) return false;
  var form = $("#form-asignar-tema").serialize();
  //agregar tema
  $.post("../model/profesor.php?accion=23&&id_reunion="+id_reunion,form, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
      $("#modal-asignar-tema").modal("hide");
      $("#modal-asignar-temas").modal("hide");
      editarTemas(id_reunion);

    }else {
        //swal('Error', 'No se cambio la contraseña, vuelva a intentarlo.', 'error');
          }
   }, 'json');
}

function eliminarTema(id_tema,id_reunion){
  //eliminar con el id_tema en votacion primero

  $.post("../model/profesor.php?accion=47&&id_tema="+id_tema, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {

      $.post("../model/profesor.php?accion=26&&id_tema="+id_tema, function(response) {
        //console.log("response: "+response.data);
        if (response.success) {
          $("#modal-asignar-tema").modal("hide");
          $("#modal-asignar-temas").modal("hide");
          swal('Listo','Se eliminó el tema','success');
          editarTemas(id_reunion);

        }else {
            //swal('Error', 'No se cambio la contraseña, vuelva a intentarlo.', 'error');
              }
       }, 'json');
    }else {
        //swal('Error', 'No se cambio la contraseña, vuelva a intentarlo.', 'error');
          }
   }, 'json');




}

function editarTema(id_tema,id_reunion){
  document.getElementById("form-asignar-tema").reset();
  $("#modal-asignar-temas").modal("hide");
  $("#modal-asignar-tema").modal("show");
  //ya tengo user_name con $_SESSION, asi que ire a pedir sus datos.
  $.post("../model/profesor.php?accion=24&&id_tema="+id_tema, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
        if(response.data!=''){
          $.each(response.data, function(index, value) {
            if ($("textarea[name='descripcion']").length) {
              $("textarea[name='descripcion']").val(response.data[index]['descripcion']);
            }else{}
          });
          $("#modal-asignar-tema").modal("show");
          $("#btn-aceptar-asignar-tema").attr("onClick", "editarTema_BD(\"" + id_tema + "\",\"" + id_reunion + "\")");
        }else{}
    }else {}
   }, 'json');
}

function editarTema_BD(id_tema,id_reunion){
  val = validarTema();
  if (val == false) return false;
  var form = $("#form-asignar-tema").serialize();
  //agregar tema
  $.post("../model/profesor.php?accion=25&&id_tema="+id_tema,form, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
      $("#modal-asignar-tema").modal("hide");
      $("#modal-asignar-temas").modal("hide");
      editarTemas(id_reunion);

    }else {
        //swal('Error', 'No se cambio la contraseña, vuelva a intentarlo.', 'error');
          }
   }, 'json');
}



function eliminarReunion(id_reunion){
  swal({
    title: "¿Estás seguro de esta acción?",
    text: "Se eliminará una reunión en el sistema!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      //RECUERDA LIMPIAR LAS TABLAS ANTES DE ELIMINAR LA REUNION
      //limpiar invita

      $.post("../model/profesor.php?accion=20&id_reunion=" + id_reunion, function(response) {
        if (response.success) {
          //obtenemos tema de la reunion

          $.post("../model/profesor.php?accion=2&id_reunion=" + id_reunion, function(response) {
            if (response.success) {
                //console.log("obtencion de temas: "+response.data);
                var cant_temas=response.data.length;

                for(var i = 0; i < cant_temas; i++) {
                  var id_tema=response.data[i]['id_tema'];
                  //por cada tema se elminara 1 votacion
                  //console.log("se eliminara votacion del tema: "+response.data[i]['id_tema']);
                  $.post("../model/profesor.php?accion=21&id_tema=" + id_tema, function(response) {
                    if (response.success) {
                    } else {
                      swal('Error', response.msg[2], 'error');
                    }
                  }, 'json');
                  if(i==(cant_temas-1)){
                    //console.log("ahora elimino temas");
                    $.post("../model/profesor.php?accion=22&id_reunion=" + id_reunion, function(response) {
                      if (response.success) {
                        //console.log("se eliminaron los temas");
                        //por tanto ahora se elimina la reunion
                        $.post("../model/profesor.php?accion=19&id_reunion=" + id_reunion, function(response) {
                          if (response.success) {
                            swal('Listo','Se eliminó correctamente la reunión','success');
                            obtenerReuniones();
                          } else {
                            swal('Error', response.msg[2], 'error');
                          }
                        }, 'json');
                      } else {
                        swal('Error', response.msg[2], 'error');
                      }
                    }, 'json');
                  }
                }

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
  /**/
}


function invitadosReunion(id_reunion,fecha_reunion){
  //console.log("id_reunion en invitados: "+id_reunion);
  $("#form-invitados").html("");
  document.getElementById("form-invitados").reset();
  $("#titulo-modal-invitados").html("Invitaciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-info btn-sm' onclick='reestablecerInvitacion(\"" + id_reunion + "\",\"" + fecha_reunion + "\");' title='Editar'>"+
  "<i class='fas fa-sync-alt'></i></button>&nbsp;");
  var inv="<h5>&nbsp;&nbsp;Listado de Profesores</h5>";
  //extraer todos los profes
  $.post("../model/profesor.php?accion=27", function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
        if(response.data!=''){
          var data=response.data;
          //debo crear los input primero
          $.each(response.data, function(index, value) {
          inv+="<p><label for='user_name'></label><input type='checkbox' "+
          " id='"+response.data[index]['user_name']+"' name='"+response.data[index]['user_name']+"' value='"+response.data[index]['correo']+"'>&nbsp;&nbsp;"+response.data[index]['nombres']+"&nbsp;&nbsp;"+response.data[index]['apellidos']+
          "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;("+response.data[index]['user_name']+")"+
          "</p>";
        //  inv+="<label for='correo'  style='display: none;''>Correo: *</label>"+
        //  "<input type='text' class='form-control' id='"+response.data[index]['correo']+"' name='"+response.data[index]['correo']+"' style='display: none;'>";
          });
          $("#form-invitados").append(inv);



          //deshabilita el check
          $.post("../model/profesor.php?accion=28&&id_reunion="+id_reunion, function(response) {
            if (response.success) {
              //console.log("previamente invitados: "+response.data);
              $.each(response.data, function(index, value) {
                //console.log("user_name de los check: "+response.data[index]['user_name']);
                if (response.data[index]['user_name']!='') {
                  //console.log("user_name de los check: "+response.data[index]['user_name']);
                  document.getElementById(""+response.data[index]['user_name']+"").checked = true;
                  document.getElementById(""+response.data[index]['user_name']+"").disabled= true;
                }else{}
              });
            }else {}
           }, 'json');

          $("#modal-invitados").modal("show");
          $("#btn-aceptar-invitados").attr("onClick", "editarinvitacion_BD(\"" + id_reunion + "\",\"" + data + "\",\"" + fecha_reunion + "\")");

        }else{}
    }else {}
   }, 'json');
}



function editarinvitacion_BD(id_reunion,data,fecha_reunion){
  invitarDirectorporDefecto(id_reunion);
  invitarSecretarioporDefecto(id_reunion);
  //insertar los invitados
  var form = $("#form-invitados").serializeArray();
  //console.log("invitados: "+form+"  data: "+data);
  $.each(form, function(index,field) {
    //console.log("recorriendo form: "+field.name);
    //console.log("recorriendo form: "+field.value);
    var user_name=field.name;
    var correo=field.value;

    $.post("../model/profesor.php?accion=29&&id_reunion="+id_reunion+"&&user_name="+user_name+"&&fecha_reunion="+fecha_reunion+"&&correo="+correo, function(response) {
      if (response.success) {
        //console.log("se agrego un invitado: "+user_name);
      }else {}
     }, 'json');
    });
    $("#modal-invitados").modal("hide");
}






function reestablecerInvitacion(id_reunion,fecha_reunion){
  swal({
    title: "¿Estás seguro de esta acción?",
    text: "Se eliminarán las invitaciones!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $.post("../model/profesor.php?accion=20&id_reunion=" + id_reunion, function(response) {
        if (response.success) {
          invitadosReunion(id_reunion,fecha_reunion);
        } else {
          swal('Error', response.msg[2], 'error');
        }
      }, 'json');

    } else {
      swal("Los datos están seguros!");
    }
  });
}

function invitarDirectorporDefecto(id_reunion){
  $.post("../model/profesor.php?accion=44&&id_reunion="+id_reunion, function(response) {
    if (response.success) {
      //console.log("se agrego un invitado: "+user_name);
    }else {}
   }, 'json');
}

function invitarSecretarioporDefecto(id_reunion){
  $.post("../model/profesor.php?accion=11&&id_reunion="+id_reunion, function(response) {
    if (response.success) {
      //console.log("secretario: "+response.data[0]['user_name']);
      var secretario=response.data[0]['user_name'];

        $.post("../model/profesor.php?accion=45&&id_reunion="+id_reunion+"&&user_name_secretario="+secretario, function(response) {
          if (response.success) {

          }else {}
         }, 'json');
    }else {}
   }, 'json');
}



function obtenerSecretario(){

  var d='';
  $.post("../model/profesor.php?accion=11", {}, function(response) {
    if (response.success!=undefined) {
      if(response.data!=''){
        d+="<h4>Información del secretario: </h4><br>";
        d+="Username: "+response.data[0]['user_name']+"<br>";
        d+="Nombres: "+response.data[0]['nombres']+"<br>";
        d+="Apellidos: "+response.data[0]['apellidos']+"<br>";
        d+="Correo: "+response.data[0]['correo']+"<br>";
        d+="Teléfono: "+response.data[0]['celular']+"<br>";
        d+="<button type='button' class='btn btn-warning btn-sm' onclick='mostrarposibleSecretario(\"" + response.data[0]["user_name"] + "\");' title='Editar'>"+
        "Cambiar de Secretario</button>&nbsp;";
        d+="<button type='button' class='btn btn-danger btn-sm' onclick='eliminarSecretario(\"" + response.data[0]["user_name"] + "\");' title='Editar'>"+
        "<i class='fas fa-trash-alt'></i></button>&nbsp;";
        $("#panel-body-asignar-secretario").append(d);
      }else{
        var user_name="";
        d+="<h3>No existe secretario actualmente.</h3><button type='button' class='btn btn-success btn-sm' onclick='mostrarposibleSecretario(\"" + user_name + "\");' title='nuevo Secretario'>Asignar un Secretario</button>&nbsp;";
        $("#panel-body-asignar-secretario").append(d);
      }
    } else {

      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
  $("#panel-body-asignar-secretario").html("");
}

function mostrarposibleSecretario(user_name){
  //console.log("entramos");
  //console.log("viene el old: "+user_name);
  var table2 = $('#dataTable_posiblesecretario').dataTable({
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
    url: '../model/profesor.php',
    data: {accion: 12},
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
            "<button type='button' class='btn btn-dark btn-sm' onclick='cambioSecretario(\"" + data[i]["user_name"] + "\",\"" + user_name + "\");' title='Editar'>Asignar</button>&nbsp;"
          ]);
        }
        $("#titulo-modal-cambiar-secretario").html("Asignar un nuevo secretario");
        $("#modal-cambiar-secretario").modal("show");
      } else {
        swal('Error', response.msg[2], 'error');
      }
    }, error: function(jqXHR, textStatus, errorThrown ) {
      swal('Error', textStatus + " " + errorThrown, 'error');
    }
  });
}

function cambioSecretario(user_name,user_name_old){

  if(user_name_old!=''){
      swal({
        title: "¿Estás seguro de esta acción?",
        text: "Hará cambio de Secretario en el sistema!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          //editar columna director cambiar t por f
          $.post("../model/profesor.php?accion=13&user_name=" + user_name_old, function(response) {
            if (response.success) {
              //console.log("se cambio t por f en director: "+user_name_old+" exitosamente");
                      //ahora cambiamos f por t al nuevo director
                    $.post("../model/profesor.php?accion=14&user_name=" + user_name, function(response) {
                      if (response.success) {
                        //console.log("se cambio f por t en nuevo director: "+user_name+" exitosamente");
                        swal('Aceptado', 'Se ha asignado un nuevo Secretario de forma correcta!!.', 'success');
                        $("#modal-cambiar-secretario").modal("hide");
                        obtenerSecretario();

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
 $.post("../model/profesor.php?accion=14&user_name=" + user_name, function(response) {
   if (response.success) {
     //console.log("se cambio f por t en nuevo director: "+user_name+" exitosamente");
     swal('Aceptado', 'Se ha asignado un nuevo Secretario de forma correcta!!.', 'success');
     $("#modal-cambiar-secretario").modal("hide");
     obtenerSecretario();

   } else {
     swal('Error', response.msg[2], 'error');
   }
 }, 'json');
 }
}


function eliminarSecretario(user_name){
  swal({
    title: "¿Estás seguro de esta acción?",
    text: "No habrá ningun Secretario en el sistema!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      //editar columna director cambiar t por f
      $.post("../model/profesor.php?accion=13&user_name=" + user_name, function(response) {
        if (response.success) {
          //console.log("se cambio t por f en director: "+user_name+" exitosamente");
              obtenerSecretario();
        } else {
          swal('Error', response.msg[2], 'error');
        }
      }, 'json');

    } else {
      swal("Los datos están seguros!");
    }
  });
}


function estadisticaAsistencia(){
  var d='';
  //preguntar a cuantas reuniones esta invitado
  $.post("../model/profesor.php?accion=42", function(response) {
    if (response.success) {
      //num invitaciones
        //console.log(response.data[0]['num_reuniones']);
        var num_reuniones=response.data[0]['num_reuniones'];
        //a cuantas ha asistido
        $.post("../model/profesor.php?accion=43", function(response) {
          if (response.success) {
            //num invitaciones
              //console.log(response.data[0]['num_asistencias']);
              var num_asistencias=response.data[0]['num_asistencias'];
              var num_inasistencias=num_reuniones-num_asistencias;
              //d+="<h3>Ha sido invitado a: "+num_reuniones+" reuniones y ha asistido a: "+num_asistencias+". Usted tiene un: "+porcentaje_asistencia+"% de asistencia.</h3>";
              $("#estadistica-asistencia").append(d);
              new Chart(document.getElementById("pie-chart-asistencia"), {
                  type: 'pie',
                  data: {
                    labels: ["Asistencias", "Inasistencias"],
                    datasets: [{
                      label: "Presencia en las reuniones.",
                      backgroundColor: ["#3e95cd", "#8e5ea2"],
                      data: [num_asistencias,num_inasistencias]
                    }]
                  },
                  options: {
                    title: {
                      display: true,
                      text: 'Asistencias totales de: '+num_reuniones+' reuniones.'
                    }
                  }
              });

          } else {
            swal('Error', response.msg[2], 'error');
          }
        }, 'json');

    } else {
      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
  $("#estadistica-asistencia").html("");
}

function obtenerAsistencia(){
  estadisticaAsistencia();
  var table = $('#dataTable_asistencia').dataTable({
    "columnDefs": [
      {"title": "Reunión", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
      {"title": "Asistencia", "targets": 1, "orderable": false, "className": "dt-body-left", "visible": true},
    //{"title": "Ver temas", "targets": 2, "orderable": false, "className": "dt-body-left","visible": true},
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
    url: '../model/profesor.php',
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
          }else if(data[i]["asiste"]==true){
            var asistencia='Asiste';
          }else{
            var asistencia='Pendiente';
          }
          table.fnAddData([
            data[i]["fecha_reunion"],
            asistencia,
            //"<button type='button' class='btn btn-info btn-sm' onclick='verAsistencia(\"" + data[i]["id_reunion"] + "\");' title='Editar'>"+
            //"VER</button>&nbsp;"
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


function perfil(){
  $("#container-profesores").hide();
  $("#container-asistencia").hide();
  $("#container-reunion").hide();
  $("#container-contrasena").hide();
  $("#container-perfil").show();
  document.getElementById("form-cambioPerfil").reset();
  //ya tengo user_name con $_SESSION, asi que ire a pedir sus datos.
  $.post("../model/profesor.php?accion=8", function(response) {
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

function cambiarContrasena() {
  var form = $("#form-cambioContrasena").serialize();
  //pide contrasena antigua
  $.post("../model/profesor.php?accion=6", form, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
        if(response.data!=''){
          //cambia la contrasena
          $.post("../model/profesor.php?accion=7", form, function(response) {
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
   $.post("../model/profesor.php?accion=9", form, function(response) {
     //console.log("response: "+response.data);
     if (response.success) {
       swal('Cambios de Perfil!', 'Se hicieron cambios en el perfil de forma correcta.', 'success');
       perfil();
     } else {
       //swal('Contraseñas distintas', 'Contraseñas ingresadas no son iguales', 'error');
       //document.getElementById("form-cambioContrasena").reset();
     }
   }, 'json');
}

function obtenerReunionesHistorial(){
  var accion_agregar="";

    $.post("../model/profesor.php?accion=10", function(response) {
      //console.log("response: "+response.data);
      if (response.success) {
          if(response.data[0]['director']==true){
          //console.log("es director");
          accion_agregar = "Ver Temas";

          var table = $('#dataTable_reunionHistorial').dataTable({
            "columnDefs": [
              {"title": "Secretario", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
              {"title": "Fecha creación", "targets": 1, "orderable": false, "className": "dt-body-left","visible": true},
              {"title": "Fecha reunión", "targets": 2, "orderable": false, "className": "dt-body-left"},
              {"title": "Hora reunión", "targets": 3, "orderable": false, "className": "dt-body-left"},
              {"title": accion_agregar, "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
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
            url: '../model/profesor.php',
            data: {accion: 33},
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(response) {
              if (response.success) {
                var data = response.data;
                var no_aprobada="No aprobada";
                var si_aprobada="Aprobada";
                for(var i = 0; i < data.length; i++) {

                  table.fnAddData([
                    data[i]["usu_user_name"],
                    data[i]["fecha_creacion"],
                    data[i]["fecha_reunion"],
                    data[i]["hora_reunion"],
                    "<button type='button' class='btn btn-info btn-sm' onclick='verReunionesHistorial(\"" + data[i]["id_reunion"] + "\");' title='ver reuniones'>"+
                    "<i class='far fa-eye'></i></button>&nbsp;"
                  ]);
                }
              } else {
                swal('Error', response.msg[2], 'error');
              }
            }, error: function(jqXHR, textStatus, errorThrown ) {
              swal('Error', textStatus + " " + errorThrown, 'error');
            }
          });
        }else{//ELSE########################################################################################################
          //###############################################################################################################

          accion_agregar = "Ver Temas";
          var table = $('#dataTable_reunionHistorial').dataTable({
            "columnDefs": [
              {"title": "Secretario", "targets": 0, "orderable": false, "className": "dt-body-left", "visible": true},
              {"title": "Fecha creación", "targets": 1, "orderable": false, "className": "dt-body-left","visible": true},
              {"title": "Fecha reunión", "targets": 2, "orderable": false, "className": "dt-body-left"},
              {"title": "hora reunión", "targets": 3, "orderable": false, "className": "dt-body-left"},
              {"title": accion_agregar, "targets": 4, "orderable": false, "className": "dt-body-left","visible": true},
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
            url: '../model/profesor.php',
            data: {accion: 31},
            type: 'POST',
            dataType: 'json',
            async: true,
            success: function(response) {
              if (response.success) {
                var data = response.data;

                for(var i = 0; i < data.length; i++) {

                  table.fnAddData([
                    data[i]["usu_user_name"],
                    data[i]["fecha_creacion"],
                    data[i]["fecha_reunion"],
                    data[i]["hora_reunion"],
                    "<button type='button' class='btn btn-info btn-sm' onclick='verReunionesHistorial(\"" + data[i]["id_reunion"] + "\");' title='Editar'>"+
                    "<i class='far fa-eye'></i></button>&nbsp;"
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
      }else {}
     }, 'json');
}

function verReunionesHistorial(id_reunion){
  //ver sus temas
  var d='';
  var fecha='';
  $.post("../model/profesor.php?accion=2", {id_reunion: id_reunion}, function(response) {
    if (response.success) {
      $.each(response.data, function(index, value) {
        //console.log("id_tema: "+response.data[index]['id_tema']);
        fecha=response.data[index]['fecha_reunion'];
        if(response.data[index]['ruta_documento']){
          $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha+"&nbsp;&nbsp;<a type='button' class='btn btn-dark btn-md' target='_blank' href='"+response.data[index]['ruta_documento']+"'><i class='fas fa-file-pdf'></i></a>");
        }else{
          $("#titulo-modal-reunion").html("Temas de la reunión de la fecha: "+fecha);
        }
        d+='<h3>Tema '+(index+1)+"</h3><h6></h6><br><div style='padding-left:25px;'>"+response.data[index]['descripcion']+'</div><br>';
      });
      $("#form-reunion-secretario").append(d);
      if(response.data.length!='0'){
      $("#titulo-modal-reunion-secretario").html("Temas de la reunión de la fecha: "+fecha);
      }else{
        $("#titulo-modal-reunion-secretario").html("Esta reunión no tiene temas...");
      }
      $("#modal-reunion-secretario").modal("show");
      $("#btn-aceptar-reunion-secretario").attr("onClick", "agregarComentariosTema(\"" + id_reunion + "\")");

    } else {
      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
  $("#form-reunion-secretario").html("");
}

function pasarLista(id_reunion){
  //console.log("entrando a pasar lista con id_reunion = "+id_reunion);
  var d='';
  var fecha='';
  //mstrar listado de profes
  $.post("../model/profesor.php?accion=36&&id_reunion="+id_reunion, function(response) {
    //console.log("response: "+response.data);
    if (response.success) {
      //creando la tabla
      d+="<table class='table'>";
      d+="<thead>";
      d+="<tr>";
      d+="<th>Username</th>";
      d+="<th>Nombres</th>";
      d+="<th>Apellidos</th>";
      d+="<th>Asiste</th>";
      d+="<th>No asiste</th>";
      d+="</tr>";
      d+="</thead>";
      d+="<tbody>";
      $.each(response.data, function(index, value) {
        //console.log("id_tema: "+response.data[index]['id_tema']);
      d+="<tr>";
      d+="<td>"+ response.data[index]['user_name']+"</td>";
      d+="<td>"+ response.data[index]['nombres']+"</td>";
      d+="<td>"+ response.data[index]['apellidos']+"</td>";
      d+="<div class='form-check'>";
      //check a los que ya les pasaron lista
      //console.log("asiste: "+response.data[index]['asiste']);
      if(response.data[index]['asiste']==null){
        //console.log('venia null');
        d+="<td><label class='form-check-label' for='asiste'><input type='radio'  id='"+response.data[index]['user_name']+"' name='"+response.data[index]['user_name']+"' value='t'></td>";
        d+="<td><label class='form-check-label' for='no asiste'><input type='radio'  id='"+response.data[index]['user_name']+"' name='"+response.data[index]['user_name']+"' value='f'></td>";
      }else if(response.data[index]['asiste']==true){
        d+="<td><label class='form-check-label' for='asiste'><input type='radio'  id='"+response.data[index]['user_name']+"' name='"+response.data[index]['user_name']+"' value='t' checked></td>";
        d+="<td><label class='form-check-label' for='no asiste'><input type='radio'  id='"+response.data[index]['user_name']+"' name='"+response.data[index]['user_name']+"' value='f'></td>";
      }else{
        d+="<td><label class='form-check-label' for='asiste'><input type='radio'  id='"+response.data[index]['user_name']+"' name='"+response.data[index]['user_name']+"' value='t'></td>";
        d+="<td><label class='form-check-label' for='no asiste'><input type='radio'  id='"+response.data[index]['user_name']+"' name='"+response.data[index]['user_name']+"' value='f' checked></td>";
      }


      d+="</div>";
      d+="</tr>";
      });
      d+="</tbody>";
      d+="</table>";
      $("#form-pasar-lista").append(d);
      if(response.data.length!='0'){
      $("#titulo-modal-pasar-lista").html("Listado de Invitados");
      }else{
        $("#titulo-modal-pasar-lista").html("Esta reunión no tiene invitados...");
      }
      $("#modal-pasar-lista").modal("show");
      $("#btn-aceptar-pasar-lista").attr("onClick", "agregarListado(\"" + id_reunion + "\")");

    } else {
      swal('Error', response.msg[2], 'error');
    }
  }, 'json');
  $("#form-pasar-lista").html("");
}

function agregarListado(id_reunion){
  var form = $("#form-pasar-lista").serializeArray();
  var id_tema='';
  var comentario_tema='';
  //extraer el user name del secretario
  $.each(form, function(index,field) {
    //console.log("recorriendo form: "+field.value);
    asistencia=field.value;
    user_name=field.name;
    $.post("../model/profesor.php?accion=37&&user_name="+user_name+"&&id_reunion="+id_reunion+"&&asiste="+asistencia, function(response) {
      //console.log("response: "+response.success);
      if (response.success) {
        swal('Listo!','Se ha pasado la lista correctamente','success');
        $("#modal-pasar-lista").modal("hide");
      }else {
          //swal('Error', 'No se agrego el comentario, vuelva a intentarlo.', 'error');
          swal('Error', response.msg[2], 'error');
            }
     }, 'json');
  });

}



function validarTema () {
  if ($('#descripcion').val().trim().length==0) {
    swal('Atención', "La descripción del tema es requerida", 'info');
    return false;
  }
}

function validarReunion () {
  if ($('#fecha_reunion').val().trim().length==0) {
    swal('Atención', "La fecha de la reunión es requerida", 'info');
    return false;
  }
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
