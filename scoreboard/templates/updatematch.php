<?php
$id=$_GET['id'] ?? '';
global $wpdb;
$post=$wpdb->get_row("select * from sb_scoreboard where match_id=$id");

?>

<html>

<body>

	<form method="post" action="">

		<br> <label>Team1:</label>
		<input type="text" name="team1" value="<?php echo $post->team1?>" required><br><br>

		<label>Wickets:</label>
		<input type="text" name="wickets" value="<?php echo $post->wickets?>" required><br><br>

		<label> Score:</label>
		<input type="text" name="score" value="<?php echo $post->score?>" required><br><br>

		<label> Targets:</label>
		<input type="text" name="target" value="<?php echo $post->target?>" required><br><br>

		<label>Team2:</label>
		<input type="text" name="team2" value="<?php echo $post->team2?>" required><br><br>

		<label> Wickets:</label>
		<input type="text" name="wickets2" value="<?php echo $post->wickets2?>" required><br><br>

		<label> Score:</label>
		<input type="text" name="score2" value="<?php echo $post->score2?>" required><br><br>

		<input type="submit" name="update" value="update">
	</form>

</body>
</html>

<?php

if ( isset( $_POST['update']  ) ) {

	global $wpdb;

	$result = $wpdb->update( 'sb_scoreboard',
		array(
			'team1'    => $_POST['team1'],
			'team2'    => $_POST['team2'],
			'wickets'  => $_POST['wickets'],
			'score'    => $_POST['score'],
			'target'   => $_POST['target'],
			'wickets2' => $_POST['wickets2'],
			'score2'   => $_POST['score2']

		),
        array('match_id'=>$id)
	);

	if ( $result ) {
		echo "Data updated Successfully";
	} else {
		echo "something went wrong";
	}


}
