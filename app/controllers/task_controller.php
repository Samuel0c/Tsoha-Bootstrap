<?php

class TaskController extends BaseController {

    public static function todo_list() {
        $user_id = self::get_user_logged_in();
        $user = User::find($user_id);
        $tasks = Task::find_by_user($user_id);
        View::make('todo_list.html', array('user' => $user, 'tasks' => $tasks));
    }

    public static function show_task($id) {
        $user_id = self::get_user_logged_in();
        $task = Task::find($id);

        if ($task->owner_id == $user_id) {
            $topics = Task_topic::findByTask($id);
            View::make('show_task.html', array('task' => $task, 'topics' => $topics));
        } else {
            View::make('/', array('errors' => 'Can not show task, please try again'));
        }
    }

    public static function edit_task($id) {
        $task = Task::find($id);
        $task_topics = array_map(function ($task) {
            return $task->id;
        }, Task_topic::findByTask($id));

        $topics = Topic::all();
        View::make('edit_task.html', array('task' => $task, 'task_topics' => $task_topics, 'topics' => $topics));
    }

    public static function add_task() {
        $topics = Topic::all();
        View::make('add_task.html', array('topics' => $topics));
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'task_name' => isset($params['task_name']) ? $params['task_name'] : null,
            'status' => 'false',
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
            View::make('add_task.html', array('topics' => $topics, 'errors' => $errors, 'attributes' => $attributes));
        }
        foreach ($params['topic_ids'] as $topic_id) {
            $task_topic = new Task_topic(array(
                'topic_id' => $topic_id,
                'task_id' => $task->id
            ));
            $task_topic->save();
        }
        Redirect::to('/show_task/' . $task->id, array('message' => 'New task added successfully'));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'task_name' => isset($params['task_name']) ? $params['task_name'] : null,
            'status' => 'false',
            'notes' => isset($params['notes']) ? $params['notes'] : null,
            'owner_id' => self::get_user_logged_in(),
            'priority' => isset($params['priority']) ? $params['priority'] : null
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if (empty($errors)) {
            $task->update();
            $task->delete_linked_topics($id);

            foreach ($params['topic_ids'] as $topic_id) {
                $task_topic = new Task_topic(array(
                    'topic_id' => $topic_id,
                    'task_id' => $task->id
                ));
                $task_topic->save();
            }

            Redirect::to('/show_task/' . $task->id, array('message' => 'New task added successfully'));
        } else {
            $topics = Topic::all();
            View::make('add_task.html', array('topics' => $topics, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function destroy($id) {
        $task = new Task(array('id' => $id));
        $task->delete($id);

        Redirect::to('/todo_list', array('message' => 'Task deleted successfully'));
    }

}
