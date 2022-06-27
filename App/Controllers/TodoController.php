<?php

namespace App\Controllers;

use App\Utilities\View;

class TodoController
{
    public function list()
    {
        $data = [
            'tasks' => ['firstTask', 'secondTask', 'thirdTask', 'fourthTask', '5thTask', '6thTask'],
            'title' => 'List of tasks!'
        ];
        View::include('todo.list', $data);
    }
}
