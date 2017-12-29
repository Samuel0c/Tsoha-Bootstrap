<?php

require 'app/models/user.php';
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
        $users = User::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($users);
        Kint::dump($user);
    }

    public static function todo_list() {
        View::make('todo_list.html');
    }

    public static function edit_task() {
        View::make('edit_task.html');
    }

    public static function show_task() {
        View::make('show_task.html');
    }

    public static function topic_list() {
        View::make('topic_list.html');
    }

    public static function add_task() {
        View::make('add_task.html');
    }

    public static function edit_topic() {
        View::make('edit_topic.html');
    }

    public static function login() {
        View::make('login.html');
    }

    public static function register() {
        View::make('register.html');
    }

}
