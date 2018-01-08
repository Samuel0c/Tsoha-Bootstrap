<?php

class UserController {

    public static function login() {
        View::make('login.html');
    }

    public static function register() {
        View::make('register.html');
    }

    public static function handle_login() {
        $params = $_POST;
        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('login.html', array('error' => 'Incorrect username or password',
                'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/', array('message' => 'Welcome back ' . $user->username . '!'));
        }
    }

}