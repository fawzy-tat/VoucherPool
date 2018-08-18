<?php

namespace VoucherPool\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \VoucherPool\Models\Recipient;

/**
 *
 */
class RecipientController
{

  public function getAll(Request $request, Response $response)
  {
    $recipients = Recipient::all();
    return $recipients;
  }
}
