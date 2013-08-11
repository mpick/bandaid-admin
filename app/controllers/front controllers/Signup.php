<? class Signup{

function get(){


$template = new Templater();
$template->load('header');
$template->title = "Signup";
$template->publish();

$template = new Templater();
$template->load('signup');
$template->publish();


$template = new Templater();
$template->load('footer');
$template->publish();

}

function post(){


	$template = new Templater();
$template->load('header');
$template->title = "Signup";
$template->publish();

if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'] ){

$error = "Password is empty or passwords do not match";

}else{

		global $dbh;
$sth = $dbh->prepare("SELECT id FROM users where username='" . $_POST['username'] . "' or email='" . $_POST['email'] . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
if(!empty($result)){$error = "That username or email is already taken, sorry!";}else{



$pwdHasher = new PasswordHash(8, FALSE);
$password = $pwdHasher->HashPassword( $_POST['password'] );

$user = new User();

$params = array(
"username" => $_POST['username'],
"email" => $_POST['email'],
"password" => $password,
"lastName" => $_POST['lastName'],
"firstName" => $_POST['firstName'],
"uuid" => MD5(microtime()),
"active" => 0
	);

$user->insert($params);



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
	$mail->Subject = "Welcome to Openfire!";
	$mail->Body = "Welcome to Openfire! We just need you to verify your account for us. Please visit http://" . $_SERVER['SERVER_NAME'] . "/confirmSignup/" . $user->uuid . " to get started!";
	$mail->AddAddress($user->email);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}

$message = "Thank you! Your account has been created. Check your email for a confirmation link.";
}

}

$template = new Templater();
$template->load('alert');
if(!empty($error)){ $template->type = "error"; $template->message = $error;}
else{ $template->type = "success"; $template->message = $message;}
$template->publish();

$template = new Templater();
$template->load('signup');
$template->publish();



$template = new Templater();
$template->load('footer');
$template->publish();



	}

} 

?>