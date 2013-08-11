<div class='span12'>
	<form action='' method='post'>
	<table class='table table-striped'>
		<thead>
			<tr><th><input type='checkbox' id='selectAll'></th><th>Project</th><th>Goal</th><th>Target Amount</th><th>Current Amount</th><th>Backers</th><th>Target Date</tr></tr>
		</thead>
		<tbody>
			<? foreach($this->goals as $goal): $project = new Project($goal->projectID); ?>
			<tr><td><input type='checkbox' name='id[]' value='<?= $goal->id ?>'></td><td><?= $project->title ?></td><td><?= $goal->name ?></td><td><?= $goal->targetAmount ?></td><td><?= $goal->currentAmount ?></td><td><?= count($goal->backers) ?></td><td><?= date("m-d-Y", $goal->targetDate) ?></td></tr>
		<? endforeach; ?>
		</tbody>

	</table>
	<div style='text-align:right'><button type='submit'>Release Funds</button></div>
</form>
</div>