<? class createProject{

function get(){

	global $user;

		$template = new Templater();
$template->load('header');
$template->title = "Submit Project For Proposal";
$template->publish();

	if(empty($user->id)){
	 $error = "You must be logged in to create a project.";
	}else{

	$template = new Templater();
$template->load('createproject');
$template->publish();

	}

$template = new Templater();
$template->load('footer');
$template->publish();

}

function post(){

	$title = $_POST['title'];
	$mediaEmbed = $_POST['mediaEmbed'];

	$description = $_POST['description'];
	$goalTitle = $_POST['goalTitle'];
	$goalDescription = $_POST['goalDescription'];
	$targetAmount = $_POST['targetAmount'];

	$goalTarget = strtotime($_POST['targetMonth'] . "/" . $_POST['targetDay'] . "/" . $_POST['targetYear']);

	$project = new Project();

	$params = array(
		"uuid" => md5(microtime()),
		"title" => $title,
		"mediaEmbed" => $mediaEmbed,
		"initialProposal" => $description,
		"slug" => slugify($title),
		"status" => "draft");

	$project->insert($params);

	$goal = new Goal();

	$params = array(
		"projectID" => $project->id,
		"uuid" => md5(microtime()),
		"mediaEmbed" => $_POST['goalMediaEmbed'],
		"name" => $goalTitle,
		"slug" => slugify($goalTitle),
		"description" => $goalDescription,
		"targetAmount" => $targetAmount,
		"targetDate" => $goalTarget,
		"status" => "draft"
		);

	$goal->insert($params);

	global $user;

	global $dbh;

	$sth = $dbh->prepare("insert into projectUsers (projectID, userID, type, isAdmin) values('$project->id','$user->id','1','1')");
	$sth->execute();

	$msg = "Thanks! Your project has been submitted to beabandaid.co. We'll get back to you. No, really. We'll call you.";

addActivity("$user->fullname ($user->email) created a project, &quot;$project->title&quot;");


$template = new Templater();

$template->load('header');
$template->title = "Thanks!";
$template->publish();

$template->load('alert');
$template->type = "success";
$template->message = $msg;
$template->publish();

$template->load('footer');
$template->publish();

}

}