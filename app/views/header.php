<? global $user; ?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="/css/elusive-webfont.css">


<title>Openfire Admin<? if(!empty($this->title)) echo " | " . $this->title ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> 
<script src='/js/bootstrap.min.js'></script>
<script src="/js/holder.js"></script>
<script src="/js/jquery.form.js"></script>
<? if(!empty($this->scripts)): foreach($this->scripts as $url): ?>
<script src='<?= $url ?>'></script>
<? endforeach; endif; ?>
<!-- <script>
$(function() {
	function activateTab () {
   var activeTab = $('[href=' + location.hash + ']');
   activeTab && activeTab.tab('show');      
}

// Trigger when the page loads
activateTab();

// Trigger when the hash changes (forward / back)
$(window).hashchange(function(e) {
    activateTab();
});

// Change hash when a tab changes
$('a[data-toggle="tab"], a[data-toggle="pill"]').on('shown', function (event) {
    location.href = event.target.href;
});
});
</script>
-->

</head>
<body>
	<div class='container-fluid'>
		<div class="navbar navbar-inverse">
		  <div class="navbar-inner">
		    <a class="brand" href="/"><img src='/img/logo_textual_inverse.png' style='height:32px'></a>
		    <ul class="nav">
		      <li><a href="/">Home</a></li>
		      <li><a href="/about">About</a></li>
		      <li><a href="/projects">Projects</a></li>
		      <li><a href="http://blog.beabandaid.co">News</a></li>

		    </ul>
		    <ul class='nav pull-right'>
		    	<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><? if(empty($user->id)): ?>Sign Up/Login<? else: echo "<img src='" . $user->avatar . "' style='height: 16px'> " . $user->fullName . " (" . $user->username . ")"; endif; ?><b class='caret'></b></a>

  	<? if(empty($user->id)): ?>
  	  <ul class="dropdown-menu span4" role="menu" aria-labelledby="dLabel"  style='padding: 1em'>
  	  	  	<li>

  	<form action='/login' method='post'>
  		<input type='text' class='input-xlarge' name='login' placeholder='Login'><br>
  		<input type='password' class='input-xlarge' name='password' placeholder='Password'><br>
  		<button class='btn btn-small' type='submit'>Login</button> or <a href='/signup' class='btn btn-info'>Signup</a>
<hr class='clearfix'>
<!-- <button class='btn btn-info btn-small'><i class='icon-twitter'></i> Login With Twitter</button>
<button class='btn btn-info btn-small'><i class='icon-facebook'></i> Login With Facebook</button>
 --></form>
	<? else: ?>
	  	  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"  style='padding: 1em'>
  	  	  	<li>
	<ul class='unstyled'>
		<li><a href='/profile'>My Profile</a></li>
		<li><a href='/profile/#projects'>My Projects</a></li>
		<li><a href='/createProject'>Create A Project</a></li>
		<li><a href='/logout'>Logout</a></li>
	</ul>
	<? endif; ?>
</li>
  </ul>
</li>
</ul>
		  </div>
		</div>
<!-- 		<div class='row-fluid'>
			<div class='span12' style='text-align:right'>
				<form class='form-search' action='/search' method='get'>
					<div class='input-append'><input type="search" class="input-xlarge search-query">
  <button type="submit" class="btn">Search</button>
</div>
				</form>
			</div>
		</div> -->
<div class='row-fluid'>