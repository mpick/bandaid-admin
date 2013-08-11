<? class Logout{

function get(){

global $user;
setcookie ("user[username]", "", time() - 3600);
setcookie ("user[key]", "", time() - 3600);

				addActivity("$user->username ($user->email) logged out");

header("Location: /");

}

}