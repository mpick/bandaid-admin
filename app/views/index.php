<h2>Recent Activity</h2>
<ul>
	<? foreach($this->activity as $a): ?>
	<li><b><?= date("m-d-Y h:i:sa", $a->dateAdded) ?></b> - <?= $a->message ?></li>
	<? endforeach; ?>
</ul>

<h2>Projects Awaiting Approval</h2>
	<form action='' method='post'>

<table class='table table-striped'>
	<thead>
		<tr><th class='span1'></th><th class='span2'>Title</th><th class='span10'>Description</th><th>Date Added</th></tr>
	</thead>
	<tbody>
	<? foreach($this->pendingProjects as $p): ?>
	<tr><td><input type='checkbox' name='projects[]' value='<?= $p->id ?>'></td><td><b><a href='/projects/<?= $p->uuid ?>'><?= $p->title ?></a></b></td><td><?= $p->initialProposal ?></td><td><?= date("m-d-Y h:i:sa", $p->dateAdded) ?></td></tr>
	<? endforeach; ?>
</tbody>
</table>
<div class='form-actions'>
	<button name='action' value='approve' class='btn btn-success'>Approve Selected Projects</button><br>
		<button name='action' value='reject' class='btn'>Reject Selected Projects</button>
	</div>
</form>

