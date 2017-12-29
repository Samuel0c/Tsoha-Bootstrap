<?php

class Task extends BaseModel {

    public $id, $task_name, $status, $notes, $owner_id, $priority;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return new Task(array(
                'id' => $row['id'],
                'task_name' => $row['task_name'],
                'status' => $row['status'],
                'notes' => $row['notes'],
                'owner_id' => $row['owner_id'],
                'priority' => $row['priority']
            ));
        }
        return null;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Task');
        $query->execute();
        $rows = $query->fetchAll();
        $tasks = array();
        foreach ($rows as $row) {
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'task_name' => $row['task_name'],
                'status' => $row['status'],
                'notes' => $row['notes'],
                'owner_id' => $row['owner_id'],
                'priority' => $row['priority']
            ));
        }
        return $tasks;
    }

}
