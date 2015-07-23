<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'MDB2.php';
class ControlDB
{
    private static $dsn = array(
        'phptype'  => 'mysql',
        'username' => 'a7170495_emp',
        'password' => '7892790d',
        'hostspec' => 'mysql2.000webhost.com',
        'database' => 'a7170495_emp',
    );

    private static $instancia = null;
    private static $conexion = null;
    private function ControlDB(){}
    private function getConnection(){
        return self::$conexion;
    }
    public static function obtenerInstancia(){
        if(self::$instancia == null){
            self::$instancia = new ControlDB();
        }
        self::conectar();
        return self::$instancia;
    }
    public static function conectar(){
        self::$conexion =& MDB2::connect(self::$dsn);
        if (PEAR::isError(self::$conexion)) {
            die(self::$conexion->getMessage());
        }
        return self::$conexion;
    }

    public function desconectar(){
        $this->getConnection()->disconect();
    }

    public function realizarConsulta($consulta){
        return $this->getConnection()->query($consulta);
    }
   
    public function realizarModificacion($consulta){
        return $this->getConnection()->exec($consulta);
    }
    
    public function getDSN(){
        return self::$dsn;
    }

    
}

?>