<?php
/*
  Plugin Name: Banners
  Plugin URI: https://github.com/JJS4ntos
  Description: Plugin para banners rotativos desenvolvido exclusivamente para Ricardo.
  Version: 1.0.0
  Author: Jair Júnior
  Author URI: https://github.com/JJS4ntos
*/
// If this file is accessed directory, then abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define('PLUGIN_NAME', 'Banners');
define('SD_PATH', plugin_dir_url( __FILE__ ));
define('SD_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('URL_SCOPE', 'wk-banners-api');

require_once 'vendor/autoload.php';
require_once 'src/Config/Setup.php';
require_once 'src/database/install.php';

require_once 'src/routes.php';
