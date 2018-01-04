<?php

class Task_topic extends BaseModel {

    public $task_id, $topic_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function findByTask($task_id) {
        $query = DB::connection()->prepare('SELECT Task_topic.task_id, Task_topic.topic_id, Topic.id, Topic.name FROM Task_topic INNER JOIN Topic ON Task_topic.topic_id = Topic.id WHERE task_id = :task_id');
        $query->execute(array('task_id' => $task_id));
        $rows = $query->fetchAll();
        $topics = array();
        foreach ($rows as $row) {
            $topics[] = new Topic(array(
                'id' => $row['topic_id'],
                'name' => $row['name']
            ));
        }
        return $topics;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Task_topic (task_id, topic_id) VALUES (:task_id, :topic_id)');
        $query->execute(array('task_id' => $this->task_id, 'topic_id' => $this->topic_id));
    }

}
