<?php

class UserController {

    public static function login() {
        View::make('user/login.html');
    }

    public static function show_register() {
        View::make('user/register.html');
    }

    public static function register() {
        $params = $_POST;
        $attributes = array(
            'username' => isset($params['username']) ? $params['username'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
        );
        
        $user = new User($attributes);
        $errors = $user->errors();

        if (empty($errors)) {
            $user->register();
            Redirect::to('/', array('message' => 'Registration complete'));
        } else {
            View::make('user/register.html');
        }
    }

    public static function handle_login() {
        $params = $_POST;
        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('user/login.html', array('error' => 'Incorrect username or password',
                'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/todo_list', array('message' => 'Welcome back ' . $user->username . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'You have successfully logged out'));
    }

}
