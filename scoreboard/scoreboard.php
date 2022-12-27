<?php
/**
 * Plugin Name: Scoreboard
 * Plugin URI: https://Scoreboard/
 * Description: An tookit to help display cricket score cards
 * Version: 1.0
 * Author: Muhammad Afeen
 * Author URI: https://
 * Text Domain: hello
 * Domain Path: /i18n/languages/muhammadAfeen
 * Requires at least: 5.8
 * Requires PHP: 7.2
 *
 *
 */

/**
 * Security purpose
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Including composer AutoLoad File
 */
require_once dirname( __FILE__ ) . '/vendor/autoload.php';


/**
 * Score Board Class
 */
class scoreboard {


	public $teams_obj;
	public static scoreboard $instance;
	public $table_name = 'sb_scoreboard';

   public $player_obj;

	/**
	 * Variable Plugin Directory
	 */
	public $plugin;

	/**
	 * Constructor
	 */
	public function __construct() {


		$this->plugin = plugin_basename( __FILE__ );


		$this->register();

	}


	/**
	 * Adding Actions
	 * @return void
	 */
	function register() {


		add_action( 'init', array( $this, 'enqueue_style' ) );

		add_action( 'admin_menu', array( $this, 'admin_Menu_page' ) );

		add_action( 'admin_menu', array( $this, 'sb_team' ) );

		add_filter( "plugin_action_links_$this->plugin", array( $this, 'systems_links' ) );

		add_filter( 'set-screen-option', [ 'scoreboard', 'set_screen' ], 10, 3 );

		add_action( 'admin_menu', [ $this, 'plugin_menu' ] );

        add_action('admin_menu', [ $this, 'player_menu' ]);


		add_action( 'plugins_loaded', function () {

			scoreboard::get_instance();
		} );


	}





	/**
	 * Custom links
	 *
	 * @param $links
	 *
	 * @return mixed
	 */
	function systems_links( $links ) {

		$settings_links = '<a href="admin.php?page=scorecard_plugin">Settings</a>';

		$links[] = $settings_links;

		return $links;

	}


	function sb_team() {

		add_menu_page( 'Teams',
			'Teams',
			'manage_options',
			'sb_team',
			array( $this, 'team_table' ),
			'dashicons-store',
			110 );


		/**
		 * Adding Option Add New
		 */
		add_submenu_page( 'sb_team',
			'Add New',
			'Add New',
			'manage_options',
			'team_add',
			array( $this, 'team_add' )

		);
		/**
		 * Add option Update
		 */
		add_submenu_page( '',
			'update',
			'update',
			'manage_options',
			'team_update',
			array( $this, 'team_update' )

		);

		add_submenu_page( '',
			'delete',
			'delete',
			'manage_options',
			'team_delete',
			array( $this, 'team_delete' )

		);

	}


	function team_table() {

		require_once plugin_dir_path( __FILE__ ) . 'templates/teamtable.php';
	}

	function team_add() {

		require_once plugin_dir_path( __FILE__ ) . 'templates/addteam.php';
	}

	function team_update() {

		require_once plugin_dir_path( __FILE__ ) . 'templates/updateteam.php';

	}

	function team_delete() {

		require_once plugin_dir_path( __FILE__ ) . 'templates/deleteteam.php';

	}


	/**
	 * Adding Scorecard Menu
	 * @return void
	 */
	function admin_Menu_page() {
		add_menu_page( 'ScoreCard',
			'Scorecard',
			'manage_options',
			'scorecard_plugin',
			array( $this, 'admin_index' ),
			'dashicons-store',
			110 );

		/**
		 * Adding Option Add New
		 */
		add_submenu_page( 'scorecard_plugin',
			'Add New',
			'Add New',
			'manage_options',
			'Addnew',
			array( $this, 'sub_menu' )

		);

		/**
		 * Add Update Page
		 */
		add_submenu_page( '',
			'Update New',
			'Update New',
			'manage_options',
			'update_match',
			array( $this, 'update_match' )
		);

		/**
		 * Add delete page
		 */
		add_submenu_page( '',
			'Delete New',
			'Delete New',
			'manage_options',
			'delete_match',
			array( $this, 'delete_match' )
		);
	}

