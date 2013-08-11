<div class='span7 well'>
	<form action='' method='post'>
		<legend>Submit Project For Proposal</legend>
		<fieldset>
			<label for='title' style='font-size: 1.25em' >Project Title</label><input type='text'class='input-xxlarge' name='title' placeholder='Title'>
		</fieldset>
		<fieldset>
			<label for='mediaEmbed'>Media URL</label><input type='text'class='input-xxlarge' name='mediaEmbed' placeholder='e.g. http://vimeo.com/58933055'>
		</fieldset>
		<fieldset>
						
			<label for='description'>Initial Proposal</label><textarea class='input-xxlarge' style='height: 12em'name='description' placeholder="1000 characters max."></textarea>
<span class="help-block">This doesn't have to be your final project description; this is what you're proposing to beabandaid.co that your project is going to be about.</span>
		</fieldset>
		<hr>
		<fieldset>
			<legend>Initial Goal</legend>
			<label for='goalTitle'>Title</label>
						<span class="help-block">This is your project's first goal. Be specific about what the goal is and what you'll do to achieve it.</span>
			<input type='text' name='goalTitle'  class='input-xxlarge' placeholder='title of initial goal'>
		</fieldset>
				<fieldset>
			<label for='goalMediaEmbed'>Media URL</label><input type='text'class='input-xxlarge' name='goalMediaEmbed' placeholder="e.g. http://vimeo.com/58933055 (this can be the same as your project's media embed, for now.)">
		</fieldset>
		<fieldset>
			<label for='goalDescription'>Description</label><textarea class='input-xxlarge' name='goalDescription' style='height:12em'></textarea>
		</fieldset>
		<fieldset>
			<label for='targetAmount'>Funding Required</label><div class="input-prepend">
  <span class="add-on">$</span>
  <input class="input-xxl" name='targetAmount' type="text" placeholder="In US dollars">
</div>
		</fieldset>
		<fieldset>
			<label for='targetMonth'>Target Date For Goal</label>
			<select name='targetMonth'>
			<? for($i = 1; $i < 13; $i++): ?>
			<option value='<?= sprintf("%02d", $i) ?>'<? $nextMonth = sprintf("%02d", $i); if($nextMonth == date("m") + 1){ echo " selected='selected'";} ?>><?= date("F", mktime(0, 0, 0, $i, 10)) ?></option>
		<? endfor; ?>
	</select> <select name='targetDay' class='input-small'>
			<? for($i = 1; $i < 32; $i++): ?>
			<option value='<?= sprintf("%02d", $i) ?>'<? $thisDay = sprintf("%02d", $i); if($thisDay == date("d")){ echo " selected='selected'";} ?>><?= sprintf("%02d", $i) ?></option>
		<? endfor; ?>
	</select>
	</select> <select name='targetYear' class='input-small'>
			<? for($i = 0; $i < 2; $i++): ?>
			<option value='<?= date("Y") + $i ?>'><?= date("Y") + $i ?></option>
		<? endfor; ?>
	</select>
		</fieldset>
		<fieldset>
			<button type='submit' class='btn'>Submit Project For Proposal</button>
	</form>
</div>
<div class='span5'>
	<h3>creating a project</h3>
	<p>So you want to create an BandAid project? Awesome! There's some things you should know first, though.</p>
<ul class='explanatory'>
	<li><p><b>An BandAid project is defined by multiple stages, or "goals".</b> This is one of the things that makes us different from other funding platforms: we're here to help you achieve larger, more complex projects, through a series of well-defined goals with individual funding targets. Reach a goal, and you can move on to the next one.</p><p>Think of them as mini-bosses; you have to beat each mini-boss to complete the game. :-)</p>
		<p>Initially, each goal must be accompanied by a financial target. As you complete goals, you'll be able to "unlock" the ability to add non-monetary goals, which your team and backers can help you complete in ways that don't necessarily involve money.</p></li>
	<li><p><b>All BandAid projects are curated</b>. That means that once you submit your project, it'll be sent to our team for review. You'll receive an email whether we approve it or reject it.</p>
		<p>If we reject it, it doesn't mean we don't think your idea is great; it just means we don't think it's a fit for BandAid. Don't be discouraged!</p>
	</li>
		<li><p><b>Think hard about your initial goal.</b> During our approval process, we look carefully at a project's initial goal. What we want to see is a <b>concrete, achievable goal with a reasonable financial target amount</b>.</p><p>"Change the world" is an example of a bad initial goal; a better example might be "Complete initial prototype of hardware" or "Complete feasibility study".</p></li>
	<li><p><b>Once we approve your project</b>, you'll be able to add a project icon, media, a more detailed description, and existing team members. You'll also be able to add more information about your initial goal.</p></li>
	<li><p><b>When you're approved and ready to roll</b>, you can set your project to be published. Once a project is published, it can't be unpublished...so be sure you've got everything you need to get rolling!</p></li>
	<li><p><b>If you have any questions,</b> feel free to <a href='/contact'>contact us</a> and ask them!</p></li>

</ul>
</div>