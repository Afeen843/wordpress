<?php
class MatchList extends WP_List_Table {

	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Team', 'sp' ),
			'plural'   => __( 'Teams' ),
			'ajax'     => false
		] );
	}

	public static function get_teams( $per_page = 5, $page_number = 1 ) {

		global $wpdb;

		$sql = "SELECT * FROM sb_team_table";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";

		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}

	public static function delete_team( $id ) {
		global $wpdb;

		$wpdb->delete(
			"sb_team_table",
			[ 'id' => $id ],
			[ '%d' ]
		);
	}

	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM sb_team_table";

		return $wpdb->get_var( $sql );
	}


	public function no_items() {
		_e( 'No Teams avaliable.', 'sp' );
	}



	public function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'id':
			case 'Tname':
			case 'Ttype':
			case 'matches':
			case 'won':
			case 'lost':
			case 'Nrated':
				return $item[ $column_name ];

			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']
		);
	}

	function get_columns() {

		$columns = [
			'cb' => '<input type="checkbox" />',
			'id' => __( 'ID', 'sp' ),
			'Tname' => __( 'Team Name', 'sp' ),
			'Ttype' => __( 'Team Type', 'sp' ),
			'matches' => __( 'Matches', 'sp' ),
			'won' => __( 'Won', 'sp' ),
			'lost' => __( 'Lost', 'sp' ),
			'Nrated' => __( 'Not Rated', 'sp' )
		];

		return $columns;
	}

	public function get_sortable_columns(): array {

		     $sortable_columns = array(

			'Tname' => array( 'Tname', true ),
			'matches' => array( 'matches', false )
		);

		return $sortable_columns;
	}

	public function get_bulk_actions() {
		$actions = [
			'bulk-delete' => 'Delete'
		];

		return $actions;
	}

	public function prepare_items() {

		$this->_column_headers = $this->get_column_info();

		/** Process bulk action */
		$this->process_bulk_action();

		$per_page = $this->get_items_per_page( 'teams_per_page', 5 );
		$current_page = $this->get_pagenum();
		$total_items = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page' => $per_page //WE have to determine how many items to show on a page
		] );

		$this->items = self::get_teams( $per_page, $current_page );
	}


	public function process_bulk_action() {

//Detect when a bulk action is being triggered...
		if ( 'delete' === $this->current_action() ) {

// In our file that handles the request, verify the nonce.
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );

			if ( ! wp_verify_nonce( $nonce, 'delete_team' ) ) {
				die( 'Go get a life script kiddies' );
			}
			else {
				self::delete_team( absint( $_GET['team'] ) );

				wp_redirect( esc_url( add_query_arg() ) );
				exit;
			}

		}

// If the delete bulk action is triggered
		if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
		     || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
		) {

			$delete_ids = esc_sql( $_POST['bulk-delete'] );

// loop over the array of record IDs and delete them
			foreach ( $delete_ids as $id ) {
				self::delete_team( $id );

			}

			wp_redirect( esc_url( add_query_arg() ) );
			exit;
		}
	}




}