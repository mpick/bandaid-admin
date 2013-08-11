<? class Goals{

function get($uuid){

global $dbh;
        $sth = $dbh->prepare("SELECT id FROM goals where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);
$goal->getUpdates();
$project = new Project($goal->projectID);

$template = new Templater();

$template->load('header');
$template->title = $project->title . " | " . $goal->name;
$template->publish();

$template->load('goal');
$template->embedly = new Embedly(array(
						'key' => EMBEDLYKEY,
						'user_agent' => $_SERVER['HTTP_USER_AGENT']
						));
$template->project = $project;

$template->goal = $goal;
$template->publish();

$template->load('footer');
$template->publish();


}

}