<? 
$connection = new MongoClient("mongodb://development:californiaGold@localhost");

$users = $connection->openfire->users;

$user = $users->findOne(array("email" => "jzellis@gmail.com"));

print_r($user);
