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

remove_integration_function('integrate_pre_include', 'SOURCEDIR/FooterMenu.php');
remove_integration_function('integrate_load_theme', 'footer_menu_load_theme');
remove_integration_function('integrate_admin_areas', 'footer_menu_admin_areas');

