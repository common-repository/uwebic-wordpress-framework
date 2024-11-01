<?php
/*
  Plugin Name: uWebic wordpress framework
  Plugin URI: http://uwebic.com
  Description: A framework to ease up the process of developing new plugins for wordpress. Mainly the admin panel part of a plugin.
  Author: uWebic
  Version: 1.0
  Author URI: http://uwebic.com
  License: GPL2
 */
/*  Copyright 2011  uWebic  (email : info@uwebic.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


define('UWEBICFRAMEWORK_PATH', dirname(__FILE__));
define('UWEBICFRAMEWORK_URL', plugins_url($path = '/' . UWEBICFRAMEWORK_PATH));
define('UWEBICFRAMEWORK_VERSION', 1.0);
define('UWEBICFRAMEWORK_NAME', 'uwebic_framework');

/* Include the main library files*/
require_once UWEBICFRAMEWORK_PATH . '/lib/wp_elements.php';
require_once UWEBICFRAMEWORK_PATH . '/lib/validation.php';

/* Include plugin main class*/
require_once UWEBICFRAMEWORK_PATH.'/classes/' . UWEBICFRAMEWORK_NAME . '.php';

/* Setup plugin*/
$uwebicFramework = new UwebicFramework();
$uwebicFramework->setup();

/* Run code when activating the plugin */
register_activation_hook(__FILE__, array($uwebicFramework, 'activate_plugin'));