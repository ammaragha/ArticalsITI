<?php
require_once "config/app.php";
require_once FRONT_HEADER;
require_once FRONT_NAV;
require_once "app/Middlewares/Authorize.php";

//--------------------------------------------------

use App\Controllers\ArticalController;
use App\Models\Core\Request;

$articalController = new ArticalController;

if ($page == "create") {
    $articalController->create();
} elseif ($page == "store" && $_SERVER['REQUEST_METHOD'] == "POST") {
    $request = new Request('title','description','content','image');
    $articalController->store($request);
} else {
    $articalController->index();
}



//--------------------------------------------------
require_once FRONT_FOOT;
