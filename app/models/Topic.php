<?php

class Topic extends BaseModel {

    public $id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Topic WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return new Topic(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }
        return null;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Topic');
        $query->execute();
        $rows = $query->fetchAll();
        $topics = array();
        foreach ($rows as $row) {
            $topics[] = new Topic(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }
        return $topics;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Topic (name) VALUES (:name) RETURNING id');
        $query->execute(array('name' => $this->name));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function delete($id) {
        $query= DB::connection()->prepare('DELETE FROM Task_topic WHERE topic_id=:id');
        $query->execute(array('id' => $id));
        $query = DB::connection()->prepare('DELETE FROM Topic WHERE id=:id');
        $query->execute(array('id' => $id));
    }
    
    public function validate_name() {
        return $this->validate_string_length($this->name, 3);
    }

}
