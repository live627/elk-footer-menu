<?php

/**
 * @package Footer Menu
 * @version 1.0
 * @author John Rayes <live627@gmail.com>
 * @copyright Copyright (c) 2014-2016, John Rayes
 * @license http://opensource.org/licenses/MIT MIT
 */

// If SSI.php is in the same place as this file, and ElkArte isn't defined...
if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('ELK'))
    require_once(dirname(__FILE__) . '/SSI.php');

// Hmm... no SSI.php and no ElkArte?
elseif (!defined('ELK'))
    die('<b>Error:</b> Cannot uninstall - please verify you put this in the same place as ElkArte\'s SSI.php.');

add_integration_function('integrate_pre_include', 'SOURCEDIR/FooterMenu.php');
add_integration_function('integrate_load_theme', 'footer_menu_load_theme');
add_integration_function('integrate_admin_areas', 'footer_menu_admin_areas');

$db = database();
$dbtbl = db_table();

$columns = array(
    array(
        'name' => 'id_item',
        'type' => 'mediumint',
        'size' => 8,
        'unsigned' => true,
        'auto' => true,
    ),
    array(
        'name' => 'name',
        'type' => 'varchar',
        'size' => 80,
    ),
    array(
        'name' => 'url',
        'type' => 'varchar',
        'size' => 4096,
    ),
    array(
        'name' => 'groups',
        'type' => 'varchar',
        'size' => 80,
    ),
    array(
        'name' => 'category',
        'type' => 'mediumint',
        'size' => 8,
        'unsigned' => true,
    ),
    array(
        'name' => 'active',
        'type' => 'enum(\'yes\',\'no\')',
    ),
);

$indexes = array(
    array(
        'type' => 'primary',
        'columns' => array('id_item')
    ),
);

$dbtbl->db_create_table('{db_prefix}footer_menu', $columns, $indexes, array(), 'overwrite');

$columns = array(
    array(
        'name' => 'id_item',
        'type' => 'mediumint',
        'size' => 8,
        'unsigned' => true,
        'auto' => true,
    ),
    array(
        'name' => 'name',
        'type' => 'varchar',
        'size' => 50,
    ),
);

$indexes = array(
    array(
        'type' => 'primary',
        'columns' => array('id_item')
    ),
);

$dbtbl->db_create_table('{db_prefix}footer_menu_categories', $columns, $indexes, array(), 'update_remove');

$in_col = array(
    'id_item' => 'int', 'name' => 'string',
);
$in_data = array(
    array(
        1, 'Untitled',
    ),
);
$db->insert('ignore',
    '{db_prefix}footer_menu_categories',
    $in_col,
    $in_data,
    array('id_field')
);

if (!empty($ssi))
    echo 'Database installation complete!';
