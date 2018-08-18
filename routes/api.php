<?php

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where we can register api routes for our application.
|
*/

$app->get('/api/recipients', \VoucherPool\Controllers\RecipientController::class . ':getOne');
