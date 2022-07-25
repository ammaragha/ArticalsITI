<?php

namespace App\Controllers;

use App\Models\Artical;
use App\Models\Core\Auth;
use App\Models\Core\Controller;
use App\Models\Core\FileSys;
use App\Models\Core\Redirect;
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
        $user_id = Auth::check()::$user['id'];
        $articals = (new Artical)->where("user_id = $user_id");
        SessionSys::setNew(['data' => $articals]);
        return $this->view('index.php');
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
            SessionSys::setNew(['errs' => $errors]); //set errors
        } else {

            $img = new FileSys($req->files['image'], PUBLIC_ROOT . "images/articals/");
            $req->inputs['image'] = $img->upload();
            $req->inputs['user_id'] = Auth::check()::$user['id'];
            $req->inputs['created_at'] = date("Y-m-d");

            $created = (new Artical)->insert($req->inputs);
            if ($created) {
                SessionSys::setNew(['k' => 'Artical created']); //set success
            } else
                SessionSys::setNew(['errs' => ["Something went wrong"]]); //set errors
        }

        return Redirect::to('articals', 'create');
    }

    /**
     * call edit view
     */
    public function edit(Request $req)
    {
        $artical_id = $req->inputs['id'];
        $user_id = Auth::check()::$user['id'];

        $artical = (new Artical)->find($artical_id);
        if ($artical) {
            $this->policy($user_id, $artical['user_id']);
            SessionSys::setNew(['data' => $artical]);
            return $this->view('edit.php');
        } else {
            SessionSys::setNew(['errs' => ['something went wrong']]);
            return Redirect::to('articals');
        }
    }


    /**
     * update Artical
     * @param Request $req
     */
    public function update(Request $req)
    {
        //needs
        $artical_id = $req->inputs['id'];
        $user_id = Auth::check()::$user['id'];
        $img = $req->files['image'];
        $title = $req->inputs['title'];
        $description = $req->inputs['description'];
        $content = $req->inputs['content'];

        //model
        $artical = (new Artical)->find($artical_id);
        if ($artical) {
            $this->policy($user_id, $artical['user_id']);
            $errors = $this->validateUpdate($req);
            if ($errors) {
                SessionSys::setNew(['errs' => $errors]); //set errors
                return Redirect::to('articals', 'edit');
            } else {
                $updated = (new Artical)->update($artical_id, [
                    'title' => $title,
                    'description' => $description,
                    'content' => $content,
                    'image' => $this->updateImage($img, $artical)
                ]);

                SessionSys::setNew(['k' => 'Artical updated']);
            }
        } else {
            SessionSys::setNew(['errs' => ['something went wrong']]);
        }
        return Redirect::to('articals');
    }


    /**
     * delete Artical
     * @param Request $req
     */
    public function delete(Request $req)
    {
        $artical_id = $req->inputs['id'];
        $user_id = Auth::check()::$user['id'];

        $artical = (new Artical)->find($artical_id);

        if ($artical) {
            $this->policy($user_id, $artical['user_id']);
            unlink($artical['image']);
            (new Artical)->delete($artical_id);
            SessionSys::setNew(['k' => "Artical deleted"]);
        } else {
            SessionSys::setNew(['errs' => ['something went wrong']]);
        }

        return Redirect::to('articals');
    }





    //customs
    public function validateStore(Request $req)
    {
        $errs = [];

        $title = $req->inputs['title'];
        $img = $req->files['image'];

        //required
        foreach ($req->inputs as $key => $input) {
            if (empty($input))
                array_push($errs, "$key is required");
        }
        if (empty($img['name']))
            array_push($errs, "image is required");


        //length
        if (strlen($title) < 3 || strlen($title) > 20)
            array_push($errs, "title must be between 3 and 20");


        return $errs;
    }

    public function validateUpdate(Request $req)
    {
        $errs = [];

        $title = $req->inputs['title'];
        //required
        foreach ($req->inputs as $key => $input) {
            if (empty($input) && $key != "image")
                array_push($errs, "$key is required");
        }



        //length
        if (strlen($title) < 3 || strlen($title) > 20)
            array_push($errs, "title must be between 3 and 20");


        return $errs;
    }



    public function policy($user_id, $artical_id)
    {
        if ($artical_id != $user_id) {
            SessionSys::setNew(['errs' => ["ITS NOT UR ARTICAL"]]);
            return Redirect::to('articals');
        }
    }

    public function updateImage($newImg, array $artical)
    {
        if (!empty($newImg['name'])) {
            unlink($artical['image']);
            $img = new FileSys($newImg, PUBLIC_ROOT . "images/articals/");
            return $img->upload();
        } else {
            return $artical['image'];
        }
    }
}
