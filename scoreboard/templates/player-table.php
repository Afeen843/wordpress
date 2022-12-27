<?php


?>

<h1>players</h1>

<form method="Post" action="">

	<?php
	$player = new Inc\player();

    if (isset($_GET['action'])){
        $action = esc_html($_GET['action']);

        switch ($action){
                 case 'update-player':
	            require_once plugin_dir_path( __FILE__ ) . 'edit-player.php';
                break;

////            case 'delete-player':
////	            global $wpdb;
////                $id=$_GET['id'];
////               $result = $wpdb->delete('sb_player',
////                array('id'=>$id)
////                );
//               if($result){
//                   echo " Player Deleted sucessfully";
//               }
//                break;
        }
    }else{
	    $player->prepare_items();
	    $player->search_box('Search','player-search-box');
	    $player->display();
    }


    ?>
</form>


