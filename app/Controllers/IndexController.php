<?php

namespace App\Controllers;

use App\Models\Task;
use Core\Controller;

class IndexController extends Controller
{
    public function index($pageNumber = '1'): string
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->updateSortStatus();
        }

        $task      = new Task;
        $propsData = [
            [
                'tasks'      => $task->getTasks((int) $pageNumber),
                'countTasks' => $task->getCountTasks(),
                'pageNumber' => $pageNumber,
                'orderSort'  => $this->getOrderSort(),
            ],
        ];

        return $this->view('index', ['propsData' => $propsData]);
    }

    public function login(): string
    {
        return $this->view('login');
    }

    /**
     * Update order sort status.
     *
     */
    private function updateSortStatus()
    {
        $_SESSION["orderSort"] = $_POST["sortSelectedElement"];
    }

    /**
     * Get current order sort status.
     *
     */
    private function getOrderSort()
    {
        return $_SESSION["orderSort"] ?? 'default';
    }
}
