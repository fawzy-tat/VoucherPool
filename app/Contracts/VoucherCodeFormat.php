<?php
namespace VoucherPool\Contracts;

interface VoucherCodeFormat
{
  public function output($length);
}
