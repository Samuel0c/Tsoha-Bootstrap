<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/todo_list', function() {
    HelloWorldController::todo_list();
});

$routes->get('/edit_task', function() {
    HelloWorldController::edit_task();
});

$routes->get('/show_task', function() {
    HelloWorldController::show_task();
});

