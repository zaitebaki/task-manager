<?php

namespace App\Controllers;

use App\Models\Task;
use Core\Controller;

class IndexController extends Controller
{
    public function index(): string
    {
        $task = new Task;

        $propsData = [
            ['tasks' => $task->getTasks()],
        ];

        return $this->view('index', ['propsData' => $propsData]);
    }

    public function login(): string
    {
        return $this->view('login');
    }
}
