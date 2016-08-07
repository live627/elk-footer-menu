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

if (isset($modSettings['footer_menu']))
    unset($modSettings['footer_menu']);

$db = database();
$db->query('', '
    DELETE FROM {db_prefix}settings
    WHERE variable = {string:setting}',
    array(
        'setting' => 'footer_menu',
    )
);
