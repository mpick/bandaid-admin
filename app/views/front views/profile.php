<script>
$(function() {
	$('#tabMenu a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});

$('.tooltipped').tooltip();

});
</script>
<div class='span8'>
<ul class="nav nav-tabs" id="tabMenu">
  <li class="active"><a href="#home">Profile</a></li>
  <li><a href="#projects">My Projects</a></li>
</ul>

<div class='tab-content'>
				<div class='tab-pane fade in active well well-small' id='home'>
<h2><?= $this->user->username ?></h2>

<form enctype="multipart/form-data" action='' method='post'>
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
	<fieldset>
		<img src='<?= $this->user->avatar ?>'><br>
		<input type='file' name='avatar'>
	</fieldset>
	<br>
	<fieldset>
		<label for='email'>Email</label>
		<input type='email' class='input-xxlarge' name='email' value='<?= $this->user->email ?>'>
	</fieldset>
	<fieldset>
		<label for='firstName'>First Name</label>
		<input type='text' class='input-xxlarge' name='firstName' value='<?= $this->user->firstName ?>'>
	</fieldset>
	<fieldset>
		<label for='lastName'>First Name</label>
		<input type='text' class='input-xxlarge' name='lastName' value='<?= $this->user->lastName ?>'>
	</fieldset>
	<fieldset>
		<label for='location'>Location</label>
		<input type='text' class='input-xxlarge' name='location' value='<?= $this->user->location ?>'>
	</fieldset>
	<fieldset>
		<label for='bio'>Bio</label>
		<textarea name='bio'class='input-xxlarge' style='height: 12em'><?= $this->user->bio ?></textarea>
	</fieldset>
	<div class="form-actions">
  <button type="submit" class="btn btn-primary">Save changes</button>
</div>
	</form>
	</div>

	<div class='tab-pane fade in' id='projects'>
		<h2>My Projects</h2>

	<? foreach($this->user->projects as $project): ?>
	<div class='well well-small'>
		<h3><a href='/project/<?= $project->slug ?>'><img src='<?= $project->icon ?>' style='width: 64px'> <?= $project->title ?></a> <? if($project->isAdmin == 1): ?><a href='/manageProject/<?= $project->uuid ?>' class='btn pull-right'><i class='icon-edit'></i> Manage Project</a><? endif; ?></h3>
		<h4>User Role: <?= $project->userRole ?></h4>

	</div>
<? endforeach; ?>
	</div>
</div>