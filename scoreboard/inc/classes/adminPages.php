<?php

namespace Inc;

class adminPages{

	/**
	 * Customs Post Scoreboard
	 * @return void
	 */

	function custom_post_type() {

		register_post_type( 'scoreboard', [ 'label' => 'scoreboard', 'public' => true ] );
	}


	public function Register() {

		add_action( 'init', array( $this, 'custom_post_type' ) );
	}





}