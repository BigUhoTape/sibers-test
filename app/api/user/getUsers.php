<?php

require($_SERVER['DOCUMENT_ROOT'].'vendor/autoload.php');

use App\controllers\UserController;

Header('Content-Type: application/json');

$user_controller = new UserController();
echo $user_controller->getUsers();