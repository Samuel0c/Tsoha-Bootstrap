<?php

class HomeController extends BaseController {

    public static function index() {
        View::make('home.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
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

}
