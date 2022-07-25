<?php

namespace App\Controllers;

use App\Models\Artical;
use App\Models\Core\Auth;
use App\Models\Core\Controller;
use App\Models\Core\FileSys;
use App\Models\Core\SessionSys;
use App\Models\Core\Request;
use DateTime;

class ArticalController extends Controller
{
    protected $location = "frontend/articals/";


    /**
     * return index view
     */
    public function index()
    {
    }


    /**
     * return create view
     */
    public function create()
    {
        return $this->view('create.php');
    }

    /**
     * store into DB
     * @param Request $request
     */
    public function store(Request $req)
    {
        $errors = $this->validateStore($req);
        if ($errors) {
        } else {
            
            $img = new FileSys($req->files['image'], PUBLIC_ROOT . "images/articals/");
            $req->inputs['image'] = $img->upload();
            $req->inputs['user_id']= Auth::check()::$user['id'];
            $req->inputs['created_at']= date("Y-m-d");
           
            $created = (new Artical)->insert($req->inputs);
            if ($created)
                die('created');
            else
                die('err');
        }
    }


    public function validateStore(Request $req)
    {
        return false;
    }
}
