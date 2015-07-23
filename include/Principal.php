<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<div class="cuerpo">';

$accion = $_GET['accion'];
if(!isset($accion)){
    $accion = 'principal';
}
include 'secciones/'.$accion.'.php';

echo '</div>';
?>
