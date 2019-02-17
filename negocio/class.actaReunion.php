<?php

require_once (realpath(dirname(__FILE__)) . '/../datos/class.actaReunion_sql.php');
require_once (realpath(dirname(__FILE__)) . '/../Library/conexion.php');
include_once ('class.operacionesBasicas.php');

class actaReunion extends operacionesBasicas {

    public function __construct() {

        $this->cnx = new cnx(); //conexion
        $this->sql = new actaReunion_sql(); //querys
    }
    
    public function obtieneInfoXId2() {
        $this->sql->obtieneInfoXId2_sql();
        $query = $this->sql->getQuery();
        $this->cnx->conexion($query);
        $this->vector_resultado = $this->cnx->getResultado();
        return $this->vector_resultado;
    }

}

?>