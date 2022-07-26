<?php

namespace App\Models;

use App\Models\Core\Model;

class User extends Model
{

    protected $table = 'users';

    static function getName($id)
    {
        $user = (new User)->find($id);
        return $user['first_name'] . ' ' . $user['last_name'];
    }
}
