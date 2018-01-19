<?php

class TaskController extends BaseController {

    public static function todo_list() {
        self::check_logged_in();
        $user_id = self::get_user_logged_in();
        $user = User::find($user_id);
        $tasks = Task::find_by_user($user_id);
        View::make('task/todo_list.html', array('user' => $user, 'tasks' => $tasks));
    }

    public static function show_task($id) {
        self::check_logged_in();
        $task = Task::find($id);
        if ($task->owner_id != self::get_user_logged_in()) {
            Redirect::to('/todo_list', array('message' => 'You can only view your own tasks'));
        }
        $topics = Task_topic::findByTask($id);
        View::make('task/show_task.html', array('task' => $task, 'topics' => $topics));
    }

    public static function edit_task($id) {
        self::check_logged_in();
        $task = Task::find($id);
        if ($task->owner_id != self::get_user_logged_in()) {
            Redirect::to('/todo_list', array('message' => 'You can only edit your own tasks'));
        }
        $task_topics = array_map(function ($task) {
            return $task->id;
        }, Task_topic::findByTask($id));

        $topics = Topic::all();
        View::make('task/edit_task.html', array('task' => $task, 'task_topics' => $task_topics, 'topics' => $topics));
    }

    public static function add_task() {
        self::check_logged_in();
        $topics = Topic::all();
        View::make('task/add_task.html', array('topics' => $topics));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'task_name' => isset($params['task_name']) ? $params['task_name'] : null,
            'status' => FALSE,
            'notes' => $params['notes'],
            'owner_id' => self::get_user_logged_in(),
            'priority' => isset($params['priority']) ? $params['priority'] : null
        );
        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) == 0) {
            $task->save();
        } else {
            $topics = Topic::all();
            View::make('task/add_task.html', array('topics' => $topics, 'errors' => $errors, 'attributes' => $attributes));
        }
        if (isset($params['topic_ids'])) {
            foreach ($params['topic_ids'] as $topic_id) {
                $task_topic = new Task_topic(array(
                    'topic_id' => $topic_id,
                    'task_id' => $task->id
                ));
                $task_topic->save();
            }
        }
        Redirect::to('/show_task/' . $task->id, array('message' => 'New task added successfully'));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'task_name' => isset($params['task_name']) ? $params['task_name'] : null,
            'status' => !(empty($params['status'])),
            'notes' => isset($params['notes']) ? $params['notes'] : null,
            'owner_id' => self::get_user_logged_in(),
            'priority' => isset($params['priority']) ? $params['priority'] : null
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if (empty($errors)) {
            $task->update();
            $task->delete_linked_topics($id);

            if (isset($params['topic_ids'])) {
                foreach ($params['topic_ids'] as $topic_id) {
                    $task_topic = new Task_topic(array(
                        'topic_id' => $topic_id,
                        'task_id' => $task->id
                    ));
                    $task_topic->save();
                }
            }

            Redirect::to('/show_task/' . $task->id, array('message' => 'New task added successfully'));
        } else {
            $topics = Topic::all();
            View::make('task/edit_task.html', array('topics' => $topics, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $task = new Task(array('id' => $id));
        $task->delete($id);

        Redirect::to('/todo_list', array('message' => 'Task deleted successfully'));
    }

}
