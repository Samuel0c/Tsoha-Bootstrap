<?php

class Topic extends BaseModel {

    public $id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
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

}
