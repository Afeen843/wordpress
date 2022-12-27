<html>

<h1>Match lists </h1>


<select name="limit">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
</select>

<table class="team-table" style="border: solid;width: 100%">
    <thead>
    <tr>

        <th>ID</th>
        <th>Team Name</th>
        <th>Type</th>
        <th>Matches</th>
        <th>Won</th>
        <th>lost</th>
        <th>R_Rated</th>
        <th>Action</th>

    </tr>

    </thead>
    <tbody>
	<?php
	$page = new Inc\pagiantion();
	$data = $page->load( 'sb_team_table' );
	foreach ( $data as $data ) {
		?>
        <tr style="text-align: center">
            <td class="listing-td"><?php echo $data->id; ?></td>
            <td class="listing-td"><?php echo $data->Tname; ?></td>
            <td class="listing-td"><?php echo $data->Ttype; ?></td>
            <td class="listing-td"><?php echo $data->matches; ?></td>
            <td class="listing-td"><?php echo $data->won; ?></td>
            <td class="listing-td"><?php echo $data->lost; ?></td>
            <td class="listing-td"><?php echo $data->Nrated; ?></td>
            <td class="listing-td">
                <a href="admin.php?page=team_update&id=<?php echo $data->id ?> ">Update</a>
                <a href="admin.php?page=team_delete&id=<?php echo $data->id ?> ">Delete</a>
            </td>
        </tr>
	<?php } ?>
    </tbody>
</table>
</div>
<?php

$page->GetCount( 'sb_team_table' );
for ( $i = 1; $i <= $page->pages; $i ++ ) {


	?>

    <diV class="pagination">  <a href="admin.php?page=sb_team?data=<?php echo $i; ?>"> <?php echo $i; ?> </a>  </diV>


<?php } ?>

</html>


