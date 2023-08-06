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

require_once dirname( __FILE__ ) . "/vendor/autoload.php";

if ( Idealdevex\Webportal\Core\App::class ) {
    \Idealdevex\Webportal\Core\App::getInstance();
}
