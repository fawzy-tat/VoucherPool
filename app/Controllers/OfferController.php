<?php

namespace VoucherPool\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \VoucherPool\Models\Offer;
use \VoucherPool\Models\Recipient;
use \VoucherPool\Models\Voucher;
use VoucherPool\Contracts\VoucherCodeFormat;
use VoucherPool\Output\MixedCharacters;
/**
 *Optional
 * use VoucherPool\Output\OnlyDigits;
 */


class OfferController
{

  /**
   *==============================================
   * get all offers
   *==============================================
   */
  public function getAll(Request $request, Response $response)
  {
    $offers = Offer::all();
    return $response->withJson([
        'offers' => $offers
    ], 200);
  }

  /**
   *==============================================
   * Adding new Special Offer
   *==============================================
   */
  public function addNewOffer(Request $request, Response $response)
  {
    /**
     * Creating new Offer record
     */
    $offer = new Offer;
    $offer->name = $request->getParsedBody()['name'];
    $offer->exp_date = $request->getParsedBody()['exp_date'];
    $offer->fixed_percentage = $request->getParsedBody()['fixed_percentage'];
    $offer->save();
    /**
     *Looping through all Registered Recipients to and create unique voucher code
     *which is associated with the offer id and Recipient id
     * LATER we can use queues to reduce response time
     */
    $recipients = Recipient::all();
    foreach ($recipients as $recipient) {
      $voucher = new Voucher;
      $voucher->recipient_id = $recipient->id;
      $voucher->offer_id = $offer->id;
      $voucher->exp_date = $request->getParsedBody()['exp_date'];

      /**
       *MixedCharacters is implementation for the VoucherCodeFormat Interface
       *you can Swap between ( MixedCharacters and OnlyDigits )
       */
      $voucher->code = $this->generateVoucherCode(new MixedCharacters);
      $voucher->save();
    }

    /**
     *return Json response
     */
    return $response->withJson([
        'Message' => " Offer created succefuly ",
        'offer' => $offer
    ], 200);

  }


  /**
   *==============================================
   * Calling the VoucherCodeFormat Interface which is located in app/Contracts/VoucherCodeFormat
   *==============================================
   */


  public function generateVoucherCode(VoucherCodeFormat $formatter)
  {

    $voucherCode = $formatter->output(8); // <== "output($length)" param for the max length
    if ($this->voucherCodeExists($voucherCode))
    {
        $voucherCode =  $formatter->output(8); // <== "output($length)" param for the max length
    }
    return $voucherCode;
  }

  /**
   *==============================================
   * Check if Voucher Code already Exists
   *==============================================
   */

  public  function voucherCodeExists($code)
   {
       return Voucher::where("code",$code)->exists();
   }
}
