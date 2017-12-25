<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//   	  View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
//        echo 'Hello World!';
        View::make('helloworld.html');
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

}
