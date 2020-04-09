<?php

namespace App\Controllers;

use Core\Controller;

class IndexController extends Controller
{
    public function index(): string
    {
        $propsData = [
            ['test' => 'test from php']
        ];
        
        return $this->view('index', ['propsData' => $propsData]);
    }

    public function login(): string
    {
        return $this->view('login');
    }
}
