<?php
session_start();
//echo "admin: ",$_SESSION['admin'],"<br>";
//echo "director: ",$_SESSION['director'],"<br>";
//echo "secretario: ",$_SESSION['secretario'],"<br>";
if($_SESSION['existe']==""){
  session_start();
  session_unset();
  unset($_SESSION);
  $_SESSION=array();
  session_destroy();
  header("Location:../vista/login.php");
}
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Profesor</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- archivos CSS, los estilos -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css"  />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<link rel="shortcut icon" type="image/x-icon" href="icono" />
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-sm bg-info navbar-dark">
    <ul class="nav justify-content-center">
      <?php
        echo "<li><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Usuario: ",$_SESSION['user_name'],"&nbsp;&nbsp; Nombre: ",$_SESSION['nombres'],"&nbsp;&nbsp;",$_SESSION['apellidos'],"</strong></a></li>";
      ?>

    </ul>
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <!--<a type='button' class='btn btn-dark btn-sm' href='"+response.data[index]['ruta_documento']+"'>&nbsp;&nbsp;PDF&nbsp;&nbsp;</a>-->
    <!--  <a type="button" href="../model/deslogin.php"><button type='button' class='btn btn-info btn-block' role="button" title='Salir'>Cerrar Sesión</button></a>-->
        <a type='button' class='btn btn-info btn-sm' href="../model/deslogin.php">&nbsp;&nbsp;Cerrar Sesión&nbsp;&nbsp;</a>
      </li>
    </ul>
  </nav>


  <div class="container">
  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">

    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" onclick="reunion();" href="#menu1" >Reuniones</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" onclick="reunion_historial();" href="#menu2">Historial</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" onclick="asistencia();" href="#menu3">Asistencia</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  onclick="perfil();"  href="#menu4">Perfil</a>
    </li>
    <?php
    if($_SESSION['admin']=="t"){
    echo "<li class='nav-item dropdown'>";
    echo "<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#'>Administración</a>";
    echo "<div class='dropdown-menu'>";
      echo "<a class='dropdown-item' data-toggle='tab' onclick='profesores();' href='#menu5'>Profesores</a>";
      echo "<a class='dropdown-item' data-toggle='tab' onclick='director();' href='#menu6'>Director</a>";
      echo "<a class='dropdown-item' data-toggle='tab' onclick='admin();' href='#menu7'>Admin</a>";
    echo "</div>";
    echo "</li>";
    }
    if($_SESSION['director']=="t"){
    echo "<li class='nav-item'>";
      echo "<a class='nav-link' data-toggle='tab' onclick='secretario();' href='#menu8'>Secretario</a>";
    echo "</li>";
    }

    ?>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" onclick="contrasena();" href="#menu9">Contraseña</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
        <div id="menu1" class="container tab-pane active"><br>
          <!-- workspace  profesores-->
          <div id="container-reunion" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table id="dataTable_reunion" class="display table compact nowrap"></table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="menu2" class="container tab-pane fade"><br>
          <div id="container-reunion-historial" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table id="dataTable_reunionHistorial" class="display table compact nowrap"></table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div id="menu3" class="container tab-pane fade"><br>
          <!-- workspace  profesores-->
          <div id="container-asistencia" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div id="panel-body-asistencia" class="panel-body">
                    <div id="estadistica-asistencia">

                    </div>

                    <div class="table-responsive">
                      <table id="dataTable_asistencia" class="display table compact nowrap"></table>
                    </div>

                    <canvas id="pie-chart-asistencia" width="800" height="400"></canvas>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="menu4" class="container tab-pane fade"><br>
          <div id="container-perfil" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div id="panel-body-perfil" class="panel-body">
                    <h4>&nbsp;&nbsp;Cambiar Perfil.</h4>
                    <form id="form-cambioPerfil" role="form" method="post" enctype="multipart/form-data">

                      <div class="form-group col-lg-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="nombres">Nombres: *.</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" data-required="true">
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-lg-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="apellidos">Apellidos: *.</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" data-required="true">
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-lg-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="correo">Correo: *.</label>
                        <input type="text" class="form-control" id="correo" name="correo" data-required="true">
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-lg-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="celular">Teléfono: *.</label>
                        <input type="text" class="form-control" id="celular" name="celular" data-required="true">
                      </div>
                      <div class="clearfix"></div>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <button type='button' class='btn btn-success btn-sm' onclick='cambiarPerfil();' title='cambiar perfil'>Cambiar Perfil</button>&nbsp;
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="menu5" class="container tab-pane fade"><br>
          <!-- workspace  profesores-->
          <div id="container-profesores" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table id="dataTable_profesor" class="display table compact nowrap"></table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="menu6" class="container tab-pane fade"><br>
          <!-- workspace  profesores-->
          <div id="container-director" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div id="panel-body-director" class="panel-body">asd</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="menu7" class="container tab-pane fade"><br>
          <!-- workspace  profesores-->
          <div id="container-admin" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div id="panel-body-admin" class="panel-body"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="menu8" class="container tab-pane fade"><br>

          <div id="container-asignar-secretario" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div id="panel-body-asignar-secretario" class="panel-body">asd</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="menu9" class="container tab-pane fade"><br>
          <div id="container-contrasena" class="container-fluid" style="display: none;" >
            <div class="row">
              <div class="col-lg12">
                <div class="panel panel-info">
                  <div id="panel-body-contrasena" class="panel-body">
                    <h4>&nbsp;&nbsp;Cambiar contraseña.</h4>
                    <form id="form-cambioContrasena" role="form" method="post" enctype="multipart/form-data">

                      <div class="form-group col-lg-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="contrasena_antigua">Ingrese su contraseña actual.</label>
                        <input type="password" class="form-control" id="contrasena_antigua" name="contrasena_antigua" data-required="true">
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-lg-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="contrasena_nueva">Ingrese contraseña nueva.</label>
                        <input type="password" class="form-control" id="contrasena_nueva" name="contrasena_nueva" data-required="true">
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group col-lg-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="contrasena_nueva2">Repita la contraseña nuevamente.</label>
                        <input type="password" class="form-control" id="contrasena_nueva2" name="contrasena_nueva2" data-required="true">
                      </div>
                      <div class="clearfix"></div>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <button type='button' class='btn btn-success btn-sm' onclick='cambiarContrasena();' title='cambiar contraseña'>Cambiar contraseña</button>&nbsp;
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>


  <div class="modal" id="modal-cambiar-secretario" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- header modal -->
            <div class="modal-header">
              <h4 class="modal-title"><span id="titulo-modal-cambiar-secretario"></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            </div>

            <!-- body modal-->
            <div class="modal-body">
              <div class="table-responsive">
                <table id="dataTable_posiblesecretario" class="display table compact nowrap"></table>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>
            </div>


          </div>
        </div>
      </div>


  <!-- modals reunion-->

  <div class="modal" id="modal-reunion" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

            <!-- header modal -->
            <div class="modal-header">
              <h4 class="modal-title"><span id="titulo-modal-reunion"></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            </div>
            <!-- body modal-->
            <div id="modal-ody-reunion" class="modal-body">
              <form id="form-reunion-votacion" role="form" method="post" enctype="multipart/form-data">
              </form>

            </div>
            <!-- footer modal -->

            <div class="modal-footer">
              <button type="button" class="btn btn-danger " id="btn-finalizar-reunion" style="display: none;">Ver otros profesores</button>
              <button type="button" class="btn btn-primary " id="btn-aceptar-reunion">Aceptar</button>
              <button type="button" class="btn btn-secondary " data-dismiss="modal">Cancelar</button></div>

        </div>

      </div>

    </div>


    <div class="modal" id="modal-reunion-secretario" tabindex="-1" role="dialog">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">

              <!-- header modal -->
              <div class="modal-header">
                <h4 class="modal-title"><span id="titulo-modal-reunion-secretario"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              </div>
              <!-- body modal-->
              <div id="modal-body-reunion-secretario" class="modal-body">
                <form id="form-reunion-secretario" role="form" method="post" enctype="multipart/form-data">

                </form>

              </div>
              <!-- footer modal -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary " id="btn-aceptar-reunion-secretario">Aceptar</button>
                <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>
              </div>

          </div>

        </div>

      </div>





    <!-- modals profesor-->
     <div class="modal" id="modal-profesor" tabindex="-1" role="dialog">
       <div class="modal-dialog modal-lg">
         <div class="modal-content">
           <!-- header modal -->
           <div class="modal-header">

             <h4 class="modal-title"><span id="titulo-modal-profesor"></span></h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span></button>
           </div>

           <!-- body modal-->
           <div class="modal-body">

             <section class="row justify-content-center">
               <section class="col-12 col-sm-8 col-md-10" >
               <form id="form-profesor" role="form" method="post" enctype="multipart/form-data">
                 <section class="col-12 col-sm-6 col-md-8" >
                 <div>
                   <label for="user_name"> Username: *</label>
                   <input type="text" class="form-control" id="user_name_profesores" name="user_name"  data-required="true">

                   <label for="nombres">Nombres: *</label>
                   <input type="text" class="form-control" id="nombres_profesores" name="nombres" data-required="true">

                   <label for="apellidos">Apellidos: *</label>
                   <input type="text" class="form-control" id="apellidos_profesores" name="apellidos" data-required="true">

                   <label for="correo">Correo: *</label>
                   <input type="text" class="form-control" id="correo_profesores" name="correo" data-required="true">

                   <label for="celular">Teléfono: *</label>
                   <input type="text" class="form-control" id="celular_profesores" name="celular" data-required="true">
                 </div>



                 <div >
                   <label>* datos obligatorios.</label>
                 </div>

               </form>
               <!-- footer modal -->
               <div class="modal-footer">

                 <button type="button" class="btn btn-primary " id="btn-aceptar-profesor">Aceptar</button>
                 <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>

               </div>
               </section>
               </section>
             </div>
           </div>


         </div>

       </div><!-- fin del modal -->


       <!-- modals profesor editar-->
        <div class="modal" id="modal-profesor-editar" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <!-- header modal -->
              <div class="modal-header">

                <h4 class="modal-title"><span id="titulo-modal-profesor-editar"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              </div>

              <!-- body modal-->
              <div class="modal-body">

                <section class="row justify-content-center">
                  <section class="col-12 col-sm-8 col-md-10" >
                  <form id="form-profesor-editar" role="form" method="post" enctype="multipart/form-data">
                    <section class="col-12 col-sm-6 col-md-8" >
                    <div>

                      <label for="nombres">Nombres: *</label>
                      <input type="text" class="form-control" id="nombres" name="nombres" data-required="true">

                      <label for="apellidos">Apellidos: *</label>
                      <input type="text" class="form-control" id="apellidos" name="apellidos" data-required="true">

                      <label for="correo">Correo: *</label>
                      <input type="text" class="form-control" id="correo" name="correo" data-required="true">

                      <label for="celular">Teléfono: *</label>
                      <input type="text" class="form-control" id="celular" name="celular" data-required="true">
                    </div>



                    <div >
                      <label>* datos obligatorios.</label>
                    </div>

                  </form>
                  <!-- footer modal -->
                  <div class="modal-footer">

                    <button type="button" class="btn btn-primary " id="btn-aceptar-profesor-editar">Aceptar</button>
                    <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>

                  </div>
                  </section>
                  </section>
                </div>
              </div>


            </div>

          </div><!-- fin del modal -->


       <!-- modals director-->
        <div class="modal" id="modal-director" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <!-- header modal -->
                  <div class="modal-header">
                    <h4 class="modal-title"><span id="titulo-modal-director"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  </div>

                  <!-- body modal-->
                  <div class="modal-body">
                    <div class="table-responsive">
                      <table id="dataTable_posibledirector" class="display table compact nowrap"></table>
                    </div>
                  </div>
                  <!-- footer modal -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>
                  </div>


                </div>
              </div>
            </div>

          </div><!-- fin del modal -->


          <!-- modals admin-->
           <div class="modal" id="modal-admin" tabindex="-1" role="dialog">
             <div class="modal-dialog modal-lg">
               <div class="modal-content">
                 <!-- header modal -->
                     <div class="modal-header">
                       <h4 class="modal-title"><span id="titulo-modal-admin"></span></h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span></button>
                     </div>

                     <!-- body modal-->
                     <div class="modal-body">
                       <div class="table-responsive">
                         <table id="dataTable_posibleadmin" class="display table compact nowrap"></table>
                       </div>
                     </div>
                     <!-- footer modal -->
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>
                     </div>


                   </div>
                 </div>
               </div>

             </div><!-- fin del modal -->


             <!-- modals admin-->
              <div class="modal" id="modal-finalizar-reunion" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- header modal -->
                        <div class="modal-header">
                          <h4 class="modal-title"><span id="titulo-modal-finalizar-reunion">Acuerdo de profesores.</span></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        </div>

                        <!-- body modal-->
                        <div class="modal-body">
                          <div class="table-responsive">
                            <table id="dataTable_finalizarReunion" class="display table compact nowrap"></table>
                          </div>
                        </div>
                        <!-- footer modal -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger " id="btn-aceptar-finalizar-reunion">Dar por terminada la reunión</button>
                          <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>
                        </div>


                      </div>
                    </div>

                </div><!-- fin del modal -->

                <!-- modals admin-->
                 <div class="modal" id="modal-invitados-votaciones" tabindex="-1" role="dialog">
                   <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                       <!-- header modal -->
                           <div class="modal-header">
                             <h4 class="modal-title"><span id="titulo-modal-invitados-votaciones">Acuerdo de profesores.</span></h4>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span></button>
                           </div>

                           <!-- body modal-->
                           <div class="modal-body" id="modal-body-invitados-votaciones">

                           </div>
                           <!-- footer modal -->
                           <div class="modal-footer">
                             <button type="button" class="btn btn-danger " data-dismiss="modal">Salir</button>
                           </div>


                         </div>
                       </div>

                   </div><!-- fin del modal -->



          <!-- modals nueva reunion-->
           <div class="modal" id="modal-nueva-reunion" tabindex="-1" role="dialog">
             <div class="modal-dialog modal-lg">
               <div class="modal-content">
                 <!-- header modal -->
                 <div class="modal-header">

                   <h4 class="modal-title"><span id="titulo-modal-nueva-reunion">Creando nueva reunión</span></h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span></button>
                 </div>

                 <!-- body modal-->
                 <div class="modal-body">

                   <section class="row justify-content-center">
                     <section class="col-12 col-sm-8 col-md-10" >
                     <form  id="form-nueva-reunion" role="form" method="post" enctype="multipart/form-data">
                           <section class="col-12 col-sm-6 col-md-8" >
                           <div>
                             <label for="fecha_reunion"> Fecha Reunión: *</label>
                             <input type="text" class="form-control" id="fecha_reunion" name="fecha_reunion"  data-required="true">
                           </div>
                           <div>
                             <label for="hora_reunion"> Hora Reunión: *</label>
                             <input type="text" class="form-control" id="hora_reunion" name="hora_reunion"  data-required="true">
                           </div>
                           <div>
                             <br>
                             <label for="documento"> Subir documento(jpeg, jpg, png, pdf, zip), dispone de 20MB como máximo: </label>
                             <input type="file" class="form-control"  name="documento" id="documento">
                             <div id="documento-subido"></div>
                           </div>

                           <div >
                             <br>
                             <br>
                             <br>
                             <label>* datos obligatorios.</label>
                           </div>
                          </section>
                     </form>


                     </section>
                  </section>
                     <!-- footer modal -->
                     <div class="modal-footer">

                       <button type="button" class="btn btn-primary " id="btn-aceptar-nueva-reunion">Aceptar</button>
                       <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>

                     </div>

                   </div>
                 </div>


               </div>

             </div><!-- fin del modal -->


             <!-- modals nueva reunion-->
              <div class="modal" id="modal-asignar-temas" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                        <!-- header modal -->
                        <div class="modal-header">
                          <h4 class="modal-title"><span id="titulo-modal-asignar-temas">Administrar temas</span></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        </div>
                          <!-- body modal -->
                        <div class="modal-body">
                          <div class="table-responsive">
                            <table id="dataTable_asignarTemas" class="display table compact nowrap"></table>
                          </div>
                        </div>
                        <!-- footer modal -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary " data-dismiss="modal">Salir</button>
                        </div>

                      </div>


                  </div>

                </div><!-- fin del modal -->


                <!-- modals nueva reunion-->
                 <div class="modal" id="modal-asignar-tema" tabindex="-1" role="dialog">
                   <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                       <!-- header modal -->
                       <div class="modal-header">

                         <h4 class="modal-title"><span id="titulo-modal-asignar-tema">Creando nuevo tema</span></h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span></button>
                       </div>

                       <!-- body modal-->
                       <div class="modal-body">

                         <section class="row justify-content-center">
                           <section class="col-12 col-sm-8 col-md-10" >
                           <form id="form-asignar-tema" role="form" method="post" enctype="multipart/form-data">
                                 <section class="col-12 col-sm-6 col-md-8" >
                                 <div>
                                   <label for="descripcion"> Descripción: *</label>
                                   <textarea type="text" class="form-control" id="descripcion" rows="5" cols=" 15" name="descripcion"  data-required="true"></textarea>
                                 </div>

                                 <div >
                                   <label>* datos obligatorios.</label>
                                 </div>
                                </section>
                           </form>


                           </section>
                        </section>
                           <!-- footer modal -->
                           <div class="modal-footer">

                             <button type="button" class="btn btn-primary " id="btn-aceptar-asignar-tema">Aceptar</button>
                             <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>

                           </div>

                         </div>
                       </div>


                     </div>

                   </div><!-- fin del modal -->


                   <!-- modals invitados-->
                    <div class="modal" id="modal-invitados" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <!-- header modal -->
                          <div class="modal-header">

                            <h4 class="modal-title"><span id="titulo-modal-invitados"></span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          </div>

                          <!-- body modal-->
                          <div class="modal-body-invitados">

                              <section class="col-12 col-sm-6 col-md-8" >
                              <form id="form-invitados" role="form" method="post" enctype="multipart/form-data">
                                
                              </form>
                            </section>
                              <!-- footer modal -->
                              <div class="modal-footer">

                                <button type="button" class="btn btn-primary " id="btn-aceptar-invitados">Aceptar</button>
                                <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>

                              </div>

                            </div>
                          </div>


                        </div>

                      </div><!-- fin del modal -->


                      <!-- modals pasar lista-->
                       <div class="modal" id="modal-pasar-lista" tabindex="-1" role="dialog">
                         <div class="modal-dialog modal-md">
                           <div class="modal-content">
                             <!-- header modal -->
                             <div class="modal-header">

                               <h4 class="modal-title"><span id="titulo-modal-pasar-lista"></span></h4>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span></button>
                             </div>

                             <!-- body modal-->
                             <div class="modal-body-pasar-lista">

                                 <section class="col-12 col-sm-6 col-md-8" >
                                 <form id="form-pasar-lista" role="form" method="post" enctype="multipart/form-data">

                                 </form>
                               </section>
                                 <!-- footer modal -->
                                 <div class="modal-footer">

                                   <button type="button" class="btn btn-primary " id="btn-aceptar-pasar-lista">Aceptar</button>
                                   <button type="button" class="btn btn-secundary " data-dismiss="modal">Cancelar</button>

                                 </div>

                               </div>
                             </div>


                           </div>

                         </div><!-- fin del modal -->


  <!-- archivos javascripts -->

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" ></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

  <script src="../js/profesor.js"></script>
  <script src="../js/admin.js"></script>
  <!--<script type="text/javascript">$( function() {$( "#fecha_inicio" ).datepicker({dateFormat:'yy-mm-dd',minDate: 0});$( "#fecha_termino" ).datepicker({dateFormat:'yy-mm-dd',minDate: 0});} );</script>-->

</body>
</html>
