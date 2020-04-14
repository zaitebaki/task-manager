<?php

namespace App\Models;

use Core\Config;
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
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        header("Location: " . Config::get('domain'));
        exit(0);
    }

    /**
     * Add new task.
     */
    public function addTask($name, $email, $text)
    {
        $conn = $this->getDbConnection();

        $name  = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $text  = $conn->real_escape_string($text);

        $sqlString = "INSERT INTO tasks (user_name, email, text)
        VALUES ('$name', '$email', '$text')";

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
            header("Location: " . Config::get('domain') . "/page/$countPages");
            exit(0);
        } else {
            $_SESSION["errorQuery"]      = "Возникла ошибка при добавлении задачи. Повторите попытку.";
            $_SESSION["errorQueryCount"] = 1;
            header("Location: " . Config::get['domain']);
            exit(0);
        }
    }

    /**
     * Update task.
     * @param string $id
     * @param string $name
     * @param string $email
     * @param string $text
     * @param int $done
     */
    public function updateTask($id, $name, $email, $text, $done)
    {
        $edited = $this->isUpdated($id, $name, $email, $text);

        if ($edited === true) {
            $edited = '1';
        } else {
            $edited = '0';
        }

        $sqlString = "UPDATE tasks SET
            user_name='$name',
            email='$email',
            text='$text',
            done='$done',
            edited='$edited'
        WHERE id='$id'";

        $sql = $this->sqlQuery($sqlString);

        if ($sql === true) {
            $_SESSION["success"]      = "Задача успешно обновлена!";
            $_SESSION["successCount"] = 1;
            header("Location: " . Config::get('domain'));

            exit(0);
        } else {
            $_SESSION["errorQuery"]      = "Возникла ошибка при обновлении задачи.";
            $_SESSION["errorQueryCount"] = 1;
            header("Location: " . Config::get('domain'));
            exit(0);
        }
    }

    /**
     * Check form data for updates.
     * @param string $name
     * @param string $name
     * @param string $email
     * @param string $text
     * @return bool
     */
    private function isUpdated($id, $name, $email, $text): bool
    {
        $sql = $this->sqlQuery("SELECT edited FROM tasks where id = '$id'");

        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                $resultArray[] = [
                    'edited' => $row['edited'],
                ];
            }
        }

        $t = $resultArray[0]['edited'];
        $d = 5;

        if ($resultArray[0]['edited'] === '1') {
            return true;
        }

        if ($_SESSION['editName'] !== $name || $_SESSION['email'] !== $email || $_SESSION['text'] !== $text) {
            return true;
        }
        return false;
    }
}
