<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//iniciamos la sesiÃ³n
session_start();
//como estamos en la carpeta class podemos llamarlo directamente
require_once("conexion.php");

//creamos la clase blog
class blog {

    private $cnx;
    private $vector_resultado;
    private $query;

    function __construct() {
        $this->cnx = new cnx();
    }

//esta funciÃ³n serÃ¡ la encargada de comprobar si existe el usuario en la base de datos
    public function nueva_sesion() {
        //recogemos las variables post del formulario
        $nombre = $_POST['nom'];
        $password = $_POST['pass'];
        //realizamos la consulta sql
        $query = "SELECT * 
		FROM
		TRABAJADOR
		WHERE RUT='" . $nombre . "' 
		AND CONTRASENA='" . $password . "'";
        //ejecutamos la consulta y guardamos el resultado en la variable resultado
        $this->cnx->conexion($query);
        $this->vector_resultado = $this->cnx->getResultado();
        //echo "<pre>";print_r($this->vector_resultado);die;
        /* si el nÃºmero de filas devuelto por la variable resultado es 1,
          lo que significa que en la base de datos blog, en la tabla usuarios
          existe una fila que coincide con los datos ingresados
          nos envÃ­e a logueado.php con una variable de sesiÃ³n que llamaremos $_SESSION['nick'] a la que    asignamos el valor del campo username de ese usuario en la base de datos, que serÃ­a como el home de nuestra pÃ¡gina,
          en otro caso, nos deja en nueva_sesion.php, con una variable get llamada usuario
          y con el valor no_existe. */

        if ($reg = $this->vector_resultado) {
            $_SESSION['nick'] = $reg[0]['rut'];
            header("Location:presentacion/pages/index.php");
        } else {
            header("Location:index.php?usuario=no_existe");
        }
    }

}

?>