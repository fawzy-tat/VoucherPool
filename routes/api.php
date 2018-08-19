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



/**
 * Some general REST API's
 */

$app->get('/api/recipients', \VoucherPool\Controllers\RecipientController::class . ':getAll');

$app->get('/api/vouchers', \VoucherPool\Controllers\VoucherController::class . ':getAll');

$app->get('/api/offers', \VoucherPool\Controllers\OfferController::class . ':getAll');

/**
 * Required task functionalties
 */
$app->post('/api/add-offer', \VoucherPool\Controllers\OfferController::class . ':addNewOffer');

$app->post('/api/apply-voucher', \VoucherPool\Controllers\VoucherController::class . ':ValidateAndapplyVoucher');

$app->post('/api/get-related-vouchers', \VoucherPool\Controllers\VoucherController::class . ':getRelatedVouchers');
