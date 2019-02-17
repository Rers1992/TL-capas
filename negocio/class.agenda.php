<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once (realpath(dirname(__FILE__)) . '/../datos/class.agenda_sql.php');
require_once (realpath(dirname(__FILE__)) . '/../Library/conexion.php');
include_once ('class.operacionesBasicas.php');

class agenda extends operacionesBasicas {

    public function __construct() {

        $this->cnx = new cnx(); //conexion
        $this->sql = new agenda_sql(); //querys
    }

}

?>