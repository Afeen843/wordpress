<?php

namespace Inc;

class pagiantion {

	/**
	 * @var Total Record
	 */
	private  int $totalRecord;

	/**
	 * @var Limit
	 */
	private int $limit=2;

	/**
	 * @var Pages
	 */
	public int $pages;

	/**
	 * @var Offets
	 */
	private int $offset;

	/**
	 * Set No of records
	 * @param $record
	 *
	 * @return void
	 */
	public function setTotalRecords( $record ) {
		$this->totalRecord = $record;
	}

	/**
	 * Set Limits
	 * @param $limit
	 *
	 * @return void
	 */
	public function setLimit( $limit ) {

		$this->limit = $limit;
	}

	/**
	 * @param $tableName
	 *
	 * @return array|object|\stdClass[]|null
	 */
	public function load( $tableName ) {
		global $wpdb;

		return $wpdb->get_results( "SELECT * FROM $tableName" );
	}

	/**
	 * Calculate Offset
	 * @return void
	 */
      public function calculateOffset(){

	      $this->offset= ($this->pages - 1) * $this->limit;
      }

	/**
	 * Pagination
	 * @param string $tableName
	 * @param $limit
	 *
	 * @return array|int
	 */

	public function pagination( string $tableName, $limit )
	{

		$this->calculateOffset();

		global $wpdb;

		$Limit = $limit ?? '5';

		$sql = "SELECT * FROM  $tableName  LIMIT $Limit OFFSET $this->offset ";


		$result = $wpdb->get_results( $sql );

		if ( $result ) {
			return $result;
		} else {
			return 0;
		}

	}


	/**
	 *  Calculate Total Pages
	 * @return void
	 */
	public function totalpages() {

		$this->pages = ceil( $this->totalRecord / $this->limit );


	}

	/**
	 * Calculate No of records in Databases
	 * @param string $table
	 *
	 * @return void
	 */
	public function GetCount( string $table ) {

		global $wpdb;

		$sql               = "SELECT * FROM $table";
		$result            = $wpdb->get_results( $sql );
		$this->totalRecord = count( $result );
		self::totalpages();


	}

}