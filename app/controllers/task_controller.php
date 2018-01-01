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

    public static function edit_task($id) {
        $task = Task::find($id);
        View::make('edit_task.html', array('task' => $task));
    }

    public static function add_task() {
        View::make('add_task.html');
    }

    public static function store() {
        $params = $_POST;
        $task = new Task(array(
            'task_name' => $params['task_name'],
            'status' => 'false',
            'notes' => $params['notes'],
            // change owner id once login has been implemented
            'owner_id' => 1,
            'priority' => $params['priority']
        ));
        $task->save();
        Redirect::to('/show_task/' . $task->id, array('message' => 'New task added successfully'));
    }

}
