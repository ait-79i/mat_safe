<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'api_login_check' => [[], [], [], [['text', '/api/login_check']], [], [], []],
    'api_dashboard' => [[], ['_controller' => 'App\\Controller\\DashboardController::index'], [], [['text', '/api/dashboard']], [], [], []],
    'api_register' => [[], ['_controller' => 'App\\Controller\\RegistrationController::index'], [], [['text', '/api/register']], [], [], []],
    'app_tache' => [[], ['_controller' => 'App\\Controller\\TacheController::index'], [], [['text', '/tache']], [], [], []],
    'taches.index' => [[], ['_controller' => 'App\\Controller\\TacheController::getTachesAction'], [], [['text', '/api/taches']], [], [], []],
    'app_user' => [[], ['_controller' => 'App\\Controller\\UserController::index'], [], [['text', '/user']], [], [], []],
    'user.store' => [[], ['_controller' => 'App\\Controller\\UserController::store'], [], [['text', '/api/user']], [], [], []],
    'user.update' => [['id'], ['_controller' => 'App\\Controller\\UserController::update'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/user/edition']], [], [], []],
    'user.delete' => [['id'], ['_controller' => 'App\\Controller\\UserController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/user/delete']], [], [], []],
];