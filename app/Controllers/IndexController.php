<?php

namespace App\Controllers;

use Core\Controller;

class IndexController extends Controller
{
    public function index(): string
    {
        return $this->view('index');
    }
}
