<?php
namespace VoucherPool\Models;

use Illuminate\Database\Eloquent\Model as Eloquent ;

Class Offer extends Eloquent
{
  public $timestamps = false;

  public function voucher()
  {
    return $this->hasMany('VoucherPool\Models\Voucher');
  }
}
