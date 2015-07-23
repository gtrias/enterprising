<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empresaclass
 *
 * @author BlackTuX
 */
require_once 'DB.php';
$db = DB::connect('mysql://someuser:somepass@localhost/pear_dbdo');
$db->setFetchMode(DB_FETCHMODE_ASSOC);

class Empresa
{

    // gets an array of data about the seleted person
    function getEmpresa($id)
    {
        global $db;
        $result = $db->query('SELECT * FROM person WHERE id=' . $db->quote($id));
        return $result->fetchRow();
    }

    // example of checking a password.
    function checkPassword($username, $password)
    {
        global $db;

        $hashed = md5($password);
        $result = $db->query(
            'SELECT name FROM person WHERE name=' . $db->quote($username)
            . ' AND password = ' . $db->quote($hashed)
        );
        return $result->fetchRow();
    }

}

// get the persons details..
$array = MyPerson::getPerson(12);
echo $array['name'] . "\n";
?>
