<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Core\Controller;

class IndexController extends Controller
{
    /**
     * Handle get and post query for '/'
     * @param string $pageNumber
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
                'tasks'         => $task->getTasks((int) $pageNumber),
                'countTasks'    => $task->getCountTasks(),
                'pageNumber'    => $pageNumber,
                'orderSort'     => $this->getOrderSort(),
                'isAuth'        => User::isAuthenticate(),
                'sessionStatus' => $this->getSessionStatus(),
            ],
        ];

        return $this->view('index', ['propsData' => $propsData]);
    }

    /**
     * Handle get query for '/login'
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
     * Handle post query for '/logout'
     * @return string
     */
    public function logout(): strings
    {
        User::logout();
    }

    /**
     * Handle post query for '/login'
     * @return string
     */
    public function authenticate(): string
    {
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

    /**
     * Handle get query for '/add_task'
     */
    public function add()
    {
        $user = new User;

        $name  = $this->testInput($_POST["name"]);
        $email = $this->testInput($_POST["email"]);
        $text  = $this->testInput($_POST["text"]);

        $user->addTask($name, $email, $text);
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

    /**
     * Get session status.
     * @param string $data
     * @return array|bool
     */
    private function getSessionStatus()
    {
        $resultArray = [];

        if (isset($_SESSION["success"])) {
            $count = $_SESSION["successCount"];
            if ($count === 1) {
                $resultArray["success"] = $_SESSION["success"];
            }
            $_SESSION["successCount"] = ++$count;
        }

        if (isset($_SESSION["errorQuery"])) {
            $count = $_SESSION["errorQueryCount"];
            if ($count === 1) {
                $resultArray["error"] = $_SESSION["errorQuery"];
            }
            $_SESSION["errorQueryCount"] = ++$count;
        }

        if (count($resultArray) === 0) {
            return false;
        }
        return $resultArray;
    }

    /**
     * Handle get query for '/edit/{id_task}'
     * @return string
     */
    public function edit($pageNumber): string
    {
        $task     = new Task;
        $taskData = $task->getTask($pageNumber);
        
        $propsData = [
            'pageNumber' => $pageNumber,
            'task'       => $taskData,
        ];

        $_SESSION['editName'] = $taskData[0]['user_name'];
        $_SESSION['email']    = $taskData[0]['email'];
        $_SESSION['text']     = $taskData[0]['text'];

        return $this->view('edit', ['propsData' => $propsData]);
    }

    /**
     * Handle post query for '/edit/{id_task}'
     * @return string
     */
    public function postEdit($id): string
    {
        $user  = new User;
        $name  = $this->testInput($_POST["name"]);
        $email = $this->testInput($_POST["email"]);
        $text  = $this->testInput($_POST["text"]);
        $done  = 0;

        if (isset($_POST["done"])) {
            $done = 1;
        }

        $user->updateTask($id, $name, $email, $text, $done);
    }
}
