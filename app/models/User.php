<?php

class User extends BaseModel {

    public $id, $username, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_username_length', 'validate_password_length');
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM RegisteredUser WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
        }
        return null;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM RegisteredUser');
        $query->execute();
        $rows = $query->fetchAll();
        $users = array();
        foreach ($rows as $row) {
            $users[] = new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
        }
        return $users;
    }

    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM RegisteredUser WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            return new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
        }
        return NULL;
    }

    public function register() {
        $query = DB::connection()->prepare('INSERT INTO RegisteredUser (username, password) VALUES (:username, :password) RETURNING id');
        $query->execute(array('username' => $this->username, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
//    public function validate_username_not_taken() {
//        $query = DB::connection()->prepare('SELECT COUNT(*) FROM RegisteredUser WHERE username = :username');
//        $query->execute(array('username' => $this->username));
//        $row = $query->fetch();
//        $this->errors() = array();
//        if ($row > 0) {
//            $this->errors[] = 'Username is already taken';
//        return $this->errors();
//        }
//    }

    public function validate_username_length() {
        return $this->validate_string_length($this->username, 2);
    }
    
    public function validate_password_length() {
        return $this->validate_string_length($this->password, 6);
    }

}
