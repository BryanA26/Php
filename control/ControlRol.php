<?php 
class controlRol{
    var $objRol;

    function __construct($objRol){
        $this->objRol = $objRol;
    }
    function guardar(){

        $nom = $this->objRol->getNombre();
        $comando = "INSERT INTO rol(nombre) values ('$nom')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comando);
        $objControlConexion->cerrarBd();
    }

    function listar(){
        $arrayRoles=[]
        
        return $arrayRoles;


    }

    function consultar(){


    }

    function modificar(){


    }

    function borrar(){


    }

}






?>