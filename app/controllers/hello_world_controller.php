<?php

require 'app/models/User.php';
require 'app/models/Task.php';
require 'app/models/Priority.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
//        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
//        echo HelloWorld::say_hi();
//        echo 'Hello World!';
//        View::make('helloworld.html');
        $doom = new Task(array(
            'task_name' => 't',
            'status' => '',
            'notes' => 'notesss',
            'owner_id' => '1',
            'priority' => ''
        ));
        $errors = $doom->errors();

        Kint::dump($errors);
    }

    public static function login() {
        View::make('login.html');
    }

    public static function register() {
        View::make('register.html');
    }

}
