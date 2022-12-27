<?php
namespace Inc;
require_once (ABSPATH.'wp-content/plugins/CBS/config.php');

class CBS{

	/**
	 * Plugin Path
	 * @var string
	 */

	protected string $_plugin;

	/**
	 * Class Instance
	 * @var object
	 */
    public static object $_instance;

	/**
	 * Constructor
	 */

	public function __construct() {


		$this->_plugin = plugin_basename( __FILE__ );

	}

	/**
	 * Singleton
	 * @return CBS
	 */
	public static function instance() {

		if ( ! isset( self::$_instance ) ) {

			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Add StyleSheets and JavaScript
	 * @return void
	 */
	function enqueue_style() {

		//styleSheets
		$version     = 'v1.0' . date( 'Y-m-d H:i:s' );
		$cssFileName = 'myStyle.css?v=' . $version;
		wp_enqueue_style( 'style',
			plugins_url( 'assets/stylesheet' . $cssFileName, __FILE__ ),
			array(),
			'1.0',
			'all'

		);
		//javaScripts
		wp_enqueue_script( 'myScript',
			plugins_url( 'assets/javascript/myScript.js', __FILE__ ),
			array('scriptCdn'),
			'1.0'
		);

         //JavaScript Cdn
		wp_enqueue_script('scriptCdn',
			'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js',
			array(),
			'1.0');
	}


	/**
	 * Player Menu
	 * @return void
	 */
	public function player_menu() {

		add_menu_page(
			'CBS',
			'CBS',
			'manage_options',
			'cbs',
			[ $this, 'player_Grid' ]
		);

        add_submenu_page(
		'cbs',
	        'Api',
	        'Api',
	        'manage_options',
	        'api',
	        [$this, 'request_Api']
        );
	}

	public function request_api(){

		include_once  VIEW_DIR.'apiRequest.php';
	}

	public function player_Grid(){

		include_once VIEW_DIR.'playerTable.php';
	}


	/**
	 * Register Actions
	 */

	public function register(){

		add_action('admin_menu',array($this,'player_menu'));
		add_action('wp_enqueue_scripts', array($this,'enqueue_style') );
	}


}



