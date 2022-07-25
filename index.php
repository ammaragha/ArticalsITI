<?php
require_once "config/app.php";
require_once FRONT_HEADER;
require_once FRONT_NAV;
require_once "app/Middlewares/Authorize.php";

//--------------------------------------------------

use App\Controllers\AppController;
use App\Models\Core\Request;

$appController = new AppController;

if ($page == "any") {
}  else {
    $appController->index();
}



//--------------------------------------------------
require_once FRONT_FOOT;
