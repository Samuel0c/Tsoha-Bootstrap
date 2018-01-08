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

$routes->post('/edit_task/:id', function($id) {
    TaskController::update($id);
});

$routes->get('/edit_task/:id', function($id) {
    TaskController::edit_task($id);
});

$routes->post('/show_task/:id', function($id) {
    TaskController::destroy($id);
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

$routes->post('/login', function(){
  UserController::handle_login();
});

$routes->get('/login', function() {
    UserController::login();
});

$routes->get('/register', function() {
    UserController::register();
});

