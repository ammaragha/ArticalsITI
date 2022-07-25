<?php
require_once "config/app.php";

use App\Models\Table;
use App\Models\Core\Redirect;
use App\Models\User;


$usersTable = new Table('users');
$articalsTable = new Table('articals');
try {

    $usersTable->create("
        id int PRIMARY KEY AUTO_INCREMENT,
        first_name varchar(20) NOT NULL,
        last_name varchar(20) NOT NULL,
        address varchar(20),
        email varchar(100)  NOT NULL,
        password varchar(255) NOT NULL,
        date DATE,
        UNIQUE (email) 
    ");

    $articalsTable->create("
        id int PRIMARY KEY AUTO_INCREMENT,
        title varchar(20) NOT NULL,
        description varchar(100),
        image varchar(100),
        created_at DATE,
        content varchar(100) NOT NULL
    ");

    $articalsTable->addFK('user_id', 'users', 'id');
} catch (\PDOException $e) {
   // die('PDO ERROR: ' . $e->getMessage());
}
Redirect::to("index");
