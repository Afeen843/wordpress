<?php
namespace Inc;

class SbPluginDeactivate
{

	public static function deactivate(){


		flush_rewrite_rules();
	}

}
