<?php

namespace App\Controllers;

use App\Models\Task;
use Core\Controller;

class IndexController extends Controller
{
    public function index($pageNumber = '1'): string
    {
        $task = new Task;

        $propsData = [
            [
                'tasks'       => $task->getTasks((int) $pageNumber),
                'countTasks' => $task->getCountTasks(),
                'pageNumber' => $pageNumber
            ],
        ];

        return $this->view('index', ['propsData' => $propsData]);
    }

    public function login(): string
    {
        return $this->view('login');
    }
}
