<?php

require($_SERVER['DOCUMENT_ROOT'].'vendor/autoload.php');

use App\controllers\RoleController;

Header('Content-Type: application/json');

$role_controller = new RoleController();
echo $role_controller->getRoles();