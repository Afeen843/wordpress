<?php

if(! defined('WP_UNINSTALL_PLUGIN')){
	die;
}

global $wpdb;
$wpdb->query("delete from wp_post where post_type='scoreboard'");
$wpdb->query("delete from wp_postmeta where post_id not in (select id from wp_posts )");
$wpdb->query("delete from wp_term_relationship where object_id not in (select id from wp_posts)");