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
                    .'|compagnie/(?'
                        .'|update/([^/]++)(*:78)'
                        .'|delete/([^/]++)(*:100)'
                    .')'
                    .'|tache/(?'
                        .'|update/([^/]++)(*:133)'
                        .'|delete/([^/]++)(*:156)'
                    .')'
                    .'|user/(?'
                        .'|update/([^/]++)(*:188)'
                        .'|delete/([^/]++)(*:211)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        78 => [[['_route' => '_apicompagnie.update', '_controller' => 'App\\Controller\\CompagnieController::update'], ['id'], ['PUT' => 0, 'PATCH' => 1], null, false, true, null]],
        100 => [[['_route' => '_apicompagnie.destroy', '_controller' => 'App\\Controller\\CompagnieController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        133 => [[['_route' => '_apitache.update', '_controller' => 'App\\Controller\\TacheController::upgate'], ['id'], ['PUT' => 0, 'PATCH' => 1], null, false, true, null]],
        156 => [[['_route' => '_apitache.destroy', '_controller' => 'App\\Controller\\TacheController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        188 => [[['_route' => 'user.update', '_controller' => 'App\\Controller\\UserController::update'], ['id'], ['GET' => 0, 'PUT' => 1], null, false, true, null]],
        211 => [
            [['_route' => 'user.delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
