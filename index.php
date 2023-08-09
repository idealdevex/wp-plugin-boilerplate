<?php
/**
 * Plugin Name: IdealDevEx BoilerPlate Plugin
 * Plugin URI: https://idealdevex.com
 * Description: A boilerPlate plugin for Wordpress by IdealDevEx.Com
 * Author: IdealDevEx
 * Author URI: https://idealdevex.com
 * Version: 0.1.0
 * Text Domain: idealdevex-boilerplate
 */

/** Block direct access to the main plugin file.*/ 
defined( 'ABSPATH' ) || die( 'Access Denied!' );

/** @var string default plugin slug holder */
define( "IDEALDEVEX_BOILERPLATE_SLUG" , "idealdevex-boilerplate" );

/** @var string plugin Version */
define( "IDEALDEVEX_BOILERPLATE_VERSION" , "0.1.0" );

/** @var string plugin root file */
define( "IDEALDEVEX_BOILERPLATE_PLUGIN_FILE" , __FILE__ );

require_once dirname( __FILE__ ) . "/vendor/autoload.php";

if ( Idealdevex\Boilerplate\Core\App::class ) {
    \Idealdevex\Boilerplate\Core\App::getInstance();
}
