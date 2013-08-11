<? class releaseFunds{

function get(){
global $dbh;

$goals = array();
$query = "SELECT id FROM goals";
$sth = $dbh->prepare($query);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $g){

	$goals[] = new Goal($g['id']);



}

$template = new Templater();

$template->load('header');
$template->title = "Release Funds";
$template->publish();


$template->load('releasefunds');
$template->goals = $goals;
$template->publish();

}



function post(){

	global $dbh;

$ids = $_POST['id'];

foreach($ids as $id){

$goal = new Goal($id);
$project = new Project($goal->projectID);

$wepay = new WePay($project->wePayAccessToken);

// $sth = $dbh->prepare("SELECT id FROM backers where goalID='$goal->id'");
// $sth->execute();
// $result = $sth->fetchAll(PDO::FETCH_ASSOC);

// echo "<table style='width: 100%'><thead><tr><th>Name</th><th>Email</th><th>Twitter</th><th>Facebook</th><th>UserID</th><th>WePay Checkout ID</th><th>Amount</th><th>Reward</th><th>Date</td></tr></thead><tbody>";

// foreach($result as $b){
// $backer = new Backer($b['id']);
// $tuser = new User($backer->userID);
// $reward = new Reward($backer->rewardID);
// echo "<tr><td>" . $tuser->firstName . " " . $tuser->lastName . "</td><td><a href='" . $tuser->email . "'>" . $tuser->email . "</a></td><td>";

// if(!empty($tuser->twitterAuthToken)) echo "Yes";

// echo "</td><td>";
// if(!empty($tuser->facebookToken)) echo "Yes";

// echo "</td><td>" . $tuser->id . "</td><td>" . $backer->wePayCheckoutID . "</td><td>$" . $backer->amount . "</td><td>" . $reward->name . "</td><td>" . date("m-d-Y h:ia", $backer->dateAdded) . "</td></tr>";
// }

// echo "</tbody></table>";


$i = 0;

$checkouts = $wepay->request('checkout/find', array(
   	// 'checkout_id' => $backer->wePayCheckoutID
		'account_id' => $project->wePayAccountID,
		'limit' => 100000
	    ));
echo "<h1>" . count($checkouts) . " backers</h1>";
echo "<table><thead><tr><th>Checkout ID</th><th>Email</th><th>Name</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead><tbody>";
foreach($checkouts as $checkout){

if($checkout->state == "reserved"){
	$response = $wepay->request('checkout/capture', array(
        'checkout_id' => $checkout->checkout_id
    ));
}
echo "<tr";
switch(true){


case (empty($checkout->payer_email)): echo " style='color:red'";

}
echo "><td>$checkout->checkout_id</td><td>";
if(!empty($checkout->payer_email)) echo "<a href='mailto:$checkout->payer_email'>$checkout->payer_email</a>";
echo "</td><td>";
if(!empty($checkout->payer_name)) echo $checkout->payer_name;
echo "</td><td>$$checkout->amount</td><td>" . $checkout->state . "</td><td>" . date("m-d-Y h:iA", $checkout->create_time) . "</td></tr>";

}
echo "</table>";

// $creator = new User($project->creatorID);

// $params = array("status" => "success");
// $goal->update($params);

// $mail = new emailMessage();

// $mail->to = $creator->email;
// $mail->subject = "Your funds have been released!";

// $mail->body = "The funds for your openfire goal '" . $goal->name . "' have been released into your WePay account! You can visit https://www.wepay.com/account/" . $project->wePayAccountID . " to see your balance.

// Yay!

// The openfire team";

// $mail->send();

	}

// }

}
}
?>