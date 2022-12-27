<?php
namespace Inc;

class player extends wpListing {

	/**
	 * Constructor
	 *
	 * @param array $args
	 */

	public function __construct( array $args = array() ) {
		parent::__construct( [
			'plural'   => 'players',
			'singular' => 'player',
			'ajax'     => true
		] );
	}

	/**
	 * Prepare Items
	 * @return void
	 */

	public function record_account(){
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM sb_player";

		return $wpdb->get_var( $sql );

	}

	public function prepare_items() {


		$columns=$this->get_columns();

		$hidden=$this->get_hidden_columns();

		$sortable=$this->get_sortable_columns();

		$this->_column_headers=array($columns,$hidden,$sortable);

		$per_page=5;

		$current_page=$this->get_pagenum();

		$total_items=$this->record_account();

		$this->set_pagination_args(
			[
				'total_items'=>$total_items,
				'per_page'=>$per_page
			]
		);

		$this->items=self::get_players($per_page,$current_page);

	}

	public function column_default( $item, $column_name ) {
		switch ($column_name){
			case 'id';
			case 'teamid':
			case 'name':
			case 'rating':
				return $item->$column_name;

			default:
				return	print_r($item,true);
		}

	}


	/**
	 * Get players
	 * @return array|object|stdClass[]|null
	 */
	public static function get_players($per_page,$page_number) {
		global $wpdb;

		$sql="select * from sb_player";

		if ( ! empty( $_REQUEST['orderby'] ) ) {

			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";

		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


		return $wpdb->get_results( $sql );
	}

	public function get_columns() {

		$columns=array(
			'id'=>'ID',
			'teamid'=>'TeamID',
			'name'=>'Name',
			'rating'=>'Rating'
		);
		return $columns;

	}

	public function column_name($item){

		$action=array(

			"Update"=> sprintf('<a href="?page=%s&action=%s&id=%s" > Update </a>', $_REQUEST['page'],'update-player',$item->id ),

			"Delete"=> '<a id=delete-player href="javascript:void(0)"> delete </a>'
		);

		return sprintf('%1$s %2$s', $item->name,$this->row_actions($action) );

	}

	public function get_hidden_columns(){

		return array('');
	}

	public function get_sortable_columns() {
		return	array(
			'rating'=>array('name',false),
			'id'=>array('id',false)
		);
	}
}