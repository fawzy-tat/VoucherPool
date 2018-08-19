<?php

namespace VoucherPool\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \VoucherPool\Models\Offer;
use \VoucherPool\Models\Recipient;
use \VoucherPool\Models\Voucher;

class VoucherController
{

  /**
   *==============================================
   * Apply the voucher discount after checking it's validty
   *==============================================
   */
  public function applyVoucher($voucher)
  {
    $voucher->date_used = date("Y-m-d");
    $voucher->is_used = 1;
    $voucher->save();
  }

  /**
   *==============================================
   * Validate the Voucher Code
   *==============================================
   */

  public function ValidateAndapplyVoucher(Request $request, Response $response)
  {
    $voucher_code = $request->getParsedBody()['voucher_code'];
    if ($this->VoucherCodeExists($voucher_code))
    {
        $voucher = Voucher::where("code",$voucher_code)->first();
        $voucher_recipient = Recipient::where('id',$voucher->recipient_id)
                                        ->where('email', $request->getParsedBody()['email'])
                                        ->first();
        if ($voucher_recipient)
        {
          $this->applyVoucher($voucher);
          return $response->withJson([
              'message' => 'Discount applied succefully',
              'percentage_discount' => ''.$voucher->offer->fixed_percentage.' %'
          ], 200);
        }
        else
        {
          return $response->withJson([
              'Message' => "You are using Wrong Voucher Code!"
          ], 400);
        }
    }
    else
    {
      return $response->withJson([
          'Message' => "Voucher Code doesnt exist or Expired !"
      ], 400);
    }
  }

  /**
   *==============================================
   * Check if voucher code exist, not used or expired
   *==============================================
   */

  public function VoucherCodeExists($voucherCode)
  {
    return Voucher::where("code", $voucherCode)
                  ->where("exp_date",">", date("Y-m-d"))
                  ->where("is_used", 0 )
                  ->exists();
  }

  /**
   *==============================================
   * Extra Functionality : For a given Email,
   * return all his valid Voucher Codes with the Name of the Special Offer
   *==============================================
   */
  public function getRelatedVouchers(Request $request, Response $response)
  {
     $recipient_vouchers = [];
     $recipient = Recipient::with('vouchers')
                            ->where('email',$request->getParsedBody()['email'])->first();
    if(!$recipient)
    {
      return $response->withJson([
          'Message' => "This email doesnt exist in our database!"
      ], 400);
    }
    else
    {
      foreach ($recipient->vouchers as $voucher) {
        $recipient_vouchers[] = (object) array('voucher_code' => $voucher->code , 'offer' => $voucher->offer->name);
      }
      return $response->withJson([
          'Message' => collect($recipient_vouchers)
      ], 400);
    }
  }


}
