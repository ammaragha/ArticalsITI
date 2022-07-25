<?php

namespace App\Controllers;

use App\Models\Core\Auth;
use App\Models\Core\Controller;
use App\Models\Core\Redirect;
use App\Models\Core\Request;
use App\Models\Core\SessionSys;
use App\Models\User;


class Authcontroller extends Controller
{
    protected $location = "frontend/";

    /**
     * Login
     * @return view
     */
    public function login()
    {
        return $this->view('login.php');
    }


    /**
     * Forget password
     * @return view
     */
    public function register()
    {
        return $this->view('register.php');
    }


    /**
     * DO Login
     * @param Request
     */
    public function doLogin(Request $req)
    {
        $email = $req->inputs['email'];
        $password = $req->inputs['password'];
        if (Auth::make($email, $password)) {
            Redirect::to('index');
        } else {
            SessionSys::setNew(['err' => 'email or password wrong']);
            Redirect::to('auth', 'login');
        }
    }

    /**
     * Do Forget
     * @param Request
     */
    public function doRegister(Request $req)
    {
        $errors = $this->validateRegister($req); //validate
        if ($errors) { //if errors
            SessionSys::setNew(['errs' => $errors]);
            return Redirect::to('auth', 'register');
        } else { // if not register
            $created = (new User)->insert($req->inputs);
            if ($created) {
                Auth::make($req->inputs['email'], $req->inputs['password']);
                return Redirect::to('index');
            } else {
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['AUTH']);
        Redirect::to('index');
    }


    public function validateRegister(Request $req)
    {
        $errs = [];

        $firstname = $req->inputs['first_name'];
        $lastname = $req->inputs['last_name'];
        $email = $req->inputs['email'];

        //required
        foreach ($req->inputs as $key => $input) {
            if (empty($input))
                array_push($errs, "$key is required");
        }

        //length
        if (strlen($firstname) < 3 || strlen($firstname) > 20)
            array_push($errs, "first_name should be between 1 and 20");
        if (strlen($lastname) < 3 || strlen($lastname) > 20)
            array_push($errs, "last_name should be between 1 and 20");

        //email
        $emailExists = (new User)->where(" email= '$email' ");
        if ($emailExists)
            array_push($errs, "email has been taken before");


        return $errs;
    }
}