	function admin_index() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/admin-settings.php';
	}

	function sub_menu() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/addmatch.php';
	}

	function update_match() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/updatematch.php';
	}

	function delete_match() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/deletematch.php';
	}

	/**
	 * Add StyleSheets and JavaScript
	 * @return void
	 */
	function enqueue_style() {
		$version     = 'v1.0' . date( 'Y-m-d H:i:s' );
		$cssFileName = 'style.css?v=' . $version;
		//styleSheets
		wp_enqueue_style( 'style',
			plugins_url( 'assets/' . $cssFileName, __FILE__ ),
			array(),
			'1.0',
			'all'

		);
		//javaScripts
		wp_enqueue_script( 'script',
			plugins_url( 'assets/script.js', __FILE__ ),
			array(),
			'1.0'
		);

        wp_enqueue_script('script',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js',
            array(),
            '1.2');
	}


	/**
	 * Activate
	 * @return void
	 */
	function Activate() {

		Inc\SbPluginActivate::activate();
	}

	/**
	 * Deactivate
	 * @return void
	 */
	function Deactivate() {

		Inc\SbPluginDeactivate::deactivate();
	}


	/**
	 * Create Scoreboard Table
	 * @return void
	 */
	public function Sb_Table() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $this->table_name(

		match_id       int(11) NOT NULL AUTO_INCREMENT,
		team1          varchar(225) NOT NULL,
		team2          varchar(225) NOT NULL,
		wickets        int(11),
		score          int(11),
		target         int(11),
		wickets2       int(11),
		score2         int(11),
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (match_id)
	) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );


	}

	/**
	 * Inserting data Into scoreboard table
	 * @return void
	 */


	function Sb_insert() {

		global $wpdb;

		$wpdb->insert( $this->table_name,
			array(
				'team1'    => 'pakistan',
				'team2'    => 'india',
				'wickets'  => '0',
				'score'    => '152',
				'target'   => '153',
				'wickets2' => '10',
				'score2'   => '151'

			)

		);

	}


	/**
	 * Sb_Teams_Table
	 * @return void
	 */
	function Sb_Team_Table() {

		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$sql = " CREATE TABLE `sb_team_table`(
         id  int(11) NOT NULL AUTO_INCREMENT,
         Tname varchar(225),
         Ttype varchar(225),
         matches int(11),
         won int(11),
         lost int(11),
         Nrated int(11),
         primary key (id)
                             
         )$charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Sb_Table_insert
	 */
	function sb_team_table_insert() {


		global $wpdb;

		$wpdb->insert( 'sb_team_table',
			array(
				'Tname'   => 'pakistan',
				'Ttype'   => 'cricket',
				'matches' => '10',
				'won'     => '9',
				'lost'    => '1',
				'Nrated'  => '0'
			)

		);
	}


	/**
	 * Players Table
	 *
	 */
	function player_table() {

		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$sql = " CREATE TABLE `sb_player`(
         id  int(11) NOT NULL AUTO_INCREMENT,
         teamid int(11) NOT NULL,
         name  varchar(225),
         rating int(11),
         primary key (id)
                             
         )$charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * function insert Player table
	 */

	function insert_player_table() {
		global $wpdb;

		$wpdb->insert( 'sb_player', array(

				'teamid' => '12',
				'name'   => 'imran khan',
				'rating' => '9.8/10'
			)
		);


	}


	/**
	 * Deleting Database from Plugin
	 */

	function Sb_Delete() {

		global $wpdb;
		$sql[] = "DROP TABLE IF EXISTS $this->table_name";
		$sql[] = 'DROP TABLE IF EXITS sb_team_table';

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

	}

	public function Sb_View() {
		global $wpdb;
		$sql  = "SELECT * FROM $this->table_name";
		$post = $wpdb->get_results( $sql );

		return $post;
	}


	public static function set_screen( $status, $option, $value ) {
		return $value;
	}


	public function player_menu() {

		    add_menu_page(
			'player',
			'player',
			'manage_options',
			'playerTable',
			[ $this, 'player_setting_screen' ]
		);
	}

    public function player_setting_screen(){

        include_once plugin_dir_path(__FILE__).'templates/player-table.php';

    }





	public function plugin_menu() {

		$hook = add_menu_page(
			'Teams Table',
			'Teamlist',
			'manage_options',
			'TeamTable',
			[ $this, 'plugin_settings_page' ]
		);

		add_action( "load-$hook", [ $this, 'screen_option' ] );

	}


	public function screen_option() {

		$option = 'per_page';
		$args   = [
			'label'   => 'Teams',
			'default' => 5,
			'option'  => 'teams_per_page'
		];

		add_screen_option( $option, $args );
		require_once plugin_dir_path( __FILE__ ) . 'MatchList.php';
		$this->teams_obj = new MatchList();
	}

	/**
	 * Plugin settings page
	 */
	public function plugin_settings_page() {
		?>
        <div class="wrap">
            <h2>Team Table</h2>

            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <form method="post">
								<?php
								$this->teams_obj->prepare_items();
								$this->teams_obj->display(); ?>
                            </form>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
		<?php
	}

	/** Singleton instance */
	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;

	}


}


/**
 * Creating instance of Class
 */
scoreboard::get_instance();


/**
 * Registrations Hooks
 */

$functions=['Activate', 'Sb_Table','player_table','Sb_insert',
    'insert_player_table', 'sb_team_table_insert','Sb_Team_Table',
    'Sb_Delete','Deactivate' ];

foreach ( $functions as $function){

    register_activation_hook(__FILE__,array( scoreboard::$instance, $function));

}




