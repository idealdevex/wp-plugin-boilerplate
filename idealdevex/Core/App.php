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
    /** @var string Plugin Slug or TextDomain */
	static public $textDomain = IDEALDEVEX_BOILERPLATE_SLUG;
    /** @var string Plugin Semantic Version */
	static public $version = IDEALDEVEX_BOILERPLATE_VERSION;
    /** @var string Main Plugin's file */
	static public $pluginFile = IDEALDEVEX_BOILERPLATE_PLUGIN_FILE;
	/** @var string the plugin options key */    
    public const OPTIONS_KEY = IDEALDEVEX_BOILERPLATE_SLUG . "-options" ;
    /** @var string Plugin Menu Title */
    static public $pluginTitle = "IdealDevEx BoilerPlate";
	/** 
     * @var object singleton object 
     * @static
     */
    static public $instance = false;
	
    /** @var array  available notice types */
    protected $noticeTypes = array( "info" , "error" , "success" , "warning" );
	
	/** @var plugin options */
	protected $options = null;
	
	
    /**
     * Class Constructor Method
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return void
     */
    public function __construct()
    {
        
		        
    }

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
			self::$instance->init();
        }
		
		return self::$instance;
		
	}
	
    /**
     * Plugin Initialize
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return void
     */
    public function init()
    {

		register_activation_hook( self::$pluginFile , array( $this, 'activatePlugin'));
        register_deactivation_hook( self::$pluginFile , array( $this, 'deactivatePlugin' ) );
    
        add_action( 'admin_enqueue_scripts', array( $this , 'loadPluginStyles' ) );    
        add_action( 'admin_enqueue_scripts', array( $this , 'loadPluginScripts' ) ); 
		
		add_action( 'admin_menu' , array ( $this , 'setMenus' ) );
		
    }
	
	public function setMenus()
	{
        
		if ( is_super_admin() || current_user_can( 'administrator' ) ){

            add_menu_page( __( self::$pluginTitle , self::$textDomain ) , __( self::$pluginTitle , self::$textDomain ) , 'manage_options', self::$textDomain , array ( $this , 'screenMain' ) );
		}
		
	}
	
	public function screenMain()
	{
		
	}
			
    /**
     * Update Options in DB
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @param $params array of options
     * 
     * @return bool
     */
    private function updateOptions( $params )
    {

        $options = $this->loadOptions();

        if ( ! $options && is_array( $options ) && ! $params && is_array( $params ) ){
            
            foreach ( $params as $paramKey => $paramValue ){
                
                $options[ $paramKey ] = $paramValue;

            }

            return $this->setOptions( $options );

        }

        return false;

    }

    /**
     * Load Options from DB
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return string
     */
    private function loadOptions()
    {

		$this->options = ( get_option( self::OPTIONS_KEY ) ? json_decode( get_option( self::OPTIONS_KEY ) , true ) : null );
		
		return $this->options;

    }
	
    /**
     * Store Options to DB
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @param $params array of options
     * 
     * @return bool
     */
    private function setOptions( $params )
    {

        if ( is_array( $params ) && !empty( $params ) ){
			
			$this->options = $params;
			
            return update_option( self::OPTIONS_KEY , json_encode( $params ) );
			
        }

        return false;

    }	

    /**
     * Get Plugin Options from $options property
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return array
     */
    private function getOptions()
    {
		
		if ( ! $this->options ){
			$this->setOptions();
		}
		
		return $this->options;

    }	
	
    /**
     * Load Neede Styles & CSS for plugin
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return void
     */
    public function loadPluginStyles()
    {

        //wp_enqueue_style( 'eweqwe-css'  , plugins_url( '/assets/css/styles.css' , self::$pluginFile ) );
 
    }

    /**
     * Load Neede Scripts for plugin
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return void
     */
    public function loadPluginScripts()
    {

		//wp_register_script( 'ajaxHandle', plugins_url( '/assets/js/plugin.js', self::$pluginFile ),  array(),  false, true );
		//wp_enqueue_script( 'ajaxHandle' );
		//wp_localize_script( 'ajaxHandle', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )  );
 
    }
	
    /**
     * Display Wordpress Notice
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @param $text string Notice Text
     * @param $type string Notice Type an index of $noticeType Array
     * @param $dismissible bool Is the notice Dismissible?
     * 
     * @return void
     */
    private function notice( $text , $type = 'info' , $dismissible = false)
    {

        if ( !empty( trim( $text ) ) || !empty( trim( $type ) ) ){
            
            $noticeClass = ( in_array( $type , $this->noticeTypes ) ) ? 'notice-' . $type : '';

            $isDismissible = $dismissible ? 'is-dismissible' : '' ;

            echo    '
                    <div class="notice ' . $noticeClass . ' ' . $isDismissible .  ' "  style="margin-top: 10px;margin-bottom: 10px;">
                        
                        <p>' . __( $text , self::$textDomain ) . '</p>
                
                    </div>
                    ';
        }

    }
	
    /**
     * Plugin activation event handler
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return void
     */
    public function activatePlugin()
    {


    }

    /**
     * Plugin deactivation event handler
     * 
     * @author Mostafa A <mostafa.a@idealdevex.com>
     * 
     * @return void
     */
    public function deactivatePlugin()
    {

    }
	
}