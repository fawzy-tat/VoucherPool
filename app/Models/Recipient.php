<?php
namespace VoucherPool\Models;

use Illuminate\Database\Eloquent\Model as Eloquent ;

Class Recipient extends Eloquent
{
  public function vouchers()
  {
    return $this->hasMany('VoucherPool\Models\Voucher');
  }

  public $timestamps = false;
}
