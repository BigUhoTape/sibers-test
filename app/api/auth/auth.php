<?php

require($_SERVER['DOCUMENT_ROOT'].'vendor/autoload.php');

use App\controllers\AuthController;

Header('Content-Type: application/json');

$auth_controller = new AuthController();
echo $auth_controller->auth();