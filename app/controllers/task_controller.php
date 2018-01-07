<?php

class TaskController extends BaseController {

    public static function todo_list() {
        $tasks = Task::all();
        View::make('todo_list.html', array('tasks' => $tasks));
    }

    public static function show_task($id) {
        $task = Task::find($id);
        $topics = Task_topic::findByTask($id);
        View::make('show_task.html', array('task' => $task, 'topics' => $topics));
    }

    public static function edit_task($id) {
        $task = Task::find($id);
        View::make('edit_task.html', array('task' => $task));
    }

    public static function add_task() {
        $topics = Topic::all();
        View::make('add_task.html', array('topics' => $topics));
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
        
        foreach ($params['topic_ids'] as $topic_id) {
            $task_topic = new Task_topic(array(
                'topic_id' => $topic_id,
                'task_id' => $task->id
            ));
            $task_topic->save();
        }
        
        Redirect::to('/show_task/' . $task->id, array('message' => 'New task added successfully'));
    }

}
