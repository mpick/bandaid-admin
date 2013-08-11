<div class='span8 well well-small'>

<form action='' method='post'>
	<input type='hidden' name='projectUUID' value='<?= $this->project->uuid ?>'>
	<fieldset>
		<label for='goalName'>Name</label>
		<input type='text' class='input-xxlarge' name='goalName'>
	</fieldset>

	<fieldset>
		<label for='description'>Description</label>
		<textarea style='height: 12em' class='input-xxlarge' name='description'></textarea>
	</fieldset>

	<fieldset>
		<label for='targetAmount'>Target Amount</label>
		<div class="input-prepend">
  <span class="add-on">$</span>
  <input class="input-xlarge" name='targetAmount' type="text" placeholder="In US dollars">
</div>
	</fieldset>
<br>
	<fieldset>
<button class='btn btn-info' type='submit' name='status' value='draft'>Save As Draft</button>
<button class='btn btn-success' type='submit' name='status' value='published'>Publish</button>

	</fieldset>

</form>

</div>