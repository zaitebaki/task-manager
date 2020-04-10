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

    /**
     * Add new task.
     */
    public function addTask($name, $email, $text)
    {

        $sqlString = <<<EOD
        INSERT INTO tasks (user_name, email, text)
        VALUES ('$name', '$email', '$text')
        EOD;

        $sql = $this->sqlQuery($sqlString);

        $task       = new Task;
        $countPages = ($task->getCountTasks() + 2) / 3;
        $countPages = (int) round($countPages, PHP_ROUND_HALF_DOWN);

        if ($countPages === 0) {
            $countPages = 1;
        }

        if ($sql === true) {
            $_SESSION["success"]      = "Новая задача успешно добавлена!";
            $_SESSION["successCount"] = 1;
            $_SESSION["orderSort"]    = "default";
            header("Location: http://task/page/$countPages");
            exit(0);
        } else {
            $_SESSION["errorQuery"]      = "Возникла ошибка при добавлении задачи. Повторите попытку.";
            $_SESSION["errorQueryCount"] = 1;
            header("Location: http://task");
            exit(0);
        }
    }
}
