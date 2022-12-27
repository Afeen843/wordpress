<?php
global $wpdb;
$id=$_GET['id'] ?? '';
$result=$wpdb->query("delete from sb_scoreboard where match_id=$id");
if($result){
	echo "Data Deleted successful";
}else{
	echo "something when wronged";
}

