
<html>
<head>
</head>
<body>
<h1 style="text-align: center"> Add Team Form</h1>

<form  method="post" action="" class="form-style" >

    <br> <label>Team Name:</label>
    <input type="text" name="Tname" placeholder="Enter the Team" required><br><br>

    <label>Type:</label>
    <input type="text" name="Ttype" placeholder="Enter the sport" required><br><br>

    <label> Matches:</label>
    <input type="text" name="matches" placeholder="Enter the Matches Played" required><br><br>

    <label> Won:</label>
    <input type="text" name="won" placeholder="Enter the matches Won" required><br><br>

    <label> Lost:</label>
    <input type="text" name="lost" placeholder="Enter the Matches Lost" required><br><br>

    <label> Non Rated:</label>
    <input type="text" name="Nrated" placeholder="Enter the Non Rated match" required><br><br>


   <button class="button1" name="submit">Submit</button>
</form>


</body>
</html>

<?php

if ( isset( $_POST['submit']  )) {

	global $wpdb;

	$result = $wpdb->insert( 'sb_team_table',
		array(

			'Tname'    => $_POST['Tname'],
			'Ttype'    => $_POST['Ttype'],
			'matches'  => $_POST['matches'],
			'won'      => $_POST['won'],
			'lost'     => $_POST['lost'],
			'Nrated'   => $_POST['Nrated']

		)
	);

	if ( $result ) {
		echo "Data entered Successfully";
	} else {
		echo "something went wrong";
	}


}


?>

