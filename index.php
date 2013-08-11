<? require_once('app/conf/global.php'); 

$user = new User();

ToroHook::add("before_handler", function() {

global $user;
global $dbh;

if(!empty($_COOKIE['user']['username'])){
$sth = $dbh->prepare("SELECT id FROM users where username='" . $_COOKIE['user']['username'] . "' and uuid='" . $_COOKIE['user']['key'] . "' order by dateAdded desc limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);


if(!empty($result['id'])) $user = new User($result['id']);

if($user->adminUser != 1 || empty($user->id)){
    echo "You're not an admin user. Fuck off.";
    die();
}

}

});

 
Toro::serve(array(
    "/" => "Index",
    "login" => "Login",
    "logout" => "Logout",
    "cloneDB" => "cloneDB",
    "releaseFunds" => "releaseFunds",
    "reward" => "Reward"

));

?>
