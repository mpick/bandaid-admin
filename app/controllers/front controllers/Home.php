<? class Home{

function get(){

	global $dbh;
	global $user;


$recentprojects = array();
$featuredprojects = array();
$featuredgoals = array();
$recentupdates = array();

	$sth = $dbh->prepare("SELECT id FROM projects where status = 'published' order by dateAdded desc limit 5");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){
	$recentprojects[] = new Project($p['id']);
}


$sth = $dbh->prepare("SELECT projectID FROM featuredProjects where isCurrent = '1' order by dateAdded desc limit 5");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){
	$featuredprojects[] = new Project($p['projectID']);
}

$sth = $dbh->prepare("SELECT goalID, description FROM featuredGoals where isCurrent = '1' order by dateAdded desc limit 5");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){
	$thisgoal = array("goal" => new Goal($p['goalID']), "description" => $p['description']);
	$featuredgoals[] = $thisgoal;
}

$sth = $dbh->prepare("SELECT id FROM updates where deleted = '0' order by dateAdded desc limit 5");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){
	$recentupdates[] = new Update($p['id']);
}


$template = new Templater();
$template->load('header');
$template->publish();

$template = new Templater();
$template->load('homePage');
$template->embedly = new Embedly(array(
						'key' => EMBEDLYKEY,
						'user_agent' => $_SERVER['HTTP_USER_AGENT']
						));
$template->featuredprojects = $featuredprojects;
$template->featuredgoals = $featuredgoals;

$template->recentprojects = $recentprojects;
$template->recentupdates = $recentupdates;

$template->publish();



$template = new Templater();
$template->load('footer');
$template->publish();

}

} 

?>