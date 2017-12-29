<?php

class task_controller extends BaseController {

    public static function index() {
        $tasks = Task::all();
        View::make('todo_list.html', array('tasks' => $tasks));
    }

}
