<?php
/**
 * Plugin Name: Web Portal
 * Plugin URI: https://idealdevex.com
 * Description: Web Portal to manage Clients,Staffs,Leads with a full features of a CRM
 * Author: Mostafa Adib
 * Author URI: https://netlog.pro
 * Version: 0.1.0
 * Text Domain: idealdevex-web-portal
 */

/** Block direct access to the main plugin file.*/ 
defined( 'ABSPATH' ) || die( 'Access Denied!' );

/** @var string default plugin slug holder */
define( "IDEALDEVEX_WEB_PORTAL_SLUG" , "idealdevex-web-portal" );

/** @var string plugin Version */
define( "IDEALDEVEX_WEB_PORTAL_VERSION" , "0.1.0" );

/** @var string plugin root path */
define( "IDEALDEVEX_WEB_PORTAL_PLUGIN_FILE" , __FILE__ );

require_once dirname( IDEALDEVEX_WEB_PORTAL_PLUGIN_FILE ) . "/vendor/autoload.php";


