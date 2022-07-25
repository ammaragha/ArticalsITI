<?php
require_once "config/app.php";
require_once FRONT_HEADER;
require_once FRONT_NAV;

//--------------------------------------------------
use App\Controllers\AuthController;
use App\Models\Core\Request;

$authController = new AuthController;


if ($page == 'logout') {
    $authController->logout();
} elseif ($page == 'register') {
    $authController->register();
} elseif ($page == 'dologin') {
    $request = new Request('email', 'password');
    $authController->doLogin($request);
} elseif ($page == 'doRegister') {
    $request = new Request('first_name', 'last_name', 'address', 'date', 'email', 'password');
    $authController->doRegister($request);
} else {
    $authController->login();
}


//--------------------------------------------------
require_once FRONT_FOOT;
