<?php
  class Usuario{
  	var $email;
  	var $contrasena;
  	function __construct($email,$contrasena){
  		$this->email=$email;
  		$this->contrasena=$contrasena;
  	}
  	function setEmail($email){
  		$this->email=$email;
  	}
  	function getEmail(){
  		return $this->email;
  	} 
  	function setContrasena($contrasena){
  		$this->contrasena=$contrasena;
  	}
  	function getContrasena(){
  		return $this->contrasena;
  	}    		
  }
?>