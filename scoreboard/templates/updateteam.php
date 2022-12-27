<?php
$id=$_GET['id'] ?? '';
global $wpdb;
$post=$wpdb->get_row("select * from sb_team_table where id=$id");

?>

<html>
<head>
</head>
<body>
<h1 style="text-align: center"> Update Team Form</h1>

<form  method="post" action="" class="form-style" >

	<br> <label>Team Name:</label>
	<input type="text" name="Tname"   value="<?php echo $post->Tname?>" required><br><br>

	<label>Type:</label>
	<input type="text" name="Ttype"   value="<?php echo $post->Ttype?>" required><br><br>

	<label> Matches:</label>
	<input type="text" name="matches" value="<?php echo $post->matches?>" required><br><br>

	<label> Won:</label>
	<input type="text" name="won"     value="<?php echo $post->won?>"  required><br><br>

	<label> Lost:</label>
	<input type="text" name="lost"    value="<?php echo $post->lost?>" required><br><br>

	<label> Non Rated:</label>
	<input type="text" name="Nrated" value="<?php echo $post->Nrated?>" required><br><br>


	<button class="button1" name="update">Update</button>
</form>


</body>
</html>

<?php

if ( isset( $_POST['update']  )) {

	global $wpdb;

	$result = $wpdb->update( 'sb_team_table',
		array(

			'Tname'    => $_POST['Tname'],
			'Ttype'    => $_POST['Ttype'],
			'matches'  => $_POST['matches'],
			'won'      => $_POST['won'],
			'lost'     => $_POST['lost'],
			'Nrated'   => $_POST['Nrated']

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


