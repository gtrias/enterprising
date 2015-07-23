<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'HTML/QuickForm.php';
require_once 'class/bd/ControlEmpresa.class.php';

$form = new HTML_QuickForm('FormNuevaEmpresa','POST','index.php?accion=nuevaEmpresa');

$form->addElement('header', null, 'Introducir nueva empresa:');
$form->addElement('text', 'nombre', 'Nombre de la empresa:', array('size' => 50, 'maxlength' => 255));
$form->addElement('text', 'tipo', 'Tipo:', array('size' => 50, 'maxlength' => 255));
$form->addElement('text', 'actividad', 'Actividad:', array('size' => 50, 'maxlength' => 255));
$form->addElement('text', 'pais', 'Pais:', array('size' => 50, 'maxlength' => 255));
$form->addElement('text', 'puntuacion', 'Puntuacion inicial:', array('size' => 50, 'maxlength' => 255));
$form->addElement('textarea', 'notas', 'Notas:', array('size' => 100, 'maxlength' => 255));
$form->addElement('submit', null, 'Guardar');
 
$form->applyFilter('nombre', 'trim');
$form->addRule('nombre', 'Porfavor introduzca el nombre de la empresa', 'required', null, 'client');

if ($form->validate()){
    $nombre = htmlspecialchars($form->exportValue('nombre'));
    $tipo = htmlspecialchars($form->exportValue('tipo'));
    $actividad = htmlspecialchars($form->exportValue('actividad'));
    $pais = htmlspecialchars($form->exportValue('pais'));
    $puntuacion = htmlspecialchars($form->exportValue('puntuacion'));
    $notas = htmlspecialchars($form->exportValue('notas'));
    ControlEmpresa::obtenerInstancia()->nuevaEmpresa($nombre,$tipo,$actividad,$pais,$puntuacion,$notas);
    echo '<h1>La empresa, ' .  htmlspecialchars($form->exportValue('nombre')) . ' se ha introducido correctamente!</h1>';
    exit;
}

$error = $form->display();
if(PEAR::isError($error)){
    echo $error->getMessage();
}
?>
