<?php
namespace VoucherPool\Output;
use VoucherPool\Contracts\VoucherCodeFormat;

/**
 *
 */
class MixedCharacters implements VoucherCodeFormat
{
  public function output($length)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $code = '';
      for ($i = 0; $i < $length; $i++) {
          $code .= $characters[rand(0, $charactersLength - 1)];
      }
    return $code;
  }
}
