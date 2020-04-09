<?php

namespace App\Controllers;

use App\Models\Task;
use Core\Controller;

class IndexController extends Controller
{
    public function index(): string
    {
        $task = new Task;

        $propsData = $task->getTasks();

        // $propsData = [
        //     ['test' => 'test from php']
        // ];

        return $this->view('index', ['propsData' => $propsData]);
    }

    public function login(): string
    {
        return $this->view('login');
    }
}
