<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
        '/api/compagnie' => [
            [['_route' => '_apiapp_compagnie', '_controller' => 'App\\Controller\\CompagnieController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => '_apicompagnie.store', '_controller' => 'App\\Controller\\CompagnieController::store'], null, ['POST' => 0], null, false, false, null],
            [['_route' => '_apicompagnie.update', '_controller' => 'App\\Controller\\CompagnieController::update'], null, ['PUT' => 0], null, false, false, null],
        ],
        '/api/dashboard' => [[['_route' => 'api_dashboard', '_controller' => 'App\\Controller\\DashboardController::index'], null, null, null, false, false, null]],
        '/api/register' => [[['_route' => 'api_register', '_controller' => 'App\\Controller\\RegistrationController::index'], null, ['POST' => 0], null, false, false, null]],
        '/api/taches' => [[['_route' => '_apitaches.index', '_controller' => 'App\\Controller\\TacheController::index'], null, null, null, false, false, null]],
        '/api/tache' => [[['_route' => '_apitache.store', '_controller' => 'App\\Controller\\TacheController::store'], null, ['POST' => 0], null, false, false, null]],
        '/api/user' => [[['_route' => 'user.store', '_controller' => 'App\\Controller\\UserController::store'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|compagnie/delete/([^/]++)(*:75)'
                    .'|user/(?'
                        .'|update/([^/]++)(*:105)'
                        .'|delete/([^/]++)(*:128)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        75 => [[['_route' => '_apicompagnie.destroy', '_controller' => 'App\\Controller\\CompagnieController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        105 => [[['_route' => 'user.update', '_controller' => 'App\\Controller\\UserController::update'], ['id'], ['GET' => 0, 'PUT' => 1], null, false, true, null]],
        128 => [
            [['_route' => 'user.delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
