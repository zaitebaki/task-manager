<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    /**
     * Create instance "User".
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Authenticate user.
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function authenticate($login, $password): bool
    {
        $sql = $this->sqlQuery("SELECT * FROM users where login = '$login' and password = '$password'");

        if ($sql->num_rows > 0) {
            $_SESSION["userAuthenticate"] = "authenticate";
            return true;
        }
        return false;
    }

    /**
     * Check authenticate user.
     * @return bool
     */
    public static function isAuthenticate(): bool
    {
        if (isset($_SESSION["userAuthenticate"])) {
            return true;
        }
        return false;
    }

    /**
     * Logout user.
     */
    public static function logout()
    {
        session_destroy();
        header("Location: http://task");
        exit(0);
    }
}
