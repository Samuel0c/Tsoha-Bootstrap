<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->post('/todo_list', function() {
    TaskController::store();
});

$routes->get('/add_task', function() {
    TaskController::add_task();
});

$routes->get('/todo_list', function() {
    TaskController::todo_list();
});

$routes->get('/edit_task/:id', function($id) {
    TaskController::edit_task($id);
});

$routes->get('/show_task/:id', function($id) {
    TaskController::show_task($id);
});

$routes->post('/topic_list', function() {
    TopicController::store();
});

$routes->get('/topic_list', function() {
    TopicController::topic_list();
});

$routes->get('/add_task', function() {
    TaskController::add_task();
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

