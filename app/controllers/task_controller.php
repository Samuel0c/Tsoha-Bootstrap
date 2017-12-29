<?php

class TaskController extends BaseController {

    public static function todo_list() {
        $tasks = Task::all();
        View::make('todo_list.html', array('tasks' => $tasks));
    }
    
    public static function show_task($id) {
        $task = Task::find($id);
        View::make('show_task.html', array('task' => $task));
    }

}
