<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../../../negocio/class.agenda.php');
$obj_agenda = new agenda();
$v_bandera = $_POST["p_bandera"];

switch ($v_bandera) {
    case 1:
        $profe = $_POST['p_prof'];
        $hora = $_POST['p_reserva'];
        $nombre = $_POST['p_nombre'];
        $rutres = $_POST['p_rut'];
        $telef = $_POST['p_telefono'];
        $variables = array($profe, $hora, $nombre, $rutres, $telef);

        $result_ingr = $obj_agenda->registraDatos($variables);
        echo $result_ingr;

        break;
    case 2:
        //variable enviadas desde javascript
        $profe = $_POST['p_prof'];
        $hora = $_POST['p_reserva'];
        $nombre = $_POST['p_nombre'];
        $rutres = $_POST['p_rut'];
        $telef = $_POST['p_telefono'];
        $variables = array($profe, $hora, $nombre, $rutres, $telef);
        $result_ingr = $obj_agenda->actualizaDatos($variables);
        echo $result_ingr;
        break;
    
    case 3:
        //variable enviadas desde javascript
        $profe = $_POST['p_prof'];
        $hora = $_POST['p_reserva'];
        $variables = array($profe, $hora);
        $result_ingr = $obj_agenda->eliminaDatos($variables);
        echo $result_ingr;
        break;
}