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
    
}
