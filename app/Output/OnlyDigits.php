<?php
namespace VoucherPool\Output;
use VoucherPool\Contracts\VoucherCodeFormat;

/**
 *
 */
class OnlyDigits implements VoucherCodeFormat
{
  public function output($length)
  {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $code = '';
      for ($i = 0; $i < $length; $i++) {
          $code .= $characters[rand(0, $charactersLength - 1)];
      }
    return $code;
  }
}
