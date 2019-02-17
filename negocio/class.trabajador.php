<?php

require_once (realpath(dirname(__FILE__)) . '/../datos/class.trabajador_sql.php');
require_once (realpath(dirname(__FILE__)) . '/../Library/conexion.php');
include_once ('class.operacionesBasicas.php');

class trabajador extends operacionesBasicas {

    public function __construct() {

        $this->cnx = new cnx(); //conexion
        $this->sql = new trabajador_sql(); //querys
    }

}

?>