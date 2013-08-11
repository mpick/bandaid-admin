<? class Projects{
	

function get($slug){

global $dbh;

$sth = $dbh->prepare("SELECT id FROM projects where slug='$slug' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
$project->getUpdates(0,5);
$project->getBackers();


$template = new Templater();

$template->load('header');
$template->title = $project->title;
$template->publish();

$template->load('project');
$template->project = $project;
$template->currentGoal = $project->goals[0];
$template->embedly = new Embedly(array(
						'key' => EMBEDLYKEY,
						'user_agent' => $_SERVER['HTTP_USER_AGENT']
						));
$template->publish();

$template->load('footer');
$template->publish();


}



}