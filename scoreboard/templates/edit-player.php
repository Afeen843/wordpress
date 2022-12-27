<?php
global $wpdb;

$id=$_GET['id'] ?? '';

$data=$wpdb->get_row("select * from sb_player where id=$id");


?>

<html>
<body>


<h1> this is Edit Player </h1>

<form>

      TeamID: <input type="text" name="teamid"  value="<?php  echo $data->teamid ?>"> <br><br>

      Name:   <input type="text" name="name"    value="<?php echo $data->name ?>"> <br><br>

      Rating: <input type="text" name="rating"  value="<?php echo $data->rating ?>"> <br><br>

               <input type="submit" name="update">

</form>
</body>
</html>

<?php

if (isset($_POST['update'])){

    global $wpdb;

    $id=$_GET['id'];


   $result= $wpdb->update('sb_player',	array(

			'teamid'    => $_POST['teamid'],
			'name'    => $_POST['name'],
			'rating'  => $_POST['rating'],


		),

		array('id'=>$id)
	);

	if ( $result ) {
		echo "Data updated Successfully";
	} else {
		echo "something went wrong";
	}





}

?>


