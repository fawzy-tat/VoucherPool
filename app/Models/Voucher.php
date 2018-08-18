<?php
namespace VoucherPool\Models;

use Illuminate\Database\Eloquent\Model as Eloquent ;

Class Voucher extends Eloquent
{
  public $timestamps = false;

  public function recipient()
  {
    return $this->hasOne('VoucherPool\Models\Recipient');
  }
  public function offer()
  {
    return $this->belongsTo('VoucherPool\Models\Offer');
  }

}
