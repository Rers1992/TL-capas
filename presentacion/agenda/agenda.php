<?php
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.trabajador.php";
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.agenda.php";
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.actividad.php";
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.equipoEmprendedor.php";
?>
<html lang="en">

    <head>
        <?php
        ini_set("session.cookie_lifetime", "7200");
        ini_set("session.gc_maxlifetime", "7200");
        session_start();
        if (!isset($_SESSION["nick"])) {
            header("Location:../../index.php?usuario=sin_permiso");
            ?>
            Debe iniciar session para acceder a este contenido

            <?php
        }
        ?>
        <meta charset="utf-8">
        <link href='agenda/calendario/fullcalendar.min.css' rel='stylesheet' />
        <link href='agenda/calendario/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <link href="bootstrap-3.3.7-dist/css/bootstrap-select.css" rel="stylesheet" type="text/css"/>
        <script src='agenda/calendario/lib/jquery.min.js'></script>
        <script src='agenda/calendario/lib/jquery-ui.min.js'></script>
        <script src='agenda/calendario/lib/moment.min.js'></script>			
        <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
        <script src='agenda/calendario/fullcalendar.min.js'></script>
        <script src='agenda/calendario/locale/es.js'></script>
        <script src="bootstrap-3.3.7-dist/js/validarRut.js" type="text/javascript"></script>
        <link href="bootstrap-3.3.7-dist/css/estilo-modal-tresCampos.css" rel="stylesheet" type="text/css"/>
        <script src="../js/agenda.js" type="text/javascript"></script>
        <script src="../js/bootbox.min.js" type="text/javascript"></script>
        <style>
            body {
                padding: 0;
                font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
                font-size: 15px;
            }

            #calendar {
                max-width: 1100px;
                margin: 0 auto;
            }

            .fc-agendaWeek-view tr {
                height: 61px;
            }

            .fc-agendaDay-view tr {
                height: 61px;
            }
        </style>

    </head>
    <!-- CUERPO -->
    <body>
        <div id="contenido">
            <div id="page-wrapper">
                <div class="row">
                    <div class="container striped" style="width:90%; word-wrap: break-word;">
                        <div class="row">
                            <div class="col s4 offset-s4 ">
                                <div class="card" style="background-color: rgba(255, 255,255, 0.90);" class="center-align" >
                                    <div class="card-content" >				
                                        <div class="col-sm-4 col-md-3" ><h1><br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;Agenda de:
                                                </div>
                                                <div class="form-group col-sm-4 col-md-6" ><br><br><br>
                                                    <form action="" method="post" id="formu">
                                                        <SELECT  NAME="profesional" id="profesional"  class="form-control">
                                                            <option value="0"> Seleccione un profesional </option>
                                                            <!-- SELECT BONITO QUE NO DESAPARECE class="selectpicker" -->
                                                            <?php
                                                            $pag = new trabajador();
                                                            $usuario = $pag->obtieneInfo();
                                                            $prof = '';
                                                            if (isset($_POST['profesional'])) {
                                                                $prof = $_POST['profesional'];
                                                            }
                                                            for ($i = 0; $i < count($usuario); $i++) {
                                                                if ($prof == $usuario[$i]['rut']) {
                                                                    echo "<option value='" . $usuario[$i]['rut'] . "' selected> " . $usuario[$i]['nombre'] . " " . $usuario[$i]['apellidos'] . "</option>";
                                                                } else {
                                                                    echo "<option value='" . $usuario[$i]['rut'] . "'> " . $usuario[$i]['nombre'] . " " . $usuario[$i]['apellidos'] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </SELECT>
                                                        <div id="submit_esc" style="display:none;">
                                                            <input type="submit" value="Submit">
                                                        </div>

                                                    </form>
                                                </div></h1><br><br><br><br><br><br><br>

                                            <script>
                                                $(document).ready(function () {
                                                    $('#profesional').change(
                                                            function () {
                                                                //$('#formu').submit();
                                                                $.ajax({
                                                                    url: "agenda/agenda.php",
                                                                    type: "POST",
                                                                    dataType: "HTML",
                                                                    data: ({auth: $("#auth").val(),
                                                                        profesional: $("#profesional").val()
                                                                    }),
                                                                    success: function (p_html) {
                                                                        $("#contenido").html(p_html);
                                                                    },
                                                                    error: function (objeto, quepaso) {
                                                                        //alert("ERROR: PasÃƒÂ³ lo siguiente-> "+quepaso);
                                                                        seteaDialog('error', "ERROR: PasÃƒÂ³ lo siguiente-> " + quepaso, v_msj, '');
                                                                    }
                                                                });/**/
                                                            });
                                                    $('#calendar').fullCalendar({
                                                        header: {
                                                            left: 'prev,next',
                                                            center: 'title',
                                                            right: 'month,agendaWeek,agendaDay,listWeek'
                                                        },
                                                        navLinks: true, // puedes dar clic en dia o semana para navegar
                                                        selectable: true,
                                                        selectHelper: true,
                                                        select: function (start, end, jsEvent, view) {
                                                            if (view.name == 'month') {
                                                                $('#calendar').fullCalendar('changeView', 'agendaWeek');
                                                                $('#calendar').fullCalendar('gotoDate', start)
                                                            } else {
                                                                document.getElementById("reserva").value = start.format('DD/MM/YYYY HH:mm');
                                                                document.getElementById("prof").value = document.getElementById("profesional").value;
                                                                document.getElementById("reservaf").value = start.format('DD/MM/YYYY HH:mm');

                                                                document.getElementById("idagn").value = start.id;
                                                                document.getElementById("proff").value = document.getElementById("profesional").value;
                                                                if (document.getElementById("prof").value != 0)
                                                                    $("#seleccionRE").modal("show");
                                                            }
                                                            $('#calendar').fullCalendar('unselect');
                                                        },
                                                        editable: false, //puedes mover las fechas
                                                        eventLimit: true, // para que si esta muy lleno el dÃƒÆ’Ã‚Â­a pueda abrir un modal con detalle
                                                        timeFormat: 'H:mm', //formato de tiempo
                                                        defaultTimedEventDuration: '01:00:00', //tiempo de duracion por defecto
                                                        allDaySlot: false,
                                                        slotDuration: '01:00:00',
                                                        //selectOverlap: false,
                                                        slotEventOverlap: false,
                                                        defaultView: 'agendaWeek',
                                                        hiddenDays: [0], //no mostrara domingo
                                                        minTime: "09:00:00",
                                                        maxTime: "19:00:00",
                                                        eventClick: function (calEvent, jsEvent, view) {

                                                            document.getElementById("reserva2").value = calEvent.start.format('DD/MM/YYYY HH:mm');
                                                            document.getElementById("reservaf2").value = calEvent.start.format('DD/MM/YYYY HH:mm');
                                                            document.getElementById("telefono2").value = calEvent.telefono;
                                                            document.getElementById("id2").value = calEvent.id;
                                                            $("#nombre2 option:selected").text(calEvent.title);

                                                            //document.getElementById("nombre2").value = calEvent.title;
                                                            document.getElementById("prof2").value = document.getElementById("profesional").value;
                                                            document.getElementById("proff2").value = document.getElementById("profesional").value;
                                                            if (calEvent.type == 'agenda') {
                                                                $("#editarHora").modal("show");
                                                            }
                                                            /*
                                                             alert('Event: ' + calEvent.title);
                                                             alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                                                             alert('View: ' + view.name);
                                                             */
                                                            // change the border color just for fun
                                                        },
                                                        events: [
<?php
$pag = new agenda();
$act = new actividad();
$rut_profe = $prof;
if ($rut_profe != 0) {
    $horas = $pag->obtieneInfoXId($rut_profe);
    for ($i = 0; $i < count($horas); $i++) {
        echo '					{
                                                                "type": "agenda",
                                "title": "' . $horas[$i]['nombre_reserva'] . '",
                                "id": "' . $horas[$i]['id'] . '",
                                "start": "' . $horas[$i]['hora_inicio'] . '",
                                "telefono": "' . $horas[$i]['telefono_reserva'] . '"
                                                                },
                        ';
    }

    $horas = $act->obtieneInfoXRUT($rut_profe);
    //print_r($horas);
    for ($i = 0; $i < count($horas); $i++) {
        echo '					{
                                                                "color"	: "#79DED7",
                                                                "type": "actividad",
                                "title": "' . $horas[$i]['act_nombre'] . '",
                                "id": "' . $horas[$i]['act_corr'] . '",
                                "start": "' . $horas[$i]['act_fech_reg'] . '"
                                                                },
                        ';
    }
}
?>
                                                            {
                                                                id: 'a', //BLOQUEO DE LAS HORAS FUERA DE LAS HORAS DE TRABAJADOR
                                                                className: 'fc-business',
                                                                start: '20:00',
                                                                end: '24:00',
                                                                dow: [1, 2, 3, 4, 5, 6],
                                                                rendering: 'inverse-background'
                                                            },
                                                            {
                                                                id: 'a',
                                                                className: 'fc-business',
                                                                start: '00:00',
                                                                end: '08:00',
                                                                dow: [1, 2, 3, 4, 5, 6],
                                                                rendering: 'inverse-background'
                                                            }

                                                        ]
                                                    });
                                                });

                                            </script>

                                            <div id='calendar'></div>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<a type='button' name="agregar" href='agenda/reporte.php?inicio=2018-01-01&final=2018-01-31' value='Generar Reporte' style="background:#01579b" class="btn btn-primary pull-left" target="_blank" >Generar Reporte</a>-->
                        <button type="button" class="btn btn-primary pull-left" onclick='fn_generarReporte()' >Generar Reporte</button>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="seleccionRE" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="" id="equis1" >&times;</button>
                            <h4 class="modal-title">Seleccion</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario para reserva-->
                            <div class="form-group col-md-12">
                                <div class="col-md-4">
                                    <input type="button" onclick="fn_abreFormReserva()" value='Reservar Hora' class="btn btn-primary" style="background:#0288d1">
                                </div>
                            </div><br>
                            <div class="form-group col-md-12">
                                <div class="col-md-4">
                                    <input type="button" onclick="fn_abreFormEvidencia()" value='Subir Evidencia' class="btn btn-primary" style="background:#0288d1">
                                </div>
                            </div><br><br><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-right" data-dismiss="">Cerrar</button>
                        </div>
                    </div>
                    <!-- Fin Modal content-->

                </div>
            </div>
            <!-- Modal AGREGAR -->
            <div class="modal fade" id="reservarHora" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="" id="equis2">&times;</button>
                            <h4 class="modal-title">Reserva de hora</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario para reserva-->
                            <form id='frm_agenda'>
                                <div class="form-group col-md-12">    
                                    <label for="proff">
                                        Rut del Profesional:</label> <br>
                                    <input name="proff" id="proff" maxlength="256" required="required" id="reserva" class="active validate form-control" disabled>
                                    <input name="prof" type="hidden" id="prof" maxlength="256" required="required" id="reserva" class="active validate form-control">
                                </div><br>

                                <div class="form-group col-md-12">    
                                    <label for="reservaf">
                                        Hora a reservar:</label> <br>
                                    <input name="reservaf" id="reservaf" maxlength="256" required="required" id="reserva" class="active validate form-control" disabled>
                                    <input name="reserva" type="hidden" id="reserva" maxlength="256" required="required" id="reserva" class="active validate form-control">
                                </div><br>

                                <div class="form-group col-md-12">
                                    <label for="reservaf">
                                        Nombre de equipo:</label> <br>
                                    <SELECT  NAME="equipo" id="nombre"  class="form-control">
                                        <option value="0"> Seleccione un equipo </option>
                                        <!-- SELECT BONITO QUE NO DESAPARECE class="selectpicker" -->
                                        <?php
                                        $pag = new equipoEmprendedor();
                                        $usuario = $pag->obtieneInfo();
                                        $prof = '';
                                        if (isset($_POST['profesional'])) {
                                            $prof = $_POST['profesional'];
                                        }
                                        for ($i = 0; $i < count($usuario); $i++) {
                                            if ($prof == $usuario[$i]['rut']) {
                                                echo "<option value='" . $usuario[$i]['id_equipo'] . "' selected> " . $usuario[$i]['nombre_equipo'] . "</option>";
                                            } else {
                                                echo "<option value='" . $usuario[$i]['id_equipo'] . "'> " . $usuario[$i]['nombre_equipo'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </SELECT>
                                </div><br>
                                <div class="form-group col-md-12">  
                                    <label class="left-align" for="telefono">
                                        Telefono: </label><br> 
                                    <input onkeypress="return soloNumeros(event);" type="text" id="telefono" name="telefono" maxlength="12" class="activate validate form-control" pattern="^[+0-9]*$" required>         
                                </div>
                                <br><br><br><br><br><br><br><br><br><br><br><br><br>
                                <div class="modal-footer">
                                    <input type='button' name="agregar" id='btn_regAgenda' value='Agregar' style="background:#01579b" class="btn btn-primary pull-left" ></input>
                                    <button type="button" class="btn btn-default pull-right" data-dismiss="" id="equis22">Cerrar</button>
                                </div>
                            </form>


                        </div>
                    </div>
                    <!-- Fin Modal content-->

                </div>
            </div>
            <!-- Fin Modal -->

            <!-- Modal EDITAR -->
            <div class="modal fade" id="editarHora" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="" id="equis3">&times;</button>
                            <h4 class="modal-title">Reserva de hora</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario para reserva-->
                            <form id='frm_editAgenda'>
                                <div class="form-group col-md-12">    
                                    <label for="proff2">
                                        Rut del Profesional:</label> <br>
                                    <input name="proff2" type="text" id="proff2" maxlength="256" required="required" id="reserva" class="active validate form-control" disabled>
                                    <input name="prof" type="hidden" id="prof2" maxlength="256" required="required" id="reserva" class="active validate form-control">
                                </div><br>

                                <div class="form-group col-md-12">    
                                    <label for="reservaf">
                                        Hora a reservar:</label> <br>
                                    <input name="reservaf" type="text" id="reservaf2" maxlength="256" required="required" id="reserva" class="active validate form-control" disabled>
                                    <input name="reserva" type="hidden" id="reserva2" maxlength="256" required="required" id="reserva" class="active validate form-control">
                                </div><br>

                                <input name="id2" type="hidden" id="id2">
                                <div class="form-group col-md-12">
                                    <label for="nombre2">
                                        Nombre de equipo: </label><br>
                                    <SELECT  NAME="equipo" id="nombre2"  class="form-control">
                                        <option value="0"> Seleccione un equipo </option>
                                        <!-- SELECT BONITO QUE NO DESAPARECE class="selectpicker" -->
                                        <?php
                                        $pag = new equipoEmprendedor();
                                        $usuario = $pag->obtieneInfo();
                                        $prof = '';
                                        if (isset($_POST['profesional'])) {
                                            $prof = $_POST['profesional'];
                                        }
                                        for ($i = 0; $i < count($usuario); $i++) {
                                            if ($prof == $usuario[$i]['rut']) {
                                                echo "<option value='" . $usuario[$i]['id_equipo'] . "' selected> " . $usuario[$i]['nombre_equipo'] . "</option>";
                                            } else {
                                                echo "<option value='" . $usuario[$i]['id_equipo'] . "'> " . $usuario[$i]['nombre_equipo'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </SELECT>
                                </div><br>

                                <div class="form-group col-md-12">  
                                    <label class="left-align" for="telefono">
                                        Telefono: </label><br> 
                                    <input onkeypress="return soloNumeros(event);" type="text" id="telefono2" name="telefono" maxlength="12" class="activate validate form-control" pattern="^[+0-9]*$" required>         
                                </div>
                                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>


                                <div class="modal-footer">
                                    <input type='button' name="Modificar" value="Modificar" id='btn_modAgenda' style="background:#01579b" class="btn btn-primary pull-right" ></input>
                                    <input type='button' name="Eliminar" value="Eliminar" id="btn_eliAgenda" style="background:#FF0000" class="btn btn-primary pull-left" ></input>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Fin Modal content-->

                </div>
            </div>
            <!-- Fin Modal -->


            <div id="dataModal" class="modal fade">  
                <div class="modal-dialog">  
                    <div class="modal-content">
                        <div class="modal-body" id="employee_detail">  
                            <div class="modal-header" id="div-results">
                                <button type="button" class="close" data-dismiss="" aria-label="Close"  id="equis4"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Actividad</h4>
                            </div>
                            <div class="modal-body">
                                <form >
                                    <div class="">
                                        <label for="exampleInputEmail1">Nombre de la actividad</label>
                                        <input type="text" class="form-control" id="nombreact"  placeholder="">
                                    </div>
                                    <div class="">
                                        <label for="exampleInputEmail1">Descripci&oacute;n de la actividad</label>
                                        <input type="text" class="form-control" id="descripcionact"  placeholder="">
                                        <input type="hidden" id="idagn">
                                    </div>
                                    <div class="">
                                        <label for="exampleInputEmail1">Evidencias</label>
                                        <div id="emp_table">
                                            <table id="t_evidencias" class="highlight bordered order-table table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Archivo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <input class='btn' style="background-color:transparent; color:#428bca" type='button' onclick='fn_addEvidencia()' value='+Evidencia'>
                                        </div>
                                    </div>
                                    <p></p>
                                    <div class='form-group'>
                                        <input class='btn btn-primary' type='submit' value='Registrar actividad' onclick='fn_regActividad()'>

                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="" id="equis44">Cerrar</button>
                            </div>
                        </div> 
                    </div>  
                </div>  
            </div>  
            <div id="dataModal2" class="modal fade">  
                <div class="modal-dialog">  
                    <div class="modal-content">
                        <div class="modal-body" id="employee_detail2">  
                            <div class="modal-header" id="div-results">
                                <button type="button" class="close" data-dismiss="" aria-label="Close"  id="equis5"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Evidencia</h4>
                            </div>
                            <div class="modal-body">
                                <form id='frm_convhist'  enctype="multipart/form-data" action="http://www.google.cl" method="POST">

                                    <div class="">
                                        <label for="rut">T&iacute;tulo de imagen</label>
                                        <input type="text" class="form-control" id="nombreevd"  placeholder="">
                                    </div>
                                    <div class="">
                                        <label for="exampleInputEmail1">Pie de imagen</label>
                                        <input type="text" class="form-control" id="descevd"  placeholder="">
                                    </div>

                                    <div class="">
                                        <br> 
                                        <label for="exampleInputEmail1">Archivo</label>
                                        <input type="file" id="archivo" name="archivo"  class="file" data-show-preview="false" />
                                    </div>
                                    <br> <br> 

                                    <div class='form-group'>
                                        <input class='btn btn-primary' type='submit' id='btn_regEvidencia' value='Registrar evidencia'>

                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss=""   id="equis55">Cerrar</button>
                            </div>
                        </div> 
                    </div>  
                </div>  
            </div>
    </body>

    <?php
    // } else {
    //header('Location: http://acinfo.inf.unap.cl/~eriveros/ConsultaParticular/presentacion/');
//} 
    ?>

</html>
