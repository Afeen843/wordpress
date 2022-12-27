
<html>

<h1>Welcome To Match lists</h1>


<div class="container">
    <table class="team-table" >
    <tr>
        <th> MatchID</th>
        <th>Team Name</th>
        <th>score</th>
        <th>Wickets</th>
    </tr>
	<?php
	$page=new Inc\pagiantion();
	$data=$page->load('sb_scoreboard');
	foreach ($data as $data2)
    {
	?>
    <tr style="text-align: center">
        <td><?php echo $data2->match_id ?></td>
        <td><?php echo $data2->team2 ?></td>
        <td><?php echo $data2->score2 ?></td>
        <td><?php echo $data2->wickets2 ?></td>
    </tr>
    <?php } ?>
</table>

    <table style="border: solid;width: 30%;">
        <tr>
            <th> MatchID</th>
            <th>Team Name</th>
            <th>Score</th>
            <th>Wickets</th>
            <th>Action</th>
        </tr>
		<?php
		foreach ($data as $data1){
			?>
            <tr style="text-align: center">
                <td><?php echo $data1->match_id; ?></td>
                <td><?php echo $data1->team1;    ?></td>
                <td><?php echo $data1->score;    ?></td>
                <td><?php echo $data1->wickets;  ?></td>

                <td>
                    <a href="admin.php?page=update_match&id=<?php echo $data1->match_id?> " >Update</a>
                    <a href="admin.php?page=delete_match&id=<?php echo $data1->match_id?> " >Delete</a>
                </td>
            </tr>
		<?php } ?>
    </table>
</div>

</html>


