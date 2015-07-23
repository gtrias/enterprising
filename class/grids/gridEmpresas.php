<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Structures/DataGrid.php';
require_once 'HTML/Table.php';
require_once 'class/bd/ControlEmpresa.class.php';


// Instantiate the DataObject; that's our DataSource container
$empresa = new Empresa_DataObject();

// Create the DataGrid
$datagrid =& new Structures_DataGrid(20); // Display 20 records per page

// Specify how the DataGrid should be sorted by default
$datagrid->setDefaultSort(array('puntuacion' => 'ASC'));

// Bind the DataSource container
$test = $datagrid->bind($empresa);
if (PEAR::isError($test)) {
    echo $test->getMessage();
}

// Define columns
$datagrid->addColumn(new Structures_DataGrid_Column(null, null, null, array('width' => '10'), null, 'printCheckbox()'));
$datagrid->addColumn(new Structures_DataGrid_Column('ID', null, 'id', array('width' => '40%'), null, 'printFullName()'));
$datagrid->addColumn(new Structures_DataGrid_Column('Nombre', 'nombre', null, array('width' => '20%')));
$datagrid->addColumn(new Structures_DataGrid_Column('Tipo', 'tipo', null, array('width' => '20%')));
$datagrid->addColumn(new Structures_DataGrid_Column('Actividad', 'actividad', null, array('width' => '20%')));
$datagrid->addColumn(new Structures_DataGrid_Column('Pais', 'pais', null, array('width' => '20%')));
$datagrid->addColumn(new Structures_DataGrid_Column('Puntuacion', 'puntuacion', null, array('width' => '20%')));
$datagrid->addColumn(new Structures_DataGrid_Column('Notas', 'notas', null, array('width' => '20%')));
$datagrid->addColumn(new Structures_DataGrid_Column('Role', null, null, array('width' => '20%'), null, 'printRoleSelector()'));
$datagrid->addColumn(new Structures_DataGrid_Column('Edit', null, null, array('width' => '20%'), null, 'printEditLink()'));

// Define the Look and Feel
$tableAttribs = array(
    'width' => '100%',
    'cellspacing' => '0',
    'cellpadding' => '4',
    'class' => 'datagrid'
);
$headerAttribs = array(
    'bgcolor' => '#CCCCCC'
);
$evenRowAttribs = array(
    'bgcolor' => '#FFFFFF'
);
$oddRowAttribs = array(
    'bgcolor' => '#EEEEEE'
);
$rendererOptions = array(
    'sortIconASC' => '&uArr;',
    'sortIconDESC' => '&dArr;'
);

// Create a HTML_Table
$table = new HTML_Table($tableAttribs);
$tableHeader =& $table->getHeader();
$tableBody =& $table->getBody();

// Ask the DataGrid to fill the HTML_Table with data, using rendering options
$test = $datagrid->fill($table, $rendererOptions);
if (PEAR::isError($test)) {
    echo $test->getMessage();
}


// Set attributes for the header row
$tableHeader->setRowAttributes(0, $headerAttribs);

// Set alternating row attributes
$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);

// Output table and paging links
echo $table->toHtml();

// Display paging links
$test = $datagrid->render(DATAGRID_RENDER_PAGER);
if (PEAR::isError($test)) {
    echo $test->getMessage();
}


function printCheckbox($params)
{
    extract($params);
    return '<input type="checkbox" name="idList[]" value="' . $record['id'] . '">';
}
function printFullName($params)
{
    extract($params);
    return $record['fname'] . ' ' . $record['lname'];
}
function printRoleSelector($params)
{
    global $roleList;

    extract($params);

    $html = '<select name="role_id">';
    foreach ($roleList as $roleId => $roleName) {
        $html .= "<option value=\"$roleId\">$roleName</option>\n";
    }
    $html .= '</select>';

    return $html;
}
function printEditLink($params)
{
    extract($params);
    return '<a href="edit.php?id=' . $record['id'] . '">Edit</a>';
}

?>
