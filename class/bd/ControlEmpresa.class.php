<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'class/bd/ControlDB.class.php';
require_once 'class/Empresa.class.php';

class ControlEmpresa
{
    private static $instancia = null;
    private function ControlEmpresa(){}
    public function obtenerInstancia(){
        if(self::$instancia == null)
        {
            self::$instancia = new ControlEmpresa();
        }
        return self::$instancia;
    }

    public function obtenerListaEmpresas(){
        $result = ControlDB::obtenerInstancia()->realizarConsulta('SELECT * FROM empresa');
       /* $resultado[][]=array('Codigo','Nombre');
        $i=0;
        while (($row = $result->fetchRow())) {
            // Assuming MDB2's default fetchmode is MDB2_FETCHMODE_ORDERED
            $resultado[$i][0]= $row[0];
            $resultado[$i][1]= $row[1];
            $i++;
        }
        return $resultado;*/
        $resultado = $result->fetchAll();
        return $resultado;

    }

    public function nuevaEmpresa($nombre,$tipo,$actividad,$pais,$puntuacion,$notas){
        $cont = ControlDB::obtenerInstancia()->realizarModificacion('INSERT INTO empresa(nombre,tipo,actividad,pais,puntuacion,notas) VALUES("'.$nombre.'","'.$tipo.'","'.$actividad.'","'.$pais.'","'.$puntuacion.'","'.$notas.'")');
        if (PEAR::isError($cont)) {
            die($cont->getMessage());
        }
    }

}
?>
