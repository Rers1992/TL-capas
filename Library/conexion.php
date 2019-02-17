<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config.php';

class cnx{
    
private $respuesta;
private $dbh;
public function conexion($getQuery){

$this->dbh = new PDO(DB_NAME.";".DB_HOST, DB_USER, DB_PASS )or die ("Error de conexion. ". pg_last_error());    

//echo "Conexion exitosa <hr>";

      $query = $this->dbh->prepare($getQuery);
      
      $query->execute();

      $this->respuesta=$query->fetchAll();
     
        }


public function getResultado(){
    
        return $this->respuesta;
        
    }
    


}
