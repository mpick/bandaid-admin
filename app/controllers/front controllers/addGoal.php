<? class addGoal{


function get($uuid){

	global $user;
	global $dbh;

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);

$template = new Templater();
$template->load('header');
$template->title = $project->title . " | Add Goal";
$template->publish();

$template->load('addgoal');
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

$params = array(
	"uuid" => md5(microtime()),
	"projectID" => $project->id,
	"userID" => $user->id,
	"name" => $_POST['goalName'],
	"description" => $_POST['description'],
	"targetAmount" => $_POST['targetAmount'],
	"status" => $_POST['status']
	);

$goal = new Goal();
$goal->insert($params);

				addActivity("$user->username ($user->email) added a goal, &quot;$goal->title&quot; to the project &quot;$project->title&quot;");

$template = new Templater();

$template->load('header');
$template->title = $project->title ." | Add Goal";
$template->publish();

$template->load('alert');
$template->alertType = "message";
if($goal->status == "draft"){$template->message = "Your goal has been added. <a href='/editGoal/" . $goal->uuid . "'>Click here to edit</a>"; 
}else{
$template->message = "Your goal has been published. <a href='/goals/" . $goal->uuid . "'>View goal</a>";

}
$template->publish();

$template->load('footer');
$template->publish();

}

}