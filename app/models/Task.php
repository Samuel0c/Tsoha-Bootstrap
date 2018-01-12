<?php

class Task extends BaseModel {

    public $id, $task_name, $status, $notes, $owner_id, $priority;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_task_name', 'validate_priority');
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
    
    public static function find_by_user($owner_id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE owner_id = :owner_id');
        $query->execute(array('owner_id' => $owner_id));
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Task (task_name, status, notes, owner_id, priority) VALUES (:task_name, :status, :notes, :owner_id, :priority) RETURNING id');
        $query->execute(array('task_name' => $this->task_name, 'status' => "false", 'notes' => $this->notes, 'owner_id' => $this->owner_id, 'priority' => $this->priority));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update() {
        $isDone = $this->status ? "true" : "false";
        $query = DB::connection()->prepare('UPDATE Task SET task_name=:task_name, status=:status, notes=:notes, owner_id=:owner_id, priority=:priority WHERE id=:id');
        $query->execute(array('id' => $this->id,'task_name' => $this->task_name, 'status' => $isDone, 'notes' => $this->notes, 'owner_id' => $this->owner_id, 'priority' => $this->priority));
    }
    
    public function delete($id) {
        $this->delete_linked_topics($id);
        $query = DB::connection()->prepare('DELETE FROM Task WHERE id=:id');
        $query->execute(array('id' => $id));
    }
    
    public function delete_linked_topics($id) {
        $query= DB::connection()->prepare('DELETE FROM Task_topic WHERE task_id=:id');
        $query->execute(array('id' => $id));
    }

    public function validate_task_name() {
        return $this->validate_string_length($this->task_name, 3);
    }

    public function validate_priority() {
        $errors = array();
        if ($this->priority == null || $this->priority == '') {
            $errors[] = 'Priority can not be empty';
        }
        return $errors;
    }

}
