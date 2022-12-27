
<html>
<head>
</head>
<body>

<form method="post" action="">

    <br> <label>Team</label>
    <input type="text" name="team1" placeholder="Enter the team1" required><br><br>

    <label>Wickets:</label>
    <input type="text" name="wickets" placeholder="Enter the wickets" required><br><br>

    <label> Score:</label>
    <input type="text" name="score" placeholder="Enter the Score" required><br><br>

    <label> Targets:</label>
    <input type="text" name="target" placeholder="Enter the target to achieve" required><br><br>

    <label>Team2:</label>
    <input type="text" name="team2" placeholder="Enter the Second team" required><br><br>

    <label> Wickets:</label>
    <input type="text" name="wickets2" placeholder="Enter the wickets of second team" required><br><br>

    <label> Score:</label>
    <input type="text" name="score2" placeholder="Enter the Score of second team" required><br><br>

    <input type="submit" name="submit">
</form>


</body>
</html>

<?php


if ( isset( $_POST['submit']  ) && $_POST ) {
	global $wpdb;

	$result = $wpdb->insert( 'sb_scoreboard',
		array(
			'team1'    => $_POST['team1'],
			'team2'    => $_POST['team2'],
			'wickets'  => $_POST['wickets'],
			'score'    => $_POST['score'],
			'target'   => $_POST['target'],
			'wickets2' => $_POST['wickets2'],
			'score2'   => $_POST['score2']

		)
	);

	if ( $result ) {
		echo "Data entered Successfully";
	} else {
		echo "something went wrong";
	}


}


?>

