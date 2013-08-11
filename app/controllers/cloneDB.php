<? class cloneDB{


function get(){

$template = new Templater();
$template->load('header');
$template->publish();

?>

<form action='' method='post'>
	<button type='submit' class='btn'>Clone Production DB to Development</button>
</form>

<?

$template->load('footer');
$template->publish();


}


function post(){

exec("mysqldump -h localhost -u production -pcaliforniaGold production | mysql -h localhost -u development -pcaliforniaGold development");


$template = new Templater();
$template->load('header');
$template->publish();

echo "Database cloned";

$template->load('footer');
$template->publish();


}

}