<?php

class Task extends BaseModel {

    public $id, $task_name, $status, $notes, $owner, $priority;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Task');
        $query->execute();
        $rows = $query->fetchAll();
        $users = array();
        foreach ($rows as $row) {
            $tasks[] = new Task(array(
            'id' => $row['id'],
            'task_name' => $row['task_name'],
            'status' => $row['status'],
            'notes' => $row['notes'],
            'owner' => $row['owner'],
            'priority' => $row['priority']
            ));
        }
        return $users;
    }

}
