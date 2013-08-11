<? class addUpdate{


function get($uuid){

	global $dbh;
	global $user;

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$project = new Project($result['id']);

$template = new Templater();

$template->load('header');
$template->title = $project->title ." | Add Update";
$template->publish();

$template->load('addupdate');
$template->project = $project;
$template->publish();

$template->load('footer');
$template->publish();


}

function post(){

global $user;
global $dbh;

$sth = $dbh->prepare("SELECT id FROM projects where uuid='" . $_POST['projectUUID'] . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$project = new Project($result['id']);
$goal = new Goal($_POST['goalID']);


$params = array(
	"uuid" => md5(microtime()),
"title" => $_POST['title'],
"slug" => slugify($_POST['title']),
"goalID" => $_POST['goalID'],
"body" => $_POST['body'],
"userID" => $user->id,
"lastModified" => time()
);

$update = new Update();
$update->insert($params);

				addActivity("$user->username ($user->email) added an update titled &quot;$update->title&quot; to the goal &quot;$goal->name&quot;");

$template = new Templater();

$template->load('header');
$template->title = $project->title ." | Add Update";
$template->publish();

$template->load('alert');
$template->alertType = "message";
$template->message = "Your update has been posted. <a href='/updates/" . $update->uuid . "'>View Update</a>"; 
$template->publish();

$template->load('footer');
$template->publish();

}


}