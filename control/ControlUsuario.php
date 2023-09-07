<?php
    class ControlUsuario{
	   var $objUsuario;
        function __construct($objUsuario){
         $this->objUsuario=$objUsuario;

        }

    function validarIngreso()
        {
            $msg = "ok";
            $validar=false;
            $usu= $this->objUsuario->getNomUsuario(); 
            $con=$this->objUsuario->getContrasena();
            $comandoSql ="SELECT * FROM tblUsuario WHERE nomUsuario='$usu' AND contrasena='$con'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
            try
            {
                if (mysqli_num_rows($recordSet) > 0) 
                {
                    $validar = true;
                }
                $objControlConexion->cerrarBd();
            }
            catch (Exception $objExcetion)
            {
                $msg = $objExcetion->getMessage();
            }
            
            return $validar;
    }

    function consultarRolesPorUsuario($nomUsu)
    {
        $msg = "ok";
        $listadoRolesDelUsuario = [];
        $comandoSQL ="SELECT fkIdRol FROM tblrol_usuario WHERE fkNomUsuario='$nomUsu'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSQL);
        try
        {
            if (mysqli_num_rows($recordSet) > 0)
            {
                $i = 0;
                while ($row = $recordSet->fetch_array(MYSQLI_BOTH))
                {
                    $listadoRolesDelUsuario[$i]= $row[0];
                    $i++;
                }
                $objControlConexion->cerrarBd();
            }
        }
        catch (Exception $objExcetion)
        {
            $msg = $objExcetion->getMessage();
        }
        return $listadoRolesDelUsuario;
    }

    function guardar() {

        $ema= $this->objUsuario->getEmail(); 
        $con=$this->objUsuario->getContrasena();
            
        $comandoSql = "INSERT INTO usuario(email,contrasena) VALUES ('$ema', '$con')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();

    }
    
    function consultar() {
        $usu= $this->objUsuario->getNomUsuario(); 
    
        $comandoSql = "SELECT * FROM tblusuario WHERE nomUsuario = '$usu'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objUsuario->setContrasena($row['contrasena']);
        }
        $objControlConexion->cerrarBd();
        return $this->objUsuario;
    }

    function modificar() {
        $usu= $this->objUsuario->getNomUsuario(); 
        $con=$this->objUsuario->getContrasena();
        
        $comandoSql = "UPDATE tblusuario SET contrasena='$con' WHERE nomUsuario = '$usu'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar() {
        $usu= $this->objUsuario->getNomUsuario(); 
        $comandoSql = "DELETE FROM tblusuario WHERE nomUsuario = '$usu'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar() {
        $comandoSql = "SELECT * FROM tblusuario";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloUsuarios = array();
            $i=0;
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $objUsuario=new Usuario("","");
                $objUsuario->setNomUsuario($row['nomUsuario']);
                $objUsuario->setContrasena($row['contrasena']);
                $arregloUsuarios[$i]=$objUsuario;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloUsuarios;
    }

}
?>