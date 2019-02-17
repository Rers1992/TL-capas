<?php

class actaReunion_sql {

    private $query;

    public function actaReunion_sql() {
        
    }

//select    
    public function obtieneInfo_sql() {

        $this->query = "select * from acta_reunion";
    }

    public function obtieneInfoXId_sql($p_RUT_PE) {
        $this->query = "select RUT, NOMBRE, APELLIDOS, CARGO, CORREO, TELEFONO, CONTRASENA, ESTADO, PERMISOS
			 from TRABAJADOR
	           where RUT  = '" . $p_RUT_PE . "'";
    }
    
    public function obtieneInfoXId2_sql() {
        $this->query = "select current_date";
    }
    
    public function actualizaDatos_sql($variables){
        $this->query = "update TRABAJADOR
			 set
	            NOMBRE              = '". $variables[1] ."',
                    APELLIDOS           = '". $variables[2] ."',
                    CARGO               = '". $variables[3] ."',
                    CORREO              = '". $variables[4] ."',
	            TELEFONO            =  ". $variables[5] .",
	            CONTRASENA          = '". $variables[6] ."',
	            ESTADO              = '". $variables[7] ."',
	            PERMISOS            = '". $variables[8] ."'
			   where RUT    = '". $variables[0] ."'";
    }

    public function registraDatos_sql($variables) {
        $this->query = "  INSERT INTO TRABAJADOR (RUT, NOMBRE, APELLIDOS, CARGO, CORREO, TELEFONO, CONTRASENA, ESTADO, PERMISOS)
	                   VALUES ( '" . $variables[0] . "',
	                            '" . $variables[1] . "',
	                            '" . $variables[2] . "',
                        	    '" . $variables[3] . "',
                        	    '" . $variables[4] . "',
	                            '" . $variables[5] . "',
	                            '" . $variables[6] . "',
                        	    '" . $variables[7] . "',
                                    '" . $variables[8] . "')
 			
	 				";
    }

//query
    public function getQuery() {

        return $this->query;
    }

}

?>
