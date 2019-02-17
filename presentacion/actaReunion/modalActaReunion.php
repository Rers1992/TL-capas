<?php
ini_set("session.cookie_lifetime", "7200");
ini_set("session.gc_maxlifetime", "7200");
session_start();
require_once '../../../Library/conexion.php';
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.actaReunion.php";
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.trabajador.php";
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.equipoEmprendedor.php";
$obj_trabajador = new trabajador();
$obj_acta = new actaReunion();
$cuenta = $obj_trabajador->obtieneInfoXId($_SESSION["nick"]);
$v_rut = $cuenta[0][1] . " " . $cuenta[0][2];
$acta = $obj_acta->obtieneInfoXId2();
$fecha = $acta[0][0];
?>
<head>
    <script src="../js/modalActaReunion.js" type="text/javascript"></script>
</head>
<div class="modal-header" id="div-results">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Acta Reunión</h4>
</div>
<div class="modal-body">
    <form id='frm_acta'>
        <table class="highlight bordered order-table table table-bordered">
            <tbody>
                <tr>
                    <td class="col-md-2">
                        <img src="../assets/imagenes/tarapaca.jpg" width="200" height="200"/>
                    </td>
                    <td>
                        <fieldset>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Profesional:</label>  
                                <div class="col-md-8">
                                    <input id="textinput" name="textinput" type="text" value='<?php echo $v_rut; ?>' placeholder="placeholder" class="form-control input-md" disabled>
                                </div>
                            </div><br><br>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Equipo:</label>  
                                <div class="col-md-8">
                                    <SELECT  NAME="profesional" id="profesional"  class="form-control">
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
                                                echo "<option value='" . $usuario[$i]['id_equipo'] . "'> " . $usuario[$i]['nombre_equipo'] . "</option>";
                                            } else {
                                                echo "<option value='" . $usuario[$i]['id_equipo'] . "'> " . $usuario[$i]['nombre_equipo'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </SELECT>
                                </div>
                            </div><br><br>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Fecha:</label>  
                                <div class="col-md-8">
                                    <input id="textinput" name="textinput" type="date" value='<?php echo $fecha; ?>' class="form-control input-md"> 
                                </div>
                            </div><br><br>

                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textarea">Asunto:</label>
                                <div class="col-md-8">                     
                                    <textarea class="form-control" id="textarea" name="textarea"></textarea>
                                </div>
                            </div>

                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <table id="t_empren" class="highlight bordered order-table table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rut</th>
                    <th>Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <div class="col-md-4">
                            <label class="checkbox-inline" for="checkboxes-0">
                                <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1">
                            </label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="highlight bordered order-table table table-bordered">
            <thead>
                <tr>
                    <th>Compromisos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="form-group">                     
                            <textarea class="form-control" id="textarea" name="textarea"></textarea>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class='form-group'>
            <input class='btn btn-primary' type='button' id='btn_regActa' value='Registrar Acta'>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>