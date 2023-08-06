<?php
namespace Idealdevex\Webportal\Core;

/** Block direct access to file.*/ 
defined( 'ABSPATH' ) || die( 'Access Denied!' );

/**
 * Web Portal
 * 
 * @final
 * @author Mostafa A <mostafa.a@idealdevex.com>
 * 
 */
final class App
{
	/** 
     * @var object singleton object 
     * @static
     */
    static public $instance = false;

    /**
     * Get singlton instance of current class
     * 
     * @static
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return object
     */
	static public function getInstance()
    {
		
		if ( !self::$instance ){
            self::$instance = new self();
        }
		
		return self::$instance;
		
	}
	
}