<script>
$(function() {
	$('#tabMenu a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});

$('.tooltipped').tooltip();

$('#inviteUserForm').ajaxForm({
	dataType: 'json',
	success: function(data){
		$('#inviteUserForm').html("<b>" + data.msg + "</b>");
	}
});

});
</script>
<div class='span8'>
<ul class="nav nav-tabs" id="tabMenu">
  <li class="active"><a href="#home">Overview</a></li>
  <li><a href="#goals">Goals</a></li>
  <li><a href="#team">Team</a></li>
</ul>
			<!-- <ul class='span8 nav nav-tabs'>
				<li class='active'><a href='#home' data-toggle='tab'>Home</a></li>
				<li><a href='#goals'  data-toggle='tab'>Goals</a></li>

				</ul>
-->
			<div class='tab-content'>
				<div class='tab-pane fade in active' id='home'>
											<legend>Overview</legend>
						<h4>Status: <span class='label<?

					switch(true){


						case($this->project->status == 'published'):
						echo " label-success";
						break;

						case($this->project->status == 'rejected' || $this->project->status == 'pending approval'):
						echo " label-important";
						break;

					}


					?>'><?= ucwords($this->project->status) ?></span></h4>
					<form action='' method='post' class=' well well-small'>
						<input type='hidden' name='uuid' value='<?= $this->project->uuid ?>'>
						<fieldset>
							<img src='<?= $this->project->icon ?>' style='width: 128px'><br>
							<input type='file' name='icon'>
						</fieldset> 
						<fieldset>
							<label for='title' style='font-size: 1.5em' >Title</label>
							<? if($this->project->status == "draft" || $this->project->status == "pending approval"): ?><input type='text' class='input-xxlarge' style='font-size: 1.5em' name='title' value="<?= $this->project->title ?>"><? else: ?><h2><?= $this->project->title ?></h2><? endif; ?>
				 		</fieldset>
						<fieldset>
							<label for='subtitle'>Tagline</label>
							<input type='text' class='input-xxlarge' name='subtitle' value="<?= $this->project->subtitle ?>">
				 		</fieldset>
						<fieldset>
							<label for='description'>Description</label>
							<textarea name='description' class='input-xxlarge' style='height: 12em'><? if(!empty($this->project->description)): echo $this->project->description; else: echo $this->project->initialProposal; endif; ?></textarea>
				 		</fieldset>
				 		<fieldset>
				 			<button type='submit' class='btn'>Update</button>
				 		</fieldset>
					</form>
				</div>
				<div class='tab-pane fade in' id='goals'>

						<legend>Goals <a href='/manageProject/<?= $this->project->uuid ?>/addGoal' class='btn pull-right'><i class='icon-plus-sign' style='color: #5bb75b'></i> Add A Goal</a></legend>

				<? foreach($this->project->goals as $goal): 

					$goalPercentage = ($goal->currentAmount / $goal->targetAmount) * 100;

				?>
				<div class='well well-small'>
					<div><h2 class='pull-left'><?= $goal->name ?> <span class='label <?

					switch(true){
						case($goal->status == 'current'):
						echo " label-info";
						break;

						case($goal->status == 'success'):
						echo " label-success";
						break;

						case($goal->status == 'failed'):
						echo " label-important";
						break;

					}


					?>'><?= ucwords($goal->status) ?></span></h2><? if($goal->status != "success" && $goal->status != "failed"): ?><a class='btn pull-right' href='/editGoal/<?= $goal->uuid ?>'><i class='icon-edit'></i> Edit Goal</a><? endif; ?>
					</div>
					<div class='clearfix'></div>
					<div><?= $goal->description ?></div>
					<div style='margin-top: 1em'>
						<h3>Funding</h3>
							<div class="progress<?

if($goal->status != "success") echo " progress-striped";

							switch(true){

								case($goalPercentage < 33):
								echo " progress-danger";

								break;

								case($goalPercentage > 33 && $goalPercentage < 50):
								echo " progress-warning";

								break;

								case($goalPercentage > 66):
								echo " progress-success";
								break;



							}

							?>">
		      	<div class="bar" style="width: <?= $goalPercentage ?>%"></div>
      				</div>
		      		<h4>Target: $<?= number_format($goal->targetAmount, 2) ?> | Current Funding: $<?= number_format($goal->currentAmount,2) ?></h4>

      </div>
				</div>
			<? endforeach; ?>
						
				</div>

				<div class='tab-pane fade in' id='team'>

						<legend>Team <a href='#inviteUser' class='btn pull-right' data-toggle="modal"><i class='icon-plus-sign' style='color: #5bb75b'></i> Invite User</a></legend>
<ul class="thumbnails">

				<? foreach($this->project->team as $teammember): ?>
  <li class="span2">
    <a href='#'>
    	<div class="thumbnail" style='text-align:center'>
      <img src="<?= $teammember->avatar ?>" alt="" style='width:64px'>
      <b><?= $teammember->fullName ?></b>
       <span class='label label-info'>Founder</span>
    </div>
</a>
  </li>
			<? endforeach; ?>
						
				</div>

</div>
</div>
<div id="inviteUser" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Invite User</h3>
  </div>
  <div class="modal-body">
  	<p>Enter your user's email address below. If they're not already an openfire member, they'll receive an email inviting them to join.</p>
    <form class='form-inline' id='inviteUserForm' action='/ajax/inviteUser' method='post'>
    	<fieldset>
    		<input type='hidden' name='projectUUID' value='<?= $this->project->uuid ?>'>
    	<input type='text' name='email' placeholder='Email address'> 
    	<button type='submit'>Invite User</button>
    </fieldset>

    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
  </div>
</div>