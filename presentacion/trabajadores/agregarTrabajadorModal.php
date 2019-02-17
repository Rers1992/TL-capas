<?php
/* session_start();
  if (!isset($_SESSION["nick"])) {
  header("Location:../index.php?usuario=sin_permiso");
  ?>
  Debe iniciar session para acceder a este contenido

  <?php
  }
  /* *
 * FORMULARIO DE INGRESO DE TRABAJADOR
 * */
require_once '../../../Library/conexion.php';
require_once realpath(dirname(__FILE__)) . "/../../../negocio/class.trabajador.php";

$obj_trabajador = new trabajador();

$v_btn_guardar = "Registrar Trabajador";
$v_btn_trabajador = "btn_regTrabajador";
$v_rut = "";
$v_nombre = "";
$v_apellidoPaterno = "";
$v_cargo = "";
$v_telefono = "";
$v_ciudad = "";
$v_direccion = "";
$v_mail = "";
$v_contrasena = "";
$v_permisos = "Escoger...";
$v_estado = "Escoger...";

$es_modificacion = false;

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  SI SE ENVIA LA VARIABLE ENTONCES ES UNA MODIFICACION
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
if (isset($_GET["v_rut"]) && $_GET["v_rut"] != "") {
    $es_modificacion = true;
    $v_btn_guardar = "Actualizar Trabajador";
    $v_btn_trabajador = "btn_actualizarTrabajador";

    $v_rut = $_GET["v_rut"];
    $cerrar="";
    $cuenta = $obj_trabajador->obtieneInfoXId($v_rut);
    $v_nombre = $cuenta[0][1];
    $v_apellidoPaterno = $cuenta[0][2];
    $v_cargo = $cuenta[0][3];
    $v_mail = $cuenta[0][4];
    $v_telefono = $cuenta[0][5];
    $v_estado = $cuenta[0][7];
    $v_permisos = $cuenta[0][8];
    $v_contrasena = $cuenta[0][6];
}
?>
<head>  
    <script src="../js/trabajador.js" type="text/javascript"></script>
</head>

<div class="modal-header" id="div-results">
    <button type="button" class="close" data-dismiss="" id="equis" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Trabajador</h4>
</div>
<div class="modal-body">
    <form id='frm_convhist'>

        <div class="">
            <label for="rut">Rut</label>
            <input type="text" class="form-control" id="rut" value='<?php echo $v_rut; ?>' placeholder="">
        </div>
        <div class="">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" class="form-control" id="nombre" value='<?php echo $v_nombre; ?>' placeholder="">
        </div>
        <div class="">
            <label for="exampleInputEmail1">Apellidos</label>
            <input type="text" class="form-control" id="apellido_paterno" value='<?php echo $v_apellidoPaterno; ?>' placeholder="">
        </div>
        <div class="">
            <label for="exampleInputEmail1">Cargo</label>
            <input type="text" class="form-control" id="cargo" value='<?php echo $v_cargo; ?>' placeholder="">
        </div>
        <div class="">
            <label for="exampleInputEmail1">Correo</label>
            <input type="text" class="form-control" id="mail" value='<?php echo $v_mail; ?>' placeholder="">
        </div>
        <div class="">
            <label for="exampleInputEmail1">Telefono</label>
            <input type="number" class="form-control" id="telefono" value='<?php echo $v_telefono; ?>' placeholder="">
        </div>
        <p></p>
        <div class="estado">
            <label class="mr-sm-2" for="inlineFormCustomSelect">Estado</label>
            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="estado">
                <option selected><?php echo $v_estado; ?></option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>
        <p></p>
        <div class="permisos">
            <label class="mr-sm-2" for="inlineFormCustomSelect">Permisos</label>
            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="permisos">
                <option selected ><?php echo $v_permisos; ?></option>
                <option value="Administrador">Administrador</option>
                <option value="Trabajador">Trabajador</option>
            </select>
        </div>
        <p></p>
        <div class="">
            <label for="exampleInputEmail1">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" value='<?php echo $v_contrasena; ?>' placeholder="">
        </div>
        <p></p>
        <div class='form-group'>
            <input class='btn btn-primary' type='button' id='<?= $v_btn_trabajador ?>' value='<?= $v_btn_guardar ?>'>

        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="" id="equis2">Cerrar</button>
</div>