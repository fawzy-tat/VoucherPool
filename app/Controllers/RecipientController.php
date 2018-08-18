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

  public function getOne(Request $request, Response $response)
  {
    $recipient = Recipient::find(1);
    echo $recipient->email;
  }
}
