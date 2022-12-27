<?php

namespace Inc;

class SbPluginActivate {
	public $table_name = 'sd_scoreboard';

	public static function activate() {
		flush_rewrite_rules();

	}





}

