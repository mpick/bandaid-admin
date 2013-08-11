<? class Index{

function get(){

	global $user;

global $dbh;

$a = array();
$p = array();

$sth = $dbh->prepare("SELECT id FROM activityLog order by dateAdded desc limit 0,10");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $r){

$a[] = new Activity($r['id']);

}

$sth = $dbh->prepare("SELECT id FROM projects where status='pending approval' order by dateAdded desc");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $r){

$p[] = new Project($r['id']);

}

$template = new Templater();

$template->load('header');
$template->publish();

$template->load('index');
$template->activity = $a;
$template->pendingProjects = $p;

$template->publish();

}

 function post(){

 foreach($_POST['projects'] as $pid){

$project = new Project($pid);
$creator = new User($project->creatorID);

$email = new emailMessage();
$email->to = $creator->email;

if($_POST['action'] == "approve"){
	$project->update(array("status" => "draft"));

$email->subject = "Your BandAid project has been approved!";
$email->body = "Hello $creator->firstName,

Your BandAid project \"$project->title\" has been approved! You'll need to login and finish setting it up; you can do that by visiting http://dev.beabandaid.co/finishProject/$project->uuid and filling in the appropriate information.

Thanks!
The BandAid team.
";

}else{
		$project->update(array("status" => "rejected"));

$email->subject = "Your BandAid project has been rejected";
$email->body = "Hello $creator->firstName,

Thanks for submitting your project \"$project->title\" to BandAid. Unfortunately, after careful consideration, we've decided it's just not the right fit for BandAid.

Don't be discouraged, though!

Good luck!
The BandAid team.
";


}

$email->send();

 }

header("Location: /");
 }

}