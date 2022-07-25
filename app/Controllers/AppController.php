<?php

namespace App\Controllers;

use App\Models\Artical;
use App\Models\Core\Controller;
use App\Models\Core\SessionSys;
use App\Models\Core\Request;

class AppController extends Controller
{
    protected $location = "frontend/";


    /**
     * return index view
     */
    public function index()
    {
        $articals = new Artical;
        $data = $articals->get();
        SessionSys::setNew(['data' => $data]);
        return $this->view('index.php');
    }


    
}
