<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/todo_list', function() {
    TaskController::todo_list();
});

$routes->get('/edit_task', function() {
    HelloWorldController::edit_task();
});

$routes->get('/show_task/:id', function($id) {
    TaskController::show_task($id);
});

$routes->get('/topic_list', function() {
    TopicController::topic_list();
});

$routes->get('/add_task', function() {
    HelloWorldController::add_task();
});

$routes->get('/edit_topic/:id', function($id) {
    TopicController::edit_topic($id);
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/register', function() {
    HelloWorldController::register();
});

