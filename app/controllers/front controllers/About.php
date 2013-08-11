<? class About{
	

function get(){
	$template = new Templater();
	$template->load('header');
	$template->title = "About Us";
	$template->publish();
	$template->load('about');
	$template->publish();
	$template->load('footer');
	$template->publish();

}

}