<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('../../../negocio/class.trabajador.php');
$obj_trabajador = new trabajador();
$v_bandera = $_POST["p_bandera"];

switch ($v_bandera) {
    case 1:
        $v_rut = $_POST["p_rut"];
        $v_nombre = $_POST["p_nombre"];
        $v_apellido_paterno = $_POST["p_apellido_paterno"];
        $v_cargo = $_POST["p_cargo"];
        $v_mail = $_POST["p_mail"];
        $v_telefono = $_POST["p_telefono"];
        $v_estado = $_POST["p_estado"];
        $v_permisos = $_POST["p_permisos"];
        $v_contraseña = $_POST["p_contraseña"];
        $variables = array($v_rut, $v_nombre, $v_apellido_paterno, $v_cargo, $v_mail, $v_telefono, $v_contraseña, $v_estado, $v_permisos);

        $result_ingr = $obj_trabajador->registraDatos($variables);
        echo $result_ingr;

        break;
    case 2:
        //variable enviadas desde javascript
        $v_rut = $_POST["p_rut"];
        $v_nombre = $_POST["p_nombre"];
        $v_apellido_paterno = $_POST["p_apellido_paterno"];
        $v_cargo = $_POST["p_cargo"];
        $v_mail = $_POST["p_mail"];
        $v_telefono = $_POST["p_telefono"];
        $v_estado = $_POST["p_estado"];
        $v_permisos = $_POST["p_permisos"];
        $v_contraseña = $_POST["p_contraseña"];
        $variables = array($v_rut, $v_nombre, $v_apellido_paterno, $v_cargo, $v_mail, $v_telefono, $v_contraseña, $v_estado, $v_permisos);
        $result_ingr = $obj_trabajador->actualizaDatos($variables);
        echo $result_ingr;
        break;
}