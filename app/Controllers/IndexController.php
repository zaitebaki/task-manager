<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Core\Controller;

class IndexController extends Controller
{
    /**
     * Index controller.
     * @return string
     */
    public function index($pageNumber = '1'): string
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->updateSortStatus();
        }

        $task      = new Task;
        $propsData = [
            [
                'tasks'      => $task->getTasks((int) $pageNumber),
                'countTasks' => $task->getCountTasks(),
                'pageNumber' => $pageNumber,
                'orderSort'  => $this->getOrderSort(),
                'isAuth'     => User::isAuthenticate(),
            ],
        ];

        return $this->view('index', ['propsData' => $propsData]);
    }

    /**
     * Login controller.
     * @return string
     */
    public function login(): string
    {
        $propsData = [];
        if (isset($_SESSION["error"])) {
            $propsData['error'] = $_SESSION["error"];
        } else {
            $propsData['error'] = false;
        }
        return $this->view('login', ['propsData' => $propsData]);
    }

    /**
     * Logout controller.
     * @return string
     */
    public function logout(): strings
    {
        User::logout();
    }

    /**
     * Authenticate user.
     * @return string
     */
    public function authenticate(): string
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new User;

            $login    = $this->testInput($_POST["login"]);
            $password = $this->testInput($_POST["password"]);

            if ($login === '' || $password === '') {
                $_SESSION["error"] = "Поля логин или пароль не заполнены!";
                header("Location: http://task/login");
                exit(0);
            }

            $result = $user->authenticate($login, $password);

            if ($result === true) {
                header("Location: http://task");
                unset($_SESSION["error"]);
                exit(0);
            } else {
                $_SESSION["error"] = "Неверно введен логин или пароль!";
                header("Location: http://task/login");
                exit(0);
            }
        }
    }

    /**
     * Update order sort status.
     */
    private function updateSortStatus()
    {
        $_SESSION["orderSort"] = $this->testInput($_POST["sortSelectedElement"]);
    }

    /**
     * Get current order sort status.
     * @return string
     */
    private function getOrderSort(): string
    {
        return $_SESSION["orderSort"] ?? 'default';
    }

    /**
     * Check input data.
     * @param string $data
     * @return string
     */
    private function testInput(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
