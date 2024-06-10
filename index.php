<?php

require 'vendor/autoload.php';

use Project\Impossible\Example;
use Project\Impossible\Controllers\PostController;
use Project\Impossible\models\UserModel;
$nl = "</br>";
// Create a new instance of Example
$example = new Example();
echo $example->greet('Marlon').$nl;

// Create a new instance of PostController
$postController = new PostController();
echo $postController->show(1). $nl;
echo $postController->rest().$nl;
echo PostController::staticShow(2) . $nl;

//instantiate db connection
$pdo = new PDO('mysql:host=localhost;dbname=project-impossible', 'root', 'Admin_123');

/*create new user but we need to 
call the save() method after setting values
*/
$user = new UserModel($pdo);
$user->setName('John Doe2');
$user->setEmail('john2@example.com');
$user->setPassword('secret2');

//fetch all user from db users table
$allUsers = $user::findAll($pdo);
echo($allUsers[1]['email']) .$nl;


$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Get the server name
$serverName = $_SERVER['SERVER_NAME'];

// Get the server port, if it's not the default port (80 for HTTP, 443 for HTTPS)
$port = $_SERVER['SERVER_PORT'];
$port = ($port == 80 || $port == 443) ? '' : ':' . $port;

// Construct the URI
$uri = $protocol . $serverName . $port;

// Output the URI
echo $uri . $nl;
//var_dump($_SERVER['SERVER_PORT'] == 443 );

