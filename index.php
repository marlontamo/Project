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
echo($allUsers[1]['email']);

