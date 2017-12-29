<?php

class Priority extends BaseModel {
    
    public $importance_value;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function find($importance_value) {
        $query = DB::connection()->prepare('SELECT * FROM Priority WHERE importance_value = :importance_value LIMIT 1');
        $query->execute(array('importance_value' => $importance_value));
        $row = $query->fetch();
    }
    
}
