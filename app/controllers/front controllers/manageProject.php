<? class manageProject{

function get($uuid){

global $user;
global $dbh;



$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
if(empty($user->id)){$error = "Sorry, you must be logged in to manage this project.";}else{
$sth = $dbh->prepare("SELECT * FROM projectUsers where projectID='$project->id' and userID='$user->id' and isAdmin='1' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
//if(count($result) == 0) $error = "Sorry, you do not have admin privileges for this project.";

}

$template = new Templater();

$template->load('header');
$template->title = "Manage Project | " . $project->title;
$template->publish();

if(isset($error)){

	$template->load('alert');
$template->type = "error"; $template->message = $error;
$template->publish();
}else{

$template->load('manageproject');
$template->project = $project;
$template->publish();

}

$template = new Templater();
$template->load('footer');
$template->publish();

}

function post(){

global $user;
global $dbh;

	$uuid = $_POST['uuid'];
	if(!empty($_POST['title'])) $title = $_POST['title'];
$subtitle = $_POST['subtitle'];
$description = $_POST['description'];

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
if(empty($user->id)){$error = "Sorry, you must be logged in to manage this project.";}else{
$sth = $dbh->prepare("SELECT * FROM projectUsers where projectID='$project->id' and userID='$user->id' and isAdmin='1' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
//if(count($result) == 0) $error = "Sorry, you do not have admin privileges for this project.";

$params = array(
	"subtitle" => $subtitle,
	"description" => $description,
	"lastUpdated" => time()
	);

if(!empty($title)) $params['title'] = $title;
$project->update($params);

$template = new Templater();

$template->load('header');
$template->title = "Manage Project | " . $project->title;
$template->publish();



	$template->load('alert');
$template->type = "message"; $template->message = "Your project has been updated.";
$template->publish();


$template->load('manageproject');
$template->project = $project;
$template->publish();



$template = new Templater();
$template->load('footer');
$template->publish();

}




}

}