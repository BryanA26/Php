<?php
  class Rol{
  	var $id;
  	var $nombre;
  	function __construct($id,$nombre){
  		$this->id=$id;
  		$this->nombre=$nombre;
  	}
  	function setId($id){
  		$this->id=$id;
  	}
  	function getId(){
  		return $this->id;
  	} 
  	function setNombre($nombre){
  		$this->nombre=$nombre;
  	}
  	function getNombre(){
  		return $this->nombre;
  	}    		
  }
?>