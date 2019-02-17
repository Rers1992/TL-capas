<?php

class agenda_sql {

    private $query;

    public function agenda_sql() {
        
    }

//select    
    public function obtieneInfo_sql() {

        $this->query = "select * from agenda";
    }

    public function obtieneInfoXId_sql($p_RUT_PE) {
        $this->query = "select * from agenda where rut='" . $p_RUT_PE . "'";
    }

    public function actualizaDatos_sql($variables) {
        $this->query = "update AGENDA
			 set
	            NOMBRE_RESERVA             = '" . $variables[2] . "',
                    TELEFONO_RESERVA           = '" . $variables[4] . "'
			   where RUT    = '" . $variables[0] . "' and HORA_INICIO='" . $variables[1] . "'";
    }

    public function registraDatos_sql($variables) {
        $this->query = "  INSERT INTO AGENDA (RUT, HORA_INICIO, NOMBRE_RESERVA, TELEFONO_RESERVA)
	                   VALUES ( '" . $variables[0] . "',
	                            '" . $variables[1] . "',
	                            '" . $variables[2] . "',
                        	    '" . $variables[4] . "')
 			
	 				";
    }

    public function eliminaDato_sql($variables) {
        $this->query = "delete from agenda where rut='" . $variables[0] . "' AND hora_inicio='" . $variables[1] . "'";
    }

//query
    public function getQuery() {

        return $this->query;
    }

}

?>
