<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class operacionesBasicas {
    protected $pk;
    protected $variables;
    protected $sql;
    protected $cnx;
    protected $vector_resultado;
    protected $query;
    
    abstract public function __construct();
    
    public function registraDatos($variables) {
        $this->sql->registraDatos_sql($variables);
        $query = $this->sql->getQuery();
        $this->cnx->conexion($query);
        //echo "<pre>";print_r($query);die;
        $this->vector_resultado = $this->cnx->getResultado();
        return $this->vector_resultado;
    }
    
    public function actualizaDatos($variables) {
        $this->sql->actualizaDatos_sql($variables);
        $query = $this->sql->getQuery();
        $this->cnx->conexion($query);
        //echo "<pre>";print_r($query);die;
        $this->vector_resultado = $this->cnx->getResultado();
        return $this->vector_resultado;
    }
    
    public function eliminaDatos($pk) {
        $this->sql->eliminaDato_sql($pk);
        $query = $this->sql->getQuery();
        $this->cnx->conexion($query);
        //echo "<pre>";print_r($query);die;
    }
    
    public function obtieneInfo() {
        $this->sql->obtieneInfo_sql();
        $query = $this->sql->getQuery();
        $this->cnx->conexion($query);
        $this->vector_resultado = $this->cnx->getResultado();
        return $this->vector_resultado;
    }
    
    public function obtieneInfoXId($pk) {
        $this->sql->obtieneInfoXId_sql($pk);
        $query = $this->sql->getQuery();
        $this->cnx->conexion($query);
        $this->vector_resultado = $this->cnx->getResultado();
        return $this->vector_resultado;
    }
} 