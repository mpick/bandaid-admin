<? class ajxInviteUser{

function get(){

echo "This is an internal API endpoint. Nothing to see here. Move along.";

}

function post(){

	global $user;
	global $dbh;

	$response = array();


	$sth = $dbh->prepare("SELECT id FROM projects where uuid='" . $_POST['projectUUID'] . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);


	if(empty($user->id)){
		$response['code'] = "401";
		$response['msg'] = "You must be a logged in user to do this.";
	}else{

	$sth = $dbh->prepare("SELECT id FROM users where email='" . $_POST['email'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if(!empty($result['id'])){
	$inviteUser = new User($result['id']);
	}else{

		$params = array(
			"uuid" => md5(microtime()),
			"email" => $_POST['email'],
			"active" => 0
			);

		$inviteUser = new User();
		$inviteUser->insert($params);


	}

$invite = new projectInvitation();

$params = array(
	"uuid" => md5(microtime()),
	"projectID" => $project->id,
	"inviterID" => $user->id,
	"inviteeID" => $inviteUser->id,

	);

$invite->insert($params);

addActivity("$user->fullname ($user->email) invited $inviteUser->email to join the project &quot;$project->title&quot;");


$msg = "Hi there! 

You've been invited to join the BandAid project '" . $project->title . "' by " . $user->fullName . " (" . $user->email . ")

To accept this invitation, just click here: http://" . $_SERVER['SERVER_NAME'] . "/acceptInvite/" . $invite->uuid;

if($inviteUser->active == 0){
	$msg .= "

When you click on the link, you'll be able to create your own BandAid account and get started on this project!";
}else{
	$msg .="

Once you're done, you can begin collaborating on this project!";
}

$msg .="

Cheers,
The BandAid team";

$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = CONFIRMATIONEMAIL;  
	$mail->Password = CONFIRMATIONEMAILPASS;           
	$mail->SetFrom(CONFIRMATIONEMAIL, CONFIRMATIONEMAILNAME);
	$mail->Subject = "You've been invited to join an BandAid project";
	$mail->Body = $msg;
	$mail->AddAddress($inviteUser->email);
	if(!$mail->Send()) {
		$response['code'] = "500";
		$response['msg'] = 'Mail error: '.$mail->ErrorInfo; 
		
	} else {

		$response['code'] = "200";
		$response['msg'] = "Thank you! Your invitation has been sent.";


	}




	}

echo json_encode($response);

}

}