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
        $user = User::find(1);
        $task = Task::find(1);
        $tasks = Task::all();
        $priority = Priority::find(3);
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($user);
        Kint::dump($task);
        Kint::dump($tasks);
        Kint::dump($priority);
    }

    public static function add_task() {
        View::make('add_task.html');
    }

    public static function login() {
        View::make('login.html');
    }

    public static function register() {
        View::make('register.html');
    }

}
