<?php

global $wpdb;

$id     = $_GET['id'] ?? '';
$result = $wpdb->query( "Delete from sb_team_table where id=$id" );
if ( $result ) {
	echo "Data Deleted successful";
} else {
	echo "something when wronged";
}


